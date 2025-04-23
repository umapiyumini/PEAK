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

    public function index() {

            $attendanceModel = new Attendance();
            $data = $attendanceModel->getatteandancebysport();
            $dates = $data['dates'];
            $records = $data['records'];
            
            // Organize data by player
            $playerData = [];
            foreach ($records as $record) {
                $name = $record->name;
                $date = $record->date;
                $status = $record->attendance;
                
                if (!isset($playerData[$name])) {
                    $playerData[$name] = ['name' => $name, 'dates' => []];
                }
                $playerData[$name]['dates'][$date] = $status;
            }
            
            $this->view('sportscaptain/sportattendance', [
                'dates' => $dates,
                'playerData' => $playerData  // Note: changed from 'attendance' to 'playerData'
            ]);
        }
    

}