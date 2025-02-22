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
    
    $interfacultyModel = new Interfacultyrecords();
    $interfacrecords = $interfacultyModel->getInterfacultyrecords();

    $freshersModel = new Freshersrecords();
    $freshersrecords =$freshersModel->getFreshersrecords();

    $pastEvents = array_merge($interuinrecords,$interfacrecords,$freshersrecords);
    $this->view('sportscaptain/sportrecords',['pastEvents' => $pastEvents]);
    }
       
    
   

}