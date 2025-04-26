<?php
class Indoor_reservation extends Controller{
    public function index(){
        // Get the selected date from the request, default to today's date if not provided
        $selectedDate = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d'); 
        

    
        $reservationsModel = new Reservations();
        $allReservations = $reservationsModel->getActiveReservationsIndoor();

    
        // Define all possible time slots for display - updated for indoor courts
        $allTimeSlots = array(
            "08:00:00 - 09:00:00", 
            "09:00:00 - 10:00:00", 
            "10:00:00 - 11:00:00", 
            "11:00:00 - 12:00:00", 
            "13:00:00 - 14:00:00", 
            "14:00:00 - 15:00:00", 
            "15:00:00 - 16:00:00", 
            "16:00:00 - 17:00:00",
            "17:00:00 - 18:00:00"
        );
        $allSections = array("A", "B");
    
        // Filter reservations by the selected date
        $filteredReservations = array();
        foreach ($allReservations as $reservation) {
            // Format comparison to ensure consistent format
            $reservationDate = date('Y-m-d', strtotime($reservation->date));
            if ($reservationDate === $selectedDate) {
                $filteredReservations[] = $reservation;
            }
        }

        // Initialize structured array with empty slots
        $structured = array();
        foreach ($allTimeSlots as $timeSlot) {
            foreach ($allSections as $section) {
                $structured[$timeSlot][$section] = array(
                    'status' => 'available',
                    'bookedBy' => null,
                    'name' => null,
                    'reservationid' => null,
                    'userType' => null,
                    'date' => null,
                    'event' => null
                );
            }
        }
    
        // Map database time slots to display time slots
        foreach ($filteredReservations as $reservation) {
            $startTime = $reservation->time; // e.g., "8.00"
            $duration = $reservation->duration; // e.g., "1 hr", "halfday", "fullday"
            $section = $reservation->section;
            
            // Determine which time slots are affected based on start time and duration
            $affectedTimeSlots = [];
            
            // For full day booking (8am-6pm)
            if ($duration == "full") {
                foreach ($allTimeSlots as $timeSlot) {
                    $affectedTimeSlots[] = $timeSlot;
                }
            }
            // For half day booking (8am-1pm)
            elseif ($duration == "half") {
                if ($startTime == "08:00:00") {
                    $affectedTimeSlots[] = "08:00:00 - 09:00:00";
                    $affectedTimeSlots[] = "09:00:00 - 10:00:00";
                    $affectedTimeSlots[] = "10:00:00 - 11:00:00";
                    $affectedTimeSlots[] = "11:00:00 - 12:00:00";
                    $affectedTimeSlots[] = "13:00:00 - 14:00:00";
                } elseif ($startTime == "13:00:00") {
                    $affectedTimeSlots[] = "13:00:00 - 14:00:00";
                    $affectedTimeSlots[] = "14:00:00 - 15:00:00";
                    $affectedTimeSlots[] = "15:00:00 - 16:00:00";
                    $affectedTimeSlots[] = "16:00:00 - 17:00:00";
                    $affectedTimeSlots[] = "17:00:00 - 18:00:00";
                }
            }
            // For 1 hour bookings
            else {
                $startHour = substr($startTime, 0, 2);
                $endHour = str_pad((intval($startHour) + 1), 2, "0", STR_PAD_LEFT);
                $affectedTimeSlots[] = "$startTime - $endHour:00:00";
            }
            
            // Update the structured array for all affected time slots
            foreach ($affectedTimeSlots as $index => $timeSlot) {
                if (isset($structured[$timeSlot][$section])) {
                    $structured[$timeSlot][$section] = array(
                        'status' => $reservation->status,
                        'bookedBy' => $reservation->userid,
                        'name' => $reservation->username,
                        'reservationid' => $reservation->reservationid,
                        'userType' => $reservation->role,
                        'date' => $reservation->date,
                        'event' => $reservation->event,
                        'isStart' => ($index === 0), // Whether this is the first slot of a multi-slot reservation
                        'span' => count($affectedTimeSlots) // How many slots this reservation spans
                    );
                }
            }
        }

    
        $indoorcourtsmodel = new Courts();
        $indoorcourts = $indoorcourtsmodel->getIndoorCourtsBySection();

        $this->view('ped_incharge/indoor_reservation', [
            'structured' => $structured, 
            'allTimeSlots' => $allTimeSlots, 
            'allSections' => $allSections,
            'selectedDate' => $selectedDate,
            'indoorcourts' => $indoorcourts
        ]);
    }

    public function saveReservation(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $reservationmodel = new Reservations();

            try {
                $result = $reservationmodel->addSpecialReservation($_POST);
    
                if (!$result) {
                    $_SESSION['error'] = "Reservation not possible due to a conflict or system error.";
                } else {
                    $_SESSION['success'] = "Reservation successful!";
                }
            } catch (Exception $e) {
                error_log("Reservation Error: " . $e->getMessage());
                $_SESSION['error'] = "An unexpected error occurred. Please try again.";
            }

            header('Location: '. ROOT .'/ped_incharge/indoor_reservation');
        }else{
            header('Location: '. ROOT .'/ped_incharge/indoor_reservation');
        }
    }

    public function cancelReservation($id = ''){
        $reservationmodel = new Reservations();
        $cancel = $reservationmodel->cancelSpecialReservations($id);
        
        header('Location: '. ROOT .'/ped_incharge/indoor_reservation');
    }
}