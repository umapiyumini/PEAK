<?php
class Reservation extends Controller{

    private function getUserId() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION['USER']->userid ?? null;
    }


    public function index() {
        $userId = $this->getUserId();
    
        $court = new Courts();
        $courtname = $court->getcourt();
        
        $reservation = new Reservations();
        $allreservations = $reservation->getReservationbyUser();
        
        
        $reservedTimeSlots = $reservation->getReservationsByCourtSection($userId);


$this->view('sportscaptain/reservation', [
    'courtname' => $courtname,
    'reservedTimeSlots' => json_encode($reservedTimeSlots),
    'allreservations' => $allreservations
]);
    }
    
    public function addreservation(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            

            try{

                $reservation = new Reservations();

                $data = [
                    'userid' => $_SESSION['USER']->userid ?? null,
                    'courtid' => $_POST['courtid'],
                    'event' => $_POST['event'],
                    'date' => $_POST['date'],
                    'duration' => $_POST['duration'],
                    'time' => $_POST['time'], 
                    'status' => $_POST['status'], 
                    'usertype' => 'sportscaptain', 
                    'numberof_participants' => $_POST['numberof_participants'],
                    'created_at' => date('Y-m-d H:i:s')
                ];

                if(!$data['userid']) {
                    $_SESSION['error'] = 'You must be logged in to make a reservation';
                }
                $success = $reservation->addReservation();

            
                if($success){
                    $_SESSION['success'] = 'Reservation added successfully!';
                }else{
                    $_SESSION['error'] = 'Failed to add reservation.';
                }
        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
        }
    }

    header('location: ' .ROOT . '/sportscaptain/reservation');
    exit;
    }

    
        public function getAvailableSlots() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $reservationsModel = new Reservations();
                $userId = $this->getUserId(); 
                
                $date = $_POST['date'];
                $duration = $_POST['duration'];
        
                // Get existing reservations for the user
                $reservedTimeSlots = $reservationsModel->getReservationsByCourtSection($userId);
        
                // Extract times for the selected date only
                $reservedTimes = [];
                if (isset($reservedTimeSlots[$date])) {
                    foreach ($reservedTimeSlots[$date] as $slot) {
                        $reservedTimes[] = $slot['time'];
                    }
                }
        
                // Generate all possible slots
                $allSlots = $this->generateTimeSlots($duration);
        
                // Filter out reserved slots
                $availableSlots = array_diff($allSlots, $reservedTimes);
        
                echo json_encode(array_values($availableSlots));
                exit;
            }
        }
        
    private function generateTimeSlots($duration) {
        $slots = [];
    
        if ($duration == '2 hours') {
            $start = strtotime('08:00');
            $end = strtotime('18:00');
    
            while ($start + 7200 <= $end) {
                $slots[] = date('H:i', $start);
                $start += 7200; // next 2 hours
            }
        } elseif ($duration == 'half day') {
            $slots = ['08:00', '13:00']; // morning and evening
        } elseif ($duration == 'full day') {
            $slots = ['08:00']; // full day slot
        }
    
        return $slots;
    }
    
    public function editreservation(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            try{

                $reservation = new Reservations();
                    
                    $data = [
                        'event' => $_POST['event'],
                        'date' => $_POST['date'],
                        'duration' => $_POST['duration'],
                        'time' => $_POST['time'],  
                        'numberof_participants' => $_POST['numberof_participants']
                    ];
    
                    $reservationId = $_POST['reservationid']; // 🔹 Get reservation ID from POST

                    $result = $reservation->editReservation($reservationId, $data);
                   
                    
                
                    if($result){
                        $_SESSION['success'] = 'Reservation updated successfully!';
                    }else{
                        $_SESSION['error'] = 'Failed to update reservation.';
                    }
            }catch(Exception $e){
                $_SESSION['error'] = $e->getMessage();
            }   
        }
        header('location: ' .ROOT . '/sportscaptain/reservation');
    }

    public function deletereservation($reservationId = null){
        // Get ID either from URL parameter or POST data
        if ($reservationId === null && isset($_POST['reservationid'])) {
            $reservationId = $_POST['reservationid'];
        }
        
        if (!$reservationId) {
            $_SESSION['error'] = 'Reservation ID is required.';
            header('location: ' . ROOT . '/sportscaptain/reservation');
            exit;
        }
        
        try {
            $reservation = new Reservations();
            $result = $reservation->deleteReservation($reservationId);
            
            if($result){
                $_SESSION['success'] = 'Reservation deleted successfully!';
            } else {
                $_SESSION['error'] = 'Failed to delete reservation.';
            }
        } catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
        }
        
        header('location: ' . ROOT . '/sportscaptain/reservation');
        exit;
    }
    
   

}