<?php
class Medical extends Controller{
   public function index(){

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            //Get DATA

            $data = [
                'Name' => $_POST['Name'],
                'RegistrationID' => $_POST['RegistrationID'],
                'ReasonForMedical' => $_POST['ReasonForMedical'],
                'TimePeriod' => $_POST['TimePeriod'],  
            ];

            $medicalrequest = new MedicalRequest();

            if($medicalrequest->validate($data))
            {
                $isInserted = $medicalrequest->insert($data);

                if (!$isInserted){
                    redirect('student/Addmedical');
                }
            }
        } else {
            $this->view('student/medical'); 
        }
    }

}