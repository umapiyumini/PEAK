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
       
        $this->data['active_reservations'] = $reservationsModel->getFutureReservationsByUser($user_id);
       
        $this->data['history_reservations'] = $reservationsModel->getAllReservationsByUser($user_id);
        $this->view('external/reservation', $this->data);


    }

    public function cancelReservation() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $reservationid = $_POST['reservationid'] ?? null;
            $userid = $_SESSION['userid'] ?? null;
    
            if ($reservationid && $userid) {
                $reservationsModel = new Reservations();
                
                $reservation = $reservationsModel->findById($reservationid);
                
                if ($reservation && $reservation->userid == $userid) {
                    $status = $reservation->status;
                    $result = false;
                    
                    
                    if (in_array($status, ['pending', 'to pay', 'rejected'])) {
                       
                        $result = $reservationsModel->delete($reservationid);
                    } else if (in_array($status, ['paid', 'confirmed'])) {
                       
                        $result = $reservationsModel->update($reservationid, [
                            'status' => 'cancelled'
                        ]);
                    }
                    
                    if ($result) {
                        
                        $notificationsModel = new Notifications();
                        $notificationsModel->sendCancelNotification($userid, $reservation);
                        header("Location: " . ROOT . "/external/reservation?cancel=success");
                        exit;
                    }
                }
            }
            
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
                
                $bookings = $reservationsModel->getBookingsForDateSection($date, $section);
                $isAvailable = empty($bookings);
                
                if (!$isAvailable) {
                    $message = 'Date unavailable please select another date. This date already has reservations in the same section.';
                }
            } else if ($duration === 'half') {
                
                $bookedHalfDaySlots = $reservationsModel->getBookedHalfDaySlots($date, $section);
                
                
                $bookedTwoHourSlots = $reservationsModel->getBookedTwoHourSlots($date, $section);
                
        
                $bookedOneHourSlots = $reservationsModel->getBookedOneHourSlots($date, $section);
                
                
                $morningSlotDisabled = false;
                $afternoonSlotDisabled = false;
                
                
                foreach ($bookedHalfDaySlots as $slot) {
                    if ($slot === '08:00:00') {
                        $morningSlotDisabled = true;
                    } else if ($slot === '13:00:00') {
                        $afternoonSlotDisabled = true;
                    }
                }
                
                 
                foreach ($bookedTwoHourSlots as $slot) {
                    if ($slot === '08:00:00' || $slot === '10:00:00') {
                        $morningSlotDisabled = true;
                    } else if ($slot === '13:00:00' || $slot === '15:00:00') {
                        $afternoonSlotDisabled = true;
                    }
                }
                
                
                foreach ($bookedOneHourSlots as $slot) {
                    
                    if ($slot === '08:00:00' || $slot === '09:00:00' || 
                        $slot === '10:00:00' || $slot === '11:00:00'|| $slot==='12:00:00') {
                        $morningSlotDisabled = true;
                    }
                    
                    else if ($slot === '13:00:00' || $slot === '14:00:00' || 
                             $slot === '15:00:00' || $slot === '16:00:00'||$slot==='17:00:00') {
                        $afternoonSlotDisabled = true;
                    }
                }
                
            
                if ($morningSlotDisabled) {
                    $disabledSlots[] = 'morning';
                }
                if ($afternoonSlotDisabled) {
                    $disabledSlots[] = 'afternoon';
                }
                
                
                if ($morningSlotDisabled && $afternoonSlotDisabled) {
                    $isAvailable = false;
                    $message = 'No half-day slots available on this date.';
                }
            } else if ($duration === '1 hour') {
        
                $bookedHalfDaySlots = $reservationsModel->getBookedHalfDaySlots($date, $section);
                $bookedTwoHourSlots = $reservationsModel->getBookedTwoHourSlots($date, $section);
                $bookedOneHourSlots = $reservationsModel->getBookedOneHourSlots($date, $section);
                
                $disabledSlots = [];
                
                
                foreach ($bookedHalfDaySlots as $slot) {
                    if ($slot === '08:00:00') {
        
                        $disabledSlots = array_merge($disabledSlots, ['08:00:00', '09:00:00', '10:00:00', '11:00:00','12:00:00']);
                    } else if ($slot === '13:00:00') {
                        
                        $disabledSlots = array_merge($disabledSlots, ['13:00:00', '14:00:00', '15:00:00', '16:00:00','17:00:00']);
                    }
                }
                
                
                
                $disabledSlots = array_merge($disabledSlots, $bookedOneHourSlots);
                
        
                $disabledSlots = array_unique($disabledSlots);
                
                
                $allTimeSlots = ["08:00:00", "09:00:00", "10:00:00", "11:00:00", "12:00:00", 
                                "13:00:00", "14:00:00", "15:00:00", "16:00:00", "17:00:00"];
                $availableSlots = array_diff($allTimeSlots, $disabledSlots);
                
                if (empty($availableSlots)) {
                    $isAvailable = false;
                    $message = 'No one-hour slots available on this date.';
                }
            } else if ($duration === '2 hour') {
                
                $bookedHalfDaySlots = $reservationsModel->getBookedHalfDaySlots($date, $section);
                $bookedTwoHourSlots = $reservationsModel->getBookedTwoHourSlots($date, $section);
                
                $disabledSlots = [];
                
               
                foreach ($bookedHalfDaySlots as $slot) {
                    if ($slot === '08:00:00') {
                        
                        $disabledSlots = array_merge($disabledSlots, ['08:00:00', '10:00:00']);
                    } else if ($slot === '13:00:00') {
                
                        $disabledSlots = array_merge($disabledSlots, ['13:00:00', '15:00:00']);
                    }
                }
                
            
                $disabledSlots = array_merge($disabledSlots, $bookedTwoHourSlots);
                
        
                $disabledSlots = array_unique($disabledSlots);
                
                
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
            
                header("Location: " . ROOT . "/external/reservation?reschedule=error");
                exit;
            }
            
            $reservationsModel = new Reservations();
            
            
            $reservation = $reservationsModel->findById($reservationId);
            if (!$reservation || $reservation->userid != $userId) {
                header("Location: " . ROOT . "/external/reservation?reschedule=unauthorized");
                exit;
            }
            
            
            $result = $reservationsModel->update($reservationId, [
                'date' => $date,
                'time' => $time,
                'status' => 'pending'
            ]);
            
            if ($result) {
                 
                $notificationsModel = new Notifications();
                $notificationsModel->sendRescheduleNotification($userId, $date);
                
                header("Location: " . ROOT . "/external/reservation?reschedule=success");
            } else {
        
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