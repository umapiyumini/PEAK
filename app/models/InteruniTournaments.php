<?php
class InteruniTournaments{
    use Model;
    protected $table ='interuniversityrecords';

    public function findAllTournaments(){
        $query = "SELECT * FROM $this->table JOIN sport ON interuniversityrecords.sport_id= sport.sport_id"; 
        return $this->query($query);
    }

    public function saveTournament($data) {
        $query = "UPDATE $this->table SET tournament_name = :tournament_name, date = :date, place = :place, venue = :venue, no_of_players = :noofplayers, sport_id = :sport_id, men_women = :men_women WHERE interrecordid = :tournament_id";
        $params = [
            ':tournament_id' => $data['tournamentId'],
            ':tournament_name' => $data['name'],
            ':date' => $data['date'],
            ':place' => $data['place'],
            ':venue' => $data['venue'],
            ':noofplayers' => $data['participants'],
            ':sport_id' => $data['sport_id'],
            ':men_women' => $data['men_women']
        ];
        return $this->query($query, $params);
    }

    public function deleteTournament($id) {
        $query = "DELETE FROM $this->table WHERE interrecordid = :tournament_id";
        $params = [':tournament_id' => $id];
        return $this->query($query, $params);
    }
}