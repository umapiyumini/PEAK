<?php
class Upcoming extends Controller{

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

        $upcomingModel = new Upcomingevent();
        $upcomingevents = $upcomingModel->getUpcomingevents();
        $data = ['upcomingevents' => $upcomingevents];

        $this->view('sportscaptain/upcoming', $data);
    }

   

}