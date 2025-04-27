<?php
class Profile extends Controller{
   public function index(){

        $studentdetails = new Student();
        $student = $studentdetails->find($_SESSION['userid']);
        $details = $studentdetails->getStudent($student->userid);


      
        

        $this->view('student/profile',['details' => $details]);
    }

    

}