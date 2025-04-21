<?php
class Interfaculty_player{
    use Model;
    protected $table ='interfaculty_player';

    public function getParticipantsByTournamentId($tournamentId){
        $query = "SELECT regno FROM $this->table WHERE interfacrecid = :tournamentId";
        $params = [':tournamentId' => $tournamentId];
        return $this->query($query, $params);
    }

    public function findTournamentByReg($regno){
        $query = "SELECT i.interfacrecid, i.tournament_name, i.year, i.first_place, i.second_place, i.third_place, ip.regno, s.sport_name FROM interfaculty_player ip
        JOIN interfacultyrecords i ON ip.interfacrecid = i.interfacrecid 
        JOIN sport s ON i.sport_id = s.sport_id
        WHERE ip.regno = :regno"; 
        $params = [':regno' => $regno];
        return $this->query($query, $params);
    }
}