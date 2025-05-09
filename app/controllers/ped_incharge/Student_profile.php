<?php
    class Student_profile extends Controller{
        public function index($regno){
            $studentModel = new Student();
            $sportModel = new Sport_Player();
            $interuniModel = new Interuniplayers();
            $tournamentModel = new TournamentPlayers();

            $studentDetails = $studentModel->getStudentInfo($regno);
            $sports = $sportModel->findSportsByReg($regno);
            $interuni = $interuniModel->findTournamentByReg($regno);
            $tournament = $tournamentModel->findTournamentOfPlayers($regno);
            $this->view('ped_incharge/student_profile', ['studentDetails' => $studentDetails, 'sports' => $sports, 'interuni' => $interuni, 'tournament'=>$tournament]);
        }
    }