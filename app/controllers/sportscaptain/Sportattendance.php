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
                $_SESSION['error']='User ID not found in session';
                header('Location: ' . ROOT . '/sportscaptain/sportattendance');
                exit();
            }

            try{

            $sportId = $_POST['sport_id'];
            $date = $_POST['date'];
            $attendance = $_POST['attendance'];
            $regno = $_POST['regno'];

           
            if (empty($sportId) || empty($date) || empty($attendance) || empty($regno)) {
                $_SESSION['error'] = 'All fields are required.';
                header('Location: ' . ROOT . '/sportscaptain/sportattendance');
                exit();
            }

            $attendanceModel = new Attendance();
            $record = $attendanceModel->insertAttendance($userId, $sportId, $date, $attendance, $regno);

            if ($record) {
                $_SESSION['success'] = 'Attendance marked successfully!';
            } else {
                $_SESSION['error'] = 'Failed to mark attendance.';
            }

            } catch (Exception $e) {
                $_SESSION['error'] = 'Error: ' . $e->getMessage();
            }

            header('Location: ' . ROOT . '/sportscaptain/sportattendance');
            exit();
}
}

}