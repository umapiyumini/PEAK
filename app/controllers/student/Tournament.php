<?php
class Tournament extends Controller{
   public function index(){

    //  Insert function
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        //Get DATA

        $data = [
            'Name' => $_POST['Name'],
            'RegistrationID' => $_POST['RegistrationID'],
            'ReasonForMedical' => $_POST['ReasonForMedical'],
            'TimePeriod' => $_POST['TimePeriod'],  
            'userid' => $_SESSION['userid']
        ];

        $medicalrequest = new MedicalRequest();

        if($medicalrequest->validate($data))
        {
            $isInserted = $medicalrequest->insert($data);

            if (!$isInserted){
                redirect('student/medical');
            }
            
        }else {
            $errors = $medicalrequest->errors;
            // show($errors);
            $data  = [
                'errors' => $errors,

            ];
            
            $this->view('student/Editmedical',['errors' => $errors]);

        }
    } else {
        $medicalrequest = new MedicalRequest();
        $medicalData = $medicalrequest->where(['userid' => $_SESSION['userid']]);
        // show($result);
        $data = [
            'medicaldata' => $medicalData, 
        ];
        
        $this->view('student/tournament', $data); 
    }
}


    }

   

