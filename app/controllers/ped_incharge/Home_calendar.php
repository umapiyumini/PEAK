<?php
    class Home_calendar extends Controller{
        public function index(){
            $eventModel = new Ped_events();
            $events = $eventModel->findallEvents();
            $this->view('ped_incharge/home_calendar',['events'=>$events]);

        }

        public function addEvent(){
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $eventModel = new Ped_events();
                $eventModel->addEvent($_POST);
                header('Location: '.ROOT.'/ped_incharge/home_calendar');
            }
        }

        public function deleteEventById() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = json_decode(file_get_contents("php://input"), true);
                $eventModel = new Ped_events();
                $eventModel->deleteEvent($input['eventID']);
                echo json_encode(['success' => true]);
            }
        }
        
    }