<?php
class Colorsnight extends Controller{
   public function index(){

        $this->view('sportscaptain/colorsnight');
    }

   public function addformdetails(){

            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                try{

                    $colorsnightModel = new ColorsNight();
                    $coloursnight = $colorsnightModel->addFormdetails();

                    if($coloursnight){
                        $_SESSION['success'] = 'Data added successfully';
                    }else{
                        $_SESSION['error'] = 'Failed to add data';
                    }
                }catch(Exception $e){

                    $_SESSION['error'] = $e->getMessage();
                }

            }

            header('location: ' .ROOT . '/sportscaptain/colorsnight');
            exit();
  
   }

}