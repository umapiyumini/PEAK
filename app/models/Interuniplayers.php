<?php
class Interuniplayers{
    use Model;
    protected $table ='interuni_player';

    public function getParticipantsByTournamentId($tournamentId){
        $query = "SELECT regno FROM $this->table WHERE interrecordid = :tournamentId";
        $params = [':tournamentId' => $tournamentId];
        return $this->query($query, $params);
    }

    public function findTournamentByReg($regno){
        $query = "SELECT i.interrecordid, i.tournament_name, i.date, i.place, ip.regno, s.sport_name FROM interuni_player ip
        JOIN interuniversityrecords i ON ip.interrecordid = i.interrecordid 
        JOIN sport s ON i.sport_id = s.sport_id
        WHERE ip.regno = :regno"; 
        $params = [':regno' => $regno];
        return $this->query($query, $params);
    }
}