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

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

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

            $id = $_POST['id'] ?? null;

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

            $id = $_POST['id'] ?? null;
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