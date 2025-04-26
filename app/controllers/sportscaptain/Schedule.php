<?php
class Schedule extends Controller{

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

        $scheduleModel = new PracticeSchedule();
        $schedule = $scheduleModel->getSchedule();

        $this->view('sportscaptain/schedule',['schedule' => $schedule]);
    }

   public function addschedule(){

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

                $date = $_POST['date'] ?? null;
                $start_time = $_POST['start_time'] ?? null;
                $end_time = $_POST['end_time'] ?? null;
                $category = $_POST['category'] ?? null;

                $userId = $this->getUserId();
                if(!$userId){
                    die("User Id not found in session.");
                }

                if(!$date || !$start_time || !$end_time || !$category){
                    $_SESSION['error'] = 'All fields are required';
                    header('location: ' .ROOT . '/sportscaptain/schedule');
                    exit();
                }

                // Check if the date is in the past
                $currentDate = date('Y-m-d');
                if ($date < $currentDate) {
                    $_SESSION['error'] = 'The date cannot be in the past.';
                    header('location: ' .ROOT . '/sportscaptain/schedule');
                    exit();
                }

                // Check if the start time is before the end time
                if ($start_time >= $end_time) {
                    $_SESSION['error'] = 'Start time must be before end time.';
                    header('location: ' .ROOT . '/sportscaptain/schedule');
                    exit();
                }

               
                
                // Initialize scheduleModel before using it
        $scheduleModel = new PracticeSchedule();
        
        // Check if the date and time conflict with existing schedules
        $existingSchedules = $scheduleModel->getSchedule();
        $hasConflict = false;
        if (!empty($existingSchedules)) {
            foreach ($existingSchedules as $existing) {
                // Only check conflict if it's not the same schedule we're editing
                if (isset($_POST['id']) && $existing->id == $_POST['id']) {
                    continue;
                }
                
                if ($existing->date == $date) {
                    // Check if time periods overlap
                    if (($start_time < $existing->end_time && $end_time > $existing->start_time)) {
                        $hasConflict = true;
                        break;
                    }
                }
            }
            
            if ($hasConflict) {
                $_SESSION['error'] = 'The selected date and time conflict with an existing schedule.';
                header('location: ' .ROOT . '/sportscaptain/schedule');
                exit();
            }
        }


            try{


                $scheduleModel = new PracticeSchedule();
                $schedule = $scheduleModel->addSchedule();

                if($schedule){
                    $_SESSION['success'] = 'Schedule added successfully';
                }else{
                    $_SESSION['error'] = 'Failed to add schedule';
                }
            }catch(Exception $e){
                $_SESSION['error'] = $e->getMessage();
            }
        }

        header('location: ' .ROOT . '/sportscaptain/schedule');
        exit();
   }

   public function deleteschedule($id = null){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $id = $_POST['scheduleid'] ?? null;

            if(!$id){

                $_SESSION['error'] = 'Schedule ID is required';
                header('location: ' .ROOT . '/sportscaptain/schedule');
                exit();
            }

            try{
                $scheduleModel = new PracticeSchedule();
                $schedule = $scheduleModel->deleteSchedule(
                    $_POST['id']
                );

                if($schedule){
                    $_SESSION['success'] = 'Schedule deleted successfully';
                }else{
                    $_SESSION['error'] = 'Failed to delete schedule';
                }
            }catch(Exception $e){
                $_SESSION['error'] = $e->getMessage();
            }
        }

        header('location: ' .ROOT . '/sportscaptain/schedule');
        exit();
   }

   public function editschedule($id =null){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $id = $_POST['scheduleid'] ?? null;
            $date = $_POST['date'] ?? null;
            $start_time = $_POST['start_time'] ?? null;
            $end_time = $_POST['end_time'] ?? null;
            $category = $_POST['category'] ?? null;

            if(!$id || !$date || !$start_time || !$end_time || !$category){
                $_SESSION['error'] = 'All fielda are requierd';
                header('location: ' .ROOT . '/sportscaptain/schedule');
                exit();
            }

            try{

                $scheduleModel = new PracticeSchedule();
                $schedule = $scheduleModel->editSchedule(
                    $id,
                    $date,
                    $start_time,
                    $end_time,
                    $category
                );

                

                if($schedule){
                    $_SESSION['success'] = 'Schedule updated successfully';
                }else{
                    $_SESSION['error'] = 'Failed to update schedule';
                }
            }catch(Exception $e){
                $_SESSION['error'] = $e->getMessage();
            }
        }
        header('location: ' .ROOT . '/sportscaptain/schedule');
        exit();
   }

}