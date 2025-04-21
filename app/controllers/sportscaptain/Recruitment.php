<?php
class Recruitment extends Controller{
   public function index(){

        $recruitmentModel = new Recruitmentrequests();
        $recritmentrequest = $recruitmentModel->getRecruitmentRequests();

        $this->view('sportscaptain/recruitment', ['recritmentrequest' => $recritmentrequest]);
    }

   public function approverequest($regno = null){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
        $regno = $_POST['regno'] ?? $regno ?? null;

          if(!$regno){
                $_SESSION['error'] = 'Registration number is required';
                header('Location:' . ROOT . '/sportscaptain/recruitment');
                exit();
          }

    try{

        $recruitmentModel = new Recruitmentrequests();
        $request = $recruitmentModel->approveRequest($regno);

        if($request){
            $_SESSION['success'] = 'Request approved successfully';
        }else{
            $_SESSION['error'] = 'Failed to approve request';
        }

    }catch(Exception $e){
        $_SESSION['error'] = $e->getMessage();
    }
   }
   header('location: ' .ROOT . 'sportscaptain/recruitment');
   exit();

   }

   public function rejectrequest($regno = null){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
        $regno = $_POST['regno'] ?? $regno ?? null;

          if(!$regno){
                $_SESSION['error'] = 'Registration number is required';
                header('Location:' . ROOT . '/sportscaptain/recruitment');
                exit();
          }

    try{

        $recruitmentModel = new Recruitmentrequests();
        $request = $recruitmentModel->rejectRequest($regno);

        if($request){
            $_SESSION['success'] = 'Request rejected';
        }else{
            $_SESSION['error'] = 'Failed to reject request';
        }

    }catch(Exception $e){
        $_SESSION['error'] = $e->getMessage();
    }
   }
   header('location: ' .ROOT . 'sportscaptain/recruitment');
   exit();

   }
}