<?php
class InterfacultyTournaments{
    use Model;
    protected $table ='interfacultyrecords';

    public function findAllTournaments(){
        $query = "SELECT * FROM $this->table JOIN sport ON interfacultyrecords.sport_id= sport.sport_id"; 
        return $this->query($query);
    }

    public function saveTournament($data) {
        $query = "UPDATE $this->table SET year = :year, first_place = :place1, second_place = :place2, third_place = :place3, no_of_players = :noofplayers, sport_id = :sport_id WHERE interfacrecid = :tournament_id";
        $params = [
            ':tournament_id' => $data['tournamentId'],
            ':year' => $data['date'],
            ':place1' => $data['place1'],
            ':place2' => $data['place2'],
            ':place3' => $data['place3'],
            ':noofplayers' => $data['participants'],
            ':sport_id' => $data['sport_id'],
        ];
        return $this->query($query, $params);
    }

    public function deleteTournament($id) {
        $query = "DELETE FROM $this->table WHERE interfacrecid = :tournament_id";
        $params = [':tournament_id' => $id];
        return $this->query($query, $params);
    }
}