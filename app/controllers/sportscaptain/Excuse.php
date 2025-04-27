<?php
class Excuse extends Controller{

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


        $excuseModel = new AttendenceExcuse();
        $excuse = $excuseModel->getRequestBySport();

        $facultyModel = new Faculties();
        $faculties = $facultyModel->getAllFaculties();

        $this->view('sportscaptain/excuse',['excuse' => $excuse,'faculties' => $faculties]);

        
    }

    public function addexcusedata(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            // $faculty = $_POST['faculty'];
            // $tournament_name = $_POST['tournament_name'];
            // $start_date = $_POST['start_date'];
            // $end_date = $_POST['end_date'];
            //$reg_no = $_POST['reg_no[]'];
            // $submit_date = $_POST['submit_date'];
            // $status = $_POST['status'];
            


            // /*validations*/
            // if(empty($faculty) || empty($tournament_name) || empty($start_date) || empty($end_date) || empty($reg_no) || empty($submit_date)){
            //     $_SESSION['error'] = 'All fields are required';
            //     header('Location: ' . ROOT . '/sportscaptain/excuse');
            //     exit();
            // }

            // $playerModel = new Players();
            // $player = $playerModel->getPlayers();
            // $playerRegNos = array_column($player, 'regno');
            // $invalidRegNos = array_diff($reg_no, $playerRegNos);
            // if (!empty($invalidRegNos)) {
            //     $_SESSION['error'] = 'Invalid registration numbers: ' . implode(', ', $invalidRegNos);
            //     header('Location: ' . ROOT . '/sportscaptain/excuse');
            //     exit();
            // }
            



            try{

                $excuseModel = new AttendenceExcuse();
                $excuse = $excuseModel->insertExcusedata();
                if($excuse){
                    $_SESSION['success'] = 'Attendance excuse letter added successfully';
                    
                }else{
                    $_SESSION['error'] = 'Failed to add attendance excuse letter';
                    
                }
            }catch(Exception $e){
                $_SESSION['error'] = $e->getMessage();
            }
        }

        header('Location: ' . ROOT . '/sportscaptain/excuse');
        exit();
    }
   

}