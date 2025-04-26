<?php

class TournamentPlayers
{
    use Model;

    protected $table = 'tournaments_players'; // correct table name


    public function addPlayer($place_id, $reg_no)
    {
        $query = "INSERT INTO tournaments_players (place_id, reg_no) VALUES (:place_id, :reg_no)";
        $params = [
            'place_id' => $place_id,
            'reg_no' => $reg_no
        ];
        return $this->query($query, $params);
    }



    public function findPlayersByPlaceId($place_id) {
        $query = "SELECT * FROM $this->table WHERE place_id = $place_id";
        return $this->query($query);
    }


    public function findTournamentOfPlayers($reg_no){
        $query = "SELECT * FROM $this->table p
                JOIN tournament_place tp ON tp.placeid = p.place_id
                JOIN tournaments_records tr ON tr.recordid = tp.tournament_id
                JOIN sport s ON s.sport_id = tr.sport_id
                WHERE reg_no= '$reg_no'";

        return $this->query($query);
    }

}
