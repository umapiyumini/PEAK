<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Reservation extends Controller { 
    private $data = []; 

    public function index() {
        if (!isset($_SESSION['userid'])) {
            die("User not logged in inside index()");
        }

        $reservationsModel = new Reservations(); 
        $user_id = $_SESSION['userid'];
        // For active reservations (future only)
        $this->data['active_reservations'] = $reservationsModel->getFutureReservationsByUser($user_id);
        // For reservation history (all)
        $this->data['history_reservations'] = $reservationsModel->getAllReservationsByUser($user_id);
        $this->view('external/reservation', $this->data);


    }

    public function cancelReservation() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $reservationid = $_POST['reservationid'] ?? null;
            $userid = $_SESSION['userid'] ?? null;
    
            if ($reservationid && $userid) {
                $reservationsModel = new Reservations();
                // Optional: Check if reservation belongs to this user
                $reservation = $reservationsModel->findById($reservationid);
                if ($reservation && $reservation->userid == $userid) {
                    $reservationsModel->delete($reservationid);
                    // Optionally, log the cancellation reason
                    // Redirect or show success message
                    $notificationsModel = new Notifications();
                    $notificationsModel->sendCancelNotification($userid, $reservationDetails);
                    header("Location: " . ROOT . "/external/reservation?cancel=success");
                    exit;
                }
            }
            // If failed
            header("Location: " . ROOT . "/external/reservation?cancel=fail");
            exit;
        }
    }

    public function checkAvailability() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $date = $_POST['date'] ?? null;
            $courtId = $_POST['courtid'] ?? null;
            $duration = $_POST['duration'] ?? null;
            $section = $_POST['section'] ?? null;
            
            if (!$date || !$courtId || !$section) {
                echo json_encode(['available' => false, 'message' => 'Missing required parameters']);
                return;
            }
            
            $reservationsModel = new Reservations();
            $isAvailable = true;
            $message = '';
            $disabledSlots = [];
            
            // Check for full day bookings first (blocks the entire day)
            $isFullDayBooked = $reservationsModel->isFullDayBooked($date, $section);
            
            if ($isFullDayBooked) {
                echo json_encode([
                    'available' => false,
                    'message' => 'Date unavailable. This date already has a full-day reservation in the same section.',
                    'disabledSlots' => []
                ]);
                return;
            }
            
            if ($duration === 'full') {
                // For full day bookings, check if there are any reservations of ANY duration on that date in the same section
                $bookings = $reservationsModel->getBookingsForDateSection($date, $section);
                $isAvailable = empty($bookings);
                
                if (!$isAvailable) {
                    $message = 'Date unavailable please select another date. This date already has reservations in the same section.';
                }
            } else if ($duration === 'half') {
                // Get all booked half-day slots
                $bookedHalfDaySlots = $reservationsModel->getBookedHalfDaySlots($date, $section);
                
                // Check for 2-hour bookings that might conflict with half-day slots
                $bookedTwoHourSlots = $reservationsModel->getBookedTwoHourSlots($date, $section);
                
                // Check for 1-hour bookings that might conflict with half-day slots
                $bookedOneHourSlots = $reservationsModel->getBookedOneHourSlots($date, $section);
                
                // Morning slot: 08:00:00 to 12:00:00
                // Afternoon slot: 13:00:00 to 17:00:00
                $morningSlotDisabled = false;
                $afternoonSlotDisabled = false;
                
                // Check half-day conflicts
                foreach ($bookedHalfDaySlots as $slot) {
                    if ($slot === '08:00:00') {
                        $morningSlotDisabled = true;
                    } else if ($slot === '13:00:00') {
                        $afternoonSlotDisabled = true;
                    }
                }
                
                // Check 2-hour conflicts with morning slot 
                foreach ($bookedTwoHourSlots as $slot) {
                    if ($slot === '08:00:00' || $slot === '10:00:00') {
                        $morningSlotDisabled = true;
                    } else if ($slot === '13:00:00' || $slot === '15:00:00') {
                        $afternoonSlotDisabled = true;
                    }
                }
                
                // Check 1-hour conflicts
                foreach ($bookedOneHourSlots as $slot) {
                    // Morning conflicts (8-9, 9-10, 10-11, 11-12)
                    if ($slot === '08:00:00' || $slot === '09:00:00' || 
                        $slot === '10:00:00' || $slot === '11:00:00'|| $slot==='12:00:00') {
                        $morningSlotDisabled = true;
                    }
                    // Afternoon conflicts (13-14, 14-15, 15-16, 16-17)
                    else if ($slot === '13:00:00' || $slot === '14:00:00' || 
                             $slot === '15:00:00' || $slot === '16:00:00'||$slot==='17:00:00') {
                        $afternoonSlotDisabled = true;
                    }
                }
                
                // Build the disabled slots array
                if ($morningSlotDisabled) {
                    $disabledSlots[] = 'morning';
                }
                if ($afternoonSlotDisabled) {
                    $disabledSlots[] = 'afternoon';
                }
                
                // Check if both slots are disabled
                if ($morningSlotDisabled && $afternoonSlotDisabled) {
                    $isAvailable = false;
                    $message = 'No half-day slots available on this date.';
                }
            } else if ($duration === '1 hour') {
                // Get all booked slots that would affect one-hour bookings
                $bookedHalfDaySlots = $reservationsModel->getBookedHalfDaySlots($date, $section);
                $bookedTwoHourSlots = $reservationsModel->getBookedTwoHourSlots($date, $section);
                $bookedOneHourSlots = $reservationsModel->getBookedOneHourSlots($date, $section);
                
                $disabledSlots = [];
                
                // Check half-day conflicts (morning: 8-12, afternoon: 13-17)
                foreach ($bookedHalfDaySlots as $slot) {
                    if ($slot === '08:00:00') {
                        // Morning half-day booking blocks 8-12
                        $disabledSlots = array_merge($disabledSlots, ['08:00:00', '09:00:00', '10:00:00', '11:00:00','12:00:00']);
                    } else if ($slot === '13:00:00') {
                        // Afternoon half-day booking blocks 13-17
                        $disabledSlots = array_merge($disabledSlots, ['13:00:00', '14:00:00', '15:00:00', '16:00:00','17:00:00']);
                    }
                }
                
                
                // Add one-hour conflicts
                $disabledSlots = array_merge($disabledSlots, $bookedOneHourSlots);
                
                // Remove duplicates
                $disabledSlots = array_unique($disabledSlots);
                
                // Check if all slots are disabled
                $allTimeSlots = ["08:00:00", "09:00:00", "10:00:00", "11:00:00", "12:00:00", 
                                "13:00:00", "14:00:00", "15:00:00", "16:00:00", "17:00:00"];
                $availableSlots = array_diff($allTimeSlots, $disabledSlots);
                
                if (empty($availableSlots)) {
                    $isAvailable = false;
                    $message = 'No one-hour slots available on this date.';
                }
            } else if ($duration === '2 hour') {
                // Get all booked slots that would affect two-hour bookings
                $bookedHalfDaySlots = $reservationsModel->getBookedHalfDaySlots($date, $section);
                $bookedTwoHourSlots = $reservationsModel->getBookedTwoHourSlots($date, $section);
                
                $disabledSlots = [];
                
                // Check half-day conflicts (morning: 8-12, afternoon: 13-17)
                foreach ($bookedHalfDaySlots as $slot) {
                    if ($slot === '08:00:00') {
                        // Morning half-day booking blocks 8-12
                        $disabledSlots = array_merge($disabledSlots, ['08:00:00', '10:00:00']);
                    } else if ($slot === '13:00:00') {
                        // Afternoon half-day booking blocks 13-17
                        $disabledSlots = array_merge($disabledSlots, ['13:00:00', '15:00:00']);
                    }
                }
                
                // Add two-hour conflicts
                $disabledSlots = array_merge($disabledSlots, $bookedTwoHourSlots);
                
                // Remove duplicates
                $disabledSlots = array_unique($disabledSlots);
                
                // Check if all slots are disabled
                $allTimeSlots = ["08:00:00", "10:00:00",  "13:00:00", "15:00:00"];
                $availableSlots = array_diff($allTimeSlots, $disabledSlots);
                
                if (empty($availableSlots)) {
                    $isAvailable = false;
                    $message = 'No two-hour slots available on this date.';
                }
            }
            
            
            echo json_encode([
                'available' => $isAvailable,
                'message' => $message,
                'disabledSlots' => $disabledSlots
            ]);
            return;
        }
        
        echo json_encode(['available' => false, 'message' => 'Invalid request method']);
    }

    public function rescheduleReservation() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $reservationId = $_POST['reservationid'] ?? null;
            $date = $_POST['date'] ?? null;
            $time = $_POST['time'] ?? null;
            $userId = $_SESSION['userid'] ?? null;
            
            if (!$reservationId || !$date || !$time || !$userId) {
                // Redirect with error if missing required fields
                header("Location: " . ROOT . "/external/reservation?reschedule=error");
                exit;
            }
            
            $reservationsModel = new Reservations();
            
            // Verify that this reservation belongs to the current user
            $reservation = $reservationsModel->findById($reservationId);
            if (!$reservation || $reservation->userid != $userId) {
                header("Location: " . ROOT . "/external/reservation?reschedule=unauthorized");
                exit;
            }
            
            // Update the reservation with new date, time and change status to pending
            $result = $reservationsModel->update($reservationId, [
                'date' => $date,
                'time' => $time,
                'status' => 'pending'
            ]);
            
            if ($result) {
                 // Send notification to PED incharge
                $notificationsModel = new Notifications();
                $notificationsModel->sendRescheduleNotification($userId, $date);
                // Redirect with success message
                header("Location: " . ROOT . "/external/reservation?reschedule=success");
            } else {
                // Redirect with error message
                header("Location: " . ROOT . "/external/reservation?reschedule=fail");
            }
            exit;
        }
        
        // If not POST request, redirect to reservations page
        header("Location: " . ROOT . "/external/reservation");
        exit;
    }
    
}
?>