<?php

class Tournamentrecords extends Controller{

    public function index(){

        $interuniModel = new Interunirecords();
        $record = $interuniModel->getIntrunirecords();

        $this->view('sportscaptain/tournamentrecords',['record' => $record]);
    }

    public function addinterunirecords(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            try{
                $interuniModel = new Interunirecords();
                $result = $interuniModel->addInterunirecords();
                if($result){
                    $_SESSION['success'] = 'Interuniversity record added successfully';
                }else{
                    $_SESSION['error'] = 'Faild to add interuniversity record';
                }
                }catch(Exception $e){
                    $_SESSION['error'] = $e->getMessage();
                }
            }
            header('Location: ' . ROOT . '/sportscaptain/tournamentrecords');
            exit();
        }
    
    public function deleteinterunirecords() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['interunirecordid'] ?? null;
            if(!$id) {
                $_SESSION['error'] = 'Interuniversity record ID is required';
                header('Location:' . ROOT . '/sportscaptain/tournamentrecords');
                exit();
            } else {
                try {
                    $interuniModel = new Interunirecords();
                    $result = $interuniModel->deleteInterunirecords($_POST['interunirecordid']);
                    if($result) {
                        $_SESSION['success'] = 'Interuniversity record deleted successfully';   
                    } else {
                        $_SESSION['error'] = 'Failed to delete interuniversity record';   
                    }
                } catch(Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                }   
            }
            header('Location:' . ROOT . '/sportscaptain/tournamentrecords');
            exit();
        }
    }

    public function editinterunirecords() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['interunirecordid'] ?? null;
            if(!$id) {
                $_SESSION['error'] = 'Interuniversity record ID is required';
                header('Location: ' . ROOT . '/sportscaptain/tournamentrecords');
                exit();
            } else {
                try {
                    $interuniModel = new Interunirecords();
                    $result = $interuniModel->editInterunirecords($id);
                    if($result) {
                        $_SESSION['success'] = 'Interuniversity record update successfully';
                    } else {
                        $_SESSION['error'] = 'Failed to update interuniversity record';
                    }
                } catch(Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                }
            }
            header('Location: ' . ROOT . '/sportscaptain/tournamentrecords');
            exit();
        }
    } 

}