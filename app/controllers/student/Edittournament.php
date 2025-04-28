<?php
class Edittournament extends Controller{
   public function index(){
      $Tournamentid = $_GET['Tournamentid'];
        
    // show($id);
    $data = [
        'Tournamentid' => $Tournamentid,
    ];
        $this->view('student/edittournament',$data);
    }

   

}