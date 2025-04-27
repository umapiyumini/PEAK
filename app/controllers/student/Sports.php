<?php
class Sports extends Controller{
   public function index(){

        $sportdetails = new Sport();
        $sport = $sportdetails->findAllSports();
        $this->view('student/sports',['sport' => $sport]);


    }

   

}