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


        $this->view('sportscaptain/sportattendance',['attendance' => $attendance]);
    }

   public function markattendnace(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $this->getUserId();
            if (!$userId) {
                die("User ID not found in session.");
            }

            $sportId = $_POST['sport_id'];
            $date = $_POST['date'];
            $attendance = $_POST['attendance'];
            $regno = $_POST['regno'];

            $attendanceModel = new Attendance();
            $attendanceModel->insertAttendance($userId, $sportId, $date, $attendance, $regno);
        }
   }

}