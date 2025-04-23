<?php
class Staffreservation extends Controller{
    public function index(){
        // Check if user is logged in
        if(!isset($_SESSION['userid'])) {
            redirect('login');
            return;
        }

        $staffModel = new Staff();
        $staffTypeData = $staffModel->getStaffType($_SESSION['userid']);
        
        // Properly handle staff type
        $staffType = isset($staffTypeData[0]->type) ? $staffTypeData[0]->type : null;

        $data = [
            'staffType' => $staffType
        ];
        
        $this->view('staff/staffreservation', $data);
    }

    // In Staffreservation controller
    public function getReservations() {
        try {
            $courtId = $_GET['facility'] ?? null;
            $date = $_GET['date'] ?? date('Y-m-d');
    
            if(!$courtId) {
                throw new Exception('Missing facility parameter');
            }
    
            $reservationModel = new Reservations();
            $reservations = $reservationModel->getTimeSlots($date, $courtId);
    
            $allSlots = ['08:00', '10:00', '12:00', '14:00', '16:00'];
            $reservedSlots = [];
    
            foreach ($reservations as $res){
                if (is_string($res)) {
                    // If result is string, it's just a reserved time
                    $reservedSlots[] = $res;
                } elseif (is_object($res)) {
                    // If result is object, assume it has time and duration
                    $start = $res->time;
                    $duration = strtolower(trim($res->duration));
    
                    if ($duration == 'full') {
                        $reservedSlots = array_merge($reservedSlots, $allSlots);
                    } elseif ($duration == 'half') {
                        if ($start == '08:00') {
                            $reservedSlots = array_merge($reservedSlots, ['08:00', '10:00']);
                        } else {
                            $reservedSlots = array_merge($reservedSlots, ['12:00', '14:00']);
                        }
                    } elseif ($duration == '2 hour') {
                        $reservedSlots[] = $start;
                    }
                }
            }
    
            $reservedSlots = array_unique($reservedSlots);
    
            // Output raw HTML for the frontend
            foreach ($allSlots as $slot) {
                $end = date("H:i", strtotime($slot . " +2 hours"));
                $class = in_array($slot, $reservedSlots) ? 'reserved' : 'available';
                echo "<div class='time-slot $class'>{$slot} - {$end}</div>";
            }
    
        } catch(Exception $e) {
            echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
        }
    }
    
}
