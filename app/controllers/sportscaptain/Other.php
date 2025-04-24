<?php

class Other extends Controller{

    public function index(){

        $otherModal = new Othertournaments();
        $record = $otherModal-> getotherrecords();

        $this->view('sportscaptain/other',['otherrecords' => $record]);
    }

    public function addothertournaments(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            try{
                $otherModal = new Othertournaments();
                $result = $otherModal->addOtherRecords();
                if($result){
                    $_SESSION['success'] = 'Other tournaments record added successfully';
                }else{
                    $_SESSION['error'] = 'Failed to add other tournaments record';
                }
            }catch(Exception $e){
                $_SESSION['error'] = $e->getMessage();
            }
        }

        header('Location: ' . ROOT . '/sportscaptain/other');
        exit();
     }

     public function editothertournaments(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

    
            $id = $_POST['tournamentid'] ?? null;
            if(!$id){
                $_SESSION['error'] = 'Other tournaments ID is required';
                header('Location: ' . ROOT . '/sportscaptain/other');
                exit();
            }else{

                try{
                    $otherModal = new Othertournaments();
                    $result = $otherModal->editOtherRecords($id);

                    if($result){
                        $_SESSION['success'] = 'Other tournaments record updated successfully';
                    }else{
                        $_SESSION['error'] = 'Failed to update other tournaments record - no rows affected';
                    }
                }catch(Exception $e){
                    $_SESSION['error'] = $e->getMessage();
                }
            }
        }
        header('Location: ' . ROOT . '/sportscaptain/other');
        exit();
     }

        public function deleteothertournaments(){
    
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
                $id = $_POST['tournamentid'] ?? null;
                if(!$id){
    
                    $_SESSION['error'] = 'Other tournaments ID is required';
                    header('Location: ' . ROOT . '/sportscaptain/other');
                    exit();
                }else{
    
                    try{
                        $otherModal = new Othertournaments();
                        $result = $otherModal->deleteOtherRecords($id);
                        if($result){
                            $_SESSION['success'] = 'Other tournaments record deleted successfully';
                        }else{
                            $_SESSION['error'] = 'Failed to delete other tournaments record - no rows affected';
                        }
                    }catch(Exception $e){
                        $_SESSION['error'] = $e->getMessage();
                    }
                }
            }
            header('Location: ' . ROOT . '/sportscaptain/other');
            exit();

        }

}