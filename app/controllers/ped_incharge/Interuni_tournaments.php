<?php
    class Interuni_tournaments extends Controller{
        public function index(){
            $tournamentModel = new InteruniTournaments();
            $tournamentList = $tournamentModel->findAllTournaments();

            $this->view('ped_incharge/interuni_tournaments',['tournamentList'=>$tournamentList]);
        }

        public function saveTournament() {
            $sportModel = new Sport();
            $sportid = $sportModel->findSportId($_POST['sportInput']);
            $_POST['sport_id'] = $sportid[0]->sport_id;

            show($_POST);

            $tournamentModel = new InteruniTournaments();
            $tournamentModel->saveTournament($_POST);
            
            header('Location: ' . ROOT . '/ped_incharge/interuni_tournaments');
        }

        public function deleteTournament($id) {
            $tournamentModel = new InteruniTournaments();
            $tournamentModel->deleteTournament($id);
            
            header('Location: ' . ROOT . '/ped_incharge/interuni_tournaments');
        }

        public function getParticipants($tournamentId){
            $tournamentPlayerModel = new Interuniplayers();
            $participants = $tournamentPlayerModel->getParticipantsByTournamentId($tournamentId);
            echo json_encode($participants);
        }
    }

