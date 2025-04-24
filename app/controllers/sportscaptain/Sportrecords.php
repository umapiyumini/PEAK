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

    private $freshersrecords;
    private $interfacultyrecords;
    private $interunirecords;
    private $upcomingevents;

    public function __construct() {
        $this->freshersrecords = new Freshersrecords();
        $this->interfacultyrecords = new Interfacultyrecords();
        $this->interunirecords = new Interunirecords();
        $this->upcomingevents = new Upcomingevent();
    }

    public function index(){

    $allRecords = [];

    $freshers = $this->freshersrecords->getFreshersrecords();
    foreach ($freshers as $record){
        $record = (array) $record;
        $record['category'] = 'Freshers';
        $allRecords[] = $record;
    }

    $interfaculty = $this->interfacultyrecords->getInterfacultyrecords();
    foreach ($interfaculty as $record){
        $record = (array) $record;
        $record['category'] = 'Inter Faculty';
        $allRecords[] = $record;
    }

    $interuni = $this->interunirecords->getIntrunirecords();
    foreach ($interuni as $record){
        $record = (array) $record;
        $record['category'] = 'Inter University';
        $allRecords[] = $record;
    }


    $data = ['tournamentRecords' => $allRecords];

    $this->view('sportscaptain/sportrecords', $data);
    }

    public function getupcoming(){

        $upcomingModel = new Upcomingevent();
        $upcomingevents = $upcomingModel->getUpcomingevents();

        $data = ['upcomingevents' => $upcomingevents];
        $this->view('sportscaptain/sportrecords', $data);

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