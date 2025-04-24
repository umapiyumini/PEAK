<?php
class Tournament extends Controller{
   public function index(){

    //  Insert function
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        //Get DATA

        $data1 = [
            'tournament_name' => $_POST['tournament_name'],
            'tournament_date' => $_POST['tournament_date'],
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

   

