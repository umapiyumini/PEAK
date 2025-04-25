<?php

class Tempplayers
{
    use Model;
    protected $table = 'temp_players';

    public function getPlayers($tournament_id,$faculty_id)
    {
        $query = "SELECT reg_no FROM temp_players WHERE temp_tournament_id = :tournament_id AND faculty_id = :faculty_id";

        $params = [
            'tournament_id' => $tournament_id,
            'faculty_id' => $faculty_id
        ];

        return $this->query($query, $params);
    }
}
