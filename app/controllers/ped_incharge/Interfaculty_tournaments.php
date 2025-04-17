<?php
    class Interfaculty_tournaments extends Controller{
        public function index(){
            $tournamentModel = new InterfacultyTournaments();
            $tournamentList = $tournamentModel->findAllTournaments();
            
            $this->view('ped_incharge/interfaculty_tournaments',['tournamentList'=>$tournamentList]);
        }

        public function saveTournament() {
            $sportModel = new Sport();
            $sportid = $sportModel->findSportId($_POST['sportInput']);
            $_POST['sport_id'] = $sportid[0]->sport_id;

            $tournamentModel = new InterfacultyTournaments();
            $tournamentModel->saveTournament($_POST);
            
            header('Location: ' . ROOT . '/ped_incharge/interfaculty_tournaments');
        }

        public function deleteTournament($id) {
            $tournamentModel = new InterfacultyTournaments();
            $tournamentModel->deleteTournament($id);
            
            header('Location: ' . ROOT . '/ped_incharge/interfaculty_tournaments');
        }
    }

