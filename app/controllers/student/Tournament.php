<?php
class Tournament extends Controller{
   public function index(){

    //  Insert function
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        //Get DATA

        $teamplayersdata = [
            'reg_no' => $_POST['reg_no']
        ];

        $temptournamentcards = [
            'tournament_name' => $_POST['tournament_name'],
            'category' => $_POST['category'],
            'year' => $_POST['year']

        ];

        $facultydata = [
            'faculty_name' => $_POST['faculty_name'];
        ]

        $entryrequest = new Teamrequest();
        $entryrequest = new Tempplayers();
        $entryrequest = new Faculty();



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

   

