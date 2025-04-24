<?php
    class Interfaculty_tournaments extends Controller{
        public function index(){
            $tournamentModel = new InterfacultyTournaments();
            $tournamentList = $tournamentModel->findAllTournaments();

            $freshersModel = new Freshers();
            $freshersList = $freshersModel->findAllTournaments();
            
            $this->view('ped_incharge/interfaculty_tournaments',['tournamentList'=>$tournamentList, 'freshersList'=>$freshersList]);
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

        public function saveFreshersTournament() {
            $sportModel = new Sport();
            $sportid = $sportModel->findSportId($_POST['sportInput']);
            $_POST['sport_id'] = $sportid[0]->sport_id;

            $tournamentModel = new Freshers();
            $tournamentModel->saveFreshersTournament($_POST);
            
            header('Location: ' . ROOT . '/ped_incharge/interfaculty_tournaments');
        }

        public function deleteFreshersTournament($id) {
            $tournamentModel = new freshers();
            $tournamentModel->deleteFreshersTournament($id);
            
            header('Location: ' . ROOT . '/ped_incharge/interfaculty_tournaments');
        }

        public function getParticipants($tournamentId){
            $tournamentPlayerModel = new Interfaculty_player();
            $participants = $tournamentPlayerModel->getParticipantsByTournamentId($tournamentId);
            echo json_encode($participants);
        }

    }

