<?php
class Coaches extends Controller{
    
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

        $coachesModel = new Coachesinstructor();
        $coaches = $coachesModel->getCoaches();

        $this->view('sportscaptain/coaches', ['coaches' => $coaches]);
    }

   

}