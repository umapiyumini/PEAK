<?php
class Recruitment extends Controller{
   public function index(){

        $recruitmentModel = new Recruitmentrequests();
        $recritmentrequest = $recruitmentModel->getRecruitmentRequests();

        $this->view('sportscaptain/recruitment', ['recritmentrequest' => $recritmentrequest]);
    }

   

}