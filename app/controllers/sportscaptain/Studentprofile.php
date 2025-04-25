<?php
class Studentprofile extends Controller{
        public function index(){

            $studentModel = new Student();
            $sportModel = new Sport_Player();
            $interuniModel = new Interuniplayers();

            $studentDetails = $studentModel->getStudentInfo($regno);
            $sports = $sportModel->findSportsByReg($regno);
            $interuni = $interuniModel->findTournamentByReg($regno);
           

        $this->view('sportscaptain/studentprofile', ['studentDetails' => $studentDetails, 'sports' => $sports, 'interuni' => $interuni]);
    }

} 

