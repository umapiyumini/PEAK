<?php
class Profile extends Controller{
   public function index(){

        $studentdetails = new Student();
        $details = $studentdetails->getStudent($userid);
    
        $this->view('student/profile',['details' => $details]);

        $this->view('student/profile');
    }

   

}