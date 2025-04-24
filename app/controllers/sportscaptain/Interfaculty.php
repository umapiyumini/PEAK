<?php

class Interfaculty extends Controller{

    public function index(){

        $temptournamentModel = new Temptournament();
        $record = $temptournamentModel->getTempRecords();

        $this->view('sportscaptain/interfaculty',['record'=>$record]);
    }

    public function getplayers(){

        $tempplayers = new Tempplayers();
        $record = $tempplayers->getPlayers($_POST['tournament_id']);
        $players = [];
        foreach($record as $row){
            $players[] = $row['reg_no'];
        }
        echo json_encode($players);
        exit;
        
    }

}