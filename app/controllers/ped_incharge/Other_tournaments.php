<?php
    class Other_tournaments extends Controller{
        public function index(){
            // $tournamentModel = new OtherTournaments();
            // $tournamentList = $tournamentModel->findAllTournaments();
            
            $this->view('ped_incharge/other_tournaments');
        }

        // public function saveTournament() {
        //     $sportModel = new Sport();
        //     $sportid = $sportModel->findSportId($_POST['sportInput']);
        //     $_POST['sport_id'] = $sportid[0]->sport_id;

        //     $tournamentModel = new OtherTournaments();
        //     $tournamentModel->saveTournament($_POST);
            
        //     header('Location: ' . ROOT . '/ped_incharge/other_tournaments');
        // }

        // public function deleteTournament($id) {
        //     $tournamentModel = new OtherTournaments();
        //     $tournamentModel->deleteTournament($id);
            
        //     header('Location: ' . ROOT . '/ped_incharge/other_tournaments');
        // }
    }

