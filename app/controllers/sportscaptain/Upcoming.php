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
        $upcomingEvents = $upcomingModel->getUpcomingevents();

        $data = [
            'upcomingEvents' => $upcomingEvents,
        ];

        $this->view('sportscaptain/upcoming', $data);
    }

   public function addevent(){

       $UserId = $this->getUserId();

       if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $eventname = $_POST['event_name'] ?? null;
            $date = $_POST['date'] ?? null;
            $time = $_POST['time'] ?? null;
            $venue = $_POST['venue'] ?? null;

            if(!$eventname || !$date || !$time || !$venue){
                echo "<script>alert('All fields are required');</script>";
                $_SESSION['error'] = 'All fields are required';
                header('location: ' .ROOT . '/sportscaptain/upcoming');
                exit();
            }

          try{

            $upcomingModel = new Upcomingevent();
            $events = $upcomingModel->addUpcomingevent();

            if($events){
                echo "<script>alert('Event added successfully');</script>";
                $_SESSION['success'] = 'Event added successfully';
            }else{
                echo "<script>alert('Failed to add event');</script>";
                $_SESSION['error'] = 'Failed to add event';
            }
          }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
          }
       }
       header('location: ' .ROOT . '/sportscaptain/upcoming');
       exit();
   }

   public function editevent(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $id = $_POST['id'] ?? null;
            $eventname = $_POST['event_name'] ?? null;
            $date = $_POST['date'] ?? null;
            $time = $_POST['time'] ?? null;
            $venue = $_POST['venue'] ?? null;
            $UserId = $this->getUserId();

            if(!$id || !$eventname || !$date || !$time || !$venue){
                $_SESSION['error'] = 'All fields are required';
                header('location: ' .ROOT . '/sportscaptain/upcoming');
                exit();
            }

            try{

                $upcomingModel = new Upcomingevent();
                $events = $upcomingModel->editUpcomingevent($id, $eventname, $date, $time, $venue, $UserId);

                if($events){
                    $_SESSION['success'] = 'Event updated successfully';
                }else{
                    $_SESSION['error'] = 'Failed to update event';
                }
            }catch(Exception $e){
                $_SESSION['error'] = $e->getMessage();
            }
        }
        header('location: ' .ROOT . '/sportscaptain/upcoming');
        exit();
   }

   public function deleteevent(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $id = $_POST['id'] ?? null;

            if(!$id){
                $_SESSION['error'] = 'Event ID is required';
                header('location: ' .ROOT . '/sportscaptain/upcoming');
                exit();
            }

            try{

                $upcomingModel = new Upcomingevent();
                $events = $upcomingModel->deleteUpcomingevent($id);

                if($events){
                    $_SESSION['success'] = 'Event deleted successfully';
                }else{
                    $_SESSION['error'] = 'Failed to delete event';
                }
            }catch(Exception $e){
                $_SESSION['error'] = $e->getMessage();
            }
        }
        header('location: ' .ROOT . '/sportscaptain/upcoming');
        exit();
   }


}