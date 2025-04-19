<?php
class Transport extends Controller{
   public function index(){

        $transportModal = new TransportRequests();
        $requests = $transportModal->getRequests();

        $this->view('sportscaptain/transport',['requests' => $requests]);
    }

   public function addtransportrequest(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            try{

                $transportModel = new TransportRequests();
                $transport = $transportModel->insertRequestTransport();
                if($transport){
                    $_SESSION['success'] = 'Transport request added successfully';
                }else{
                    $_SESSION['error'] = 'Failed to add transport request';
                }
            }catch(Exception $e){
                $_SESSION['error'] = $e->getMessage();
            }
        }
        header('Location: ' . ROOT . '/sportscaptain/transport');
        exit();
   }

}