<?php
class Sportrecords extends Controller{

    private function getUserId() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['userid'])) {
            die("User not logged in.");
        }
        return $_SESSION['userid'];
    }

    public function index(){

    $interuniModel = new Interunirecords();
    $interuinrecords = $interuniModel->getIntrunirecords();
    //$interuniid = $interuniModel->getInterunirecordsId();
    
    $interfacultyModel = new Interfacultyrecords();
    $interfacrecords = $interfacultyModel->getInterfacultyrecords();
    //$interfacid = $interfacultyModel->getInterfacultyrecordsId();

    $freshersModel = new Freshersrecords();
    $freshersrecords =$freshersModel->getFreshersrecords();
   // $freshersid = $freshersModel->getFreshersrecordsId();

    $pastEvents = array_merge($interuinrecords,$interfacrecords,$freshersrecords);
    //$eventId = array_merge($interuniid,$interfacid,$freshersid);

    $upcomingModel = new Upcomingevent();
    $upcomingevents = $upcomingModel->getupcomingevents();

    $this->view('sportscaptain/sportrecords',['pastEvents' => (array) $pastEvents],['upcomingevents' => $upcomingevents]);
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
            $eventId = $_POST['edit_id'];

            // Determine the event type (Interuni, Interfaculty, Freshers)
            $interuniModel = new Interunirecords();
            $interfacultyModel = new Interfacultyrecords();
            $freshersModel = new Freshersrecords();

            $event = $interuniModel->getTournamentById($eventId) ??
                     $interfacultyModel->getTournamentById($eventId) ??
                     $freshersModel->getTournamentById($eventId);

            if ($event) {
                // Load the view and pass the event data for editing
                $this->view('sportscaptain/sportrecords', [
                    'event' => $event
                ]);
            } else {
                echo "Event not found!";
            }
        }
    }

    public function updateEvent() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
            $id = $_POST['id'];
            $name = $_POST['tournament_name'];
            $year = $_POST['year'];
            $first_place = $_POST['first_place'];
            $second_place = $_POST['second_place'];
            $third_place = $_POST['third_place'];
            $place = $_POST['place'];
            $venue = $_POST['venue'];

            // Attempt to update based on the event type
            $interuniModel = new Interunirecords();
            $interfacultyModel = new Interfacultyrecords();
            $freshersModel = new Freshersrecords();

            $updated = $interuniModel->updateTournament($id, $name, $year, $first_place, $second_place, $third_place, $place, $venue) ||
                       $interfacultyModel->updateTournament($id, $name, $year, $first_place, $second_place, $third_place, $place, $venue) ||
                       $freshersModel->updateTournament($id, $name, $year, $first_place, $second_place, $third_place, $place, $venue);

            if ($updated) {
                header('Location: ' . ROOT . '/sportscaptain/sportrecords');
                exit();
            } else {
                echo "Failed to update event!";
            }
        }
    }



    public function addevent(){

        $upcomingModel = new Upcomingevent();
        $addevent = $upcomingModel->addupcomingevent();

        if($addevent){
            header('Location:' . ROOT . '/sportscaptain/sportrecords');
    }

    }
       
    
   

}