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
}
