<?php
class Retrieve extends Controller{
   public function index(){

    //Retreiving the count of students from the backend to frontend
    $tournamentreq = new Tournaments();
    $details = $tournamentdetails->find($tournamentreq->Sport);

    


        $this->view('amalgamated/retrieve',['details' => $details]);
    }

   

}