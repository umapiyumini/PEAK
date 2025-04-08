<?php
class Hostal extends Controller{
   public function index(){ 

        
            $hostalModel = new HostalFacilities();
            $hostal_request = $hostalModel->getHostalData();
            
            $this->view('sportscaptain/hostal', ['hostal' => $hostal_request]);
          
    }

    public function insertrequest(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            try{

                $hostalModel = new HostalFacilities();
                $hostal = $hostalModel->insertRequesthostal();
                if($hostal){
                    $_SESSION['success'] = 'Hostal request added successfully';
                    
                }else{
                    $_SESSION['error'] = 'Failed to add hostal request';
                    
                }
            }catch(Exception $e){
                $_SESSION['error'] = $e->getMessage();
            }
        }

        header('Location: ' . ROOT . '/sportscaptain/hostal');
        exit();
    }

   

}