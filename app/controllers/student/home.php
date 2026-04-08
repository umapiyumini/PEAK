<?php
class Home extends Controller{
   public function index(){
    
        $studentnotices= new Noticeboard();
        $notices= $studentnotices->findStudentNotices();
        $this->view('student/home',['notices' => $notices]);
    }

   

}