<?php
class Tournament extends Controller{
   public function index(){

     //  Insert function
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        //Get DATA

     
        $data1 = [
            'tournament_name' => $_POST['tournament_name'],
            'category' => $_POST['category'],
            'year' => $_POST['year']

        ];

        $data2 = [
            'reg_no' => $_POST['reg_no']
        ];


        $data3 = [
            'faculty_name' => $_POST['faculty_name']
        ];

         
         $temptournamentcards = new Temptournament(); 
        //Getting Data1 from the Temptournament model with datas of Tournament name, category and year
        if($temptournamentcards->validate($data1))
        {
            $isInserted = $temptournamentcards->insert($data1);

            if ($isInserted){
                redirect('student/Tournament');
            }
            
        }else {
            $errors = $data1->errors;
            // show($errors);
            $data1  = [
                'errors' => $errors,

            ];       
            $this->view('student/Addtournament',['errors' => $errors]);

        }

        $tempplayers = new Tempplayers(); 
        //Getting Data1 from the Temptournament model with datas of Tournament name, category and year
        if($tempplayers->validate($data2))
        {
            $isInserted = $tempplayers->insert($data2);

            if ($isInserted){
                redirect('student/Tournament');
            }
            
        }else {
            $errors = $data2->errors;
            // show($errors);
            $data2  = [
                'errors' => $errors,

            ];  
            
            $this->view('student/Addtournament',['errors' => $errors]);

        }












    } else {
        $temptournamentcards = new Temptournament();
        $tempplayers = new Tempplayers();
        $tournamentData = $temptournamentcards->getAll1();
        $playerData = $tempplayers->getAll2();
        // show($result);
        $data1 = [
            'tournamentdata' => $tournamentData, 
        ];
        
        $this->view('student/tournament', $data1); 
    }








    
}

    
}