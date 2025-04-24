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

        $this->view('sportscaptain/excuse',['excuse' => $excuse]);

        
    }

    public function addexcusedata(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

           

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