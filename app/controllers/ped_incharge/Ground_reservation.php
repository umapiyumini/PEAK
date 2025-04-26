<?php
class Ground_reservation extends Controller{
    public function index(){
        // Get the selected date from the request, default to today's date if not provided
        $selectedDate = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d'); 
    
        $reservationsModel = new Reservations();
        $allReservations = $reservationsModel->getActiveReservations();
    
        // Define all possible time slots for display
        $allTimeSlots = array("08:00:00 - 10:00:00", "10:00:00 - 12:00:00", "13:00:00 - 15:00:00", "15:00:00 - 17:00:00");
        $allSections = array("C", "D", "E", "F", "G");
    
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
            $duration = $reservation->duration; // e.g., "2 hr", "fullday", "half day"
            $section = $reservation->section;
            
            // Determine which time slots are affected based on start time and duration
            $affectedTimeSlots = [];
            
            if ($startTime == "08:00:00") {
                if ($duration == "2 hour") {
                    $affectedTimeSlots[] = "08:00:00 - 10:00:00";
                } elseif ($duration == "half") {
                    $affectedTimeSlots[] = "08:00:00 - 10:00:00";
                    $affectedTimeSlots[] = "10:00:00 - 12:00:00";
                } elseif ($duration == "full") {
                    $affectedTimeSlots[] = "08:00:00 - 10:00:00";
                    $affectedTimeSlots[] = "10:00:00 - 12:00:00";
                    $affectedTimeSlots[] = "13:00:00 - 15:00:00";
                    $affectedTimeSlots[] = "15:00:00 - 17:00:00";
                }
            } elseif ($startTime == "10:00:00") {
                $affectedTimeSlots[] = "10:00:00 - 12:00:00";
            } elseif ($startTime == "13:00:00") {
                if ($duration == "2 hour") {
                    $affectedTimeSlots[] = "13:00:00 - 15:00:00";
                } elseif ($duration == "half") {
                    $affectedTimeSlots[] = "13:00:00 - 15:00:00";
                    $affectedTimeSlots[] = "15:00:00 - 17:00:00";
                }
            } elseif ($startTime == "15:00:00") {
                $affectedTimeSlots[] = "15:00:00 - 17:00:00";
            }
            
            // Update the structured array for all affected time slots
            foreach ($affectedTimeSlots as $index=>$timeSlot) {
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
    
            
        $groundcourtsmodel= new Courts();
        $groundcourts= $groundcourtsmodel->getGroundCourtsBySection();

        $this->view('ped_incharge/ground_reservation', [
            'structured' => $structured, 
            'allTimeSlots' => $allTimeSlots, 
            'allSections' => $allSections,
            'selectedDate' => $selectedDate,
            'groundcourts' => $groundcourts
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

            header('Location: '. ROOT .'/ped_incharge/ground_reservation');
        }else{
            header('Location: '. ROOT .'/ped_incharge/ground_reservation');
        }
    }

    public function cancelReservation($id= ''){
        $reservationmodel= new Reservations();
        $cancel= $reservationmodel->cancelSpecialReservations($id);

        header('Location: '. ROOT .'/ped_incharge/ground_reservation');
    }
}