<?php
class Sportattendance extends Controller{
   
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

        $attendanceModel = new Attendance();
        $attendance = $attendanceModel->getatteandancebysport();

        //var_dump($attendance);
        //exit;



        $this->view('sportscaptain/sportattendance',['attendance' => $attendance]);
    }

   

}