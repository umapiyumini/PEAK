<?php

class TournamentPlaces
{
    use Model;
    protected $table = 'tournament_place';

    public function getTournamentPlaces($tournament_id)
    {
        $query = "SELECT tournament_place.*,faculties.faculty_name FROM tournament_place 
                JOIN tournaments_records ON tournament_place.tournament_id = tournaments_records.recordid 
                JOIN faculties ON tournament_place.faculty_id = faculties.facultyid 
                WHERE tournament_place.tournament_id = :tournament_id";
        return $this->query($query, ['tournament_id' => $tournament_id]);
    }

    public function addTournamentPlaces($tournament_id, $place, $faculty_id)
    {
        $query = "INSERT INTO tournament_place (tournament_id, place, faculty_id) 
                  VALUES (:tournament_id, :place, :faculty_id)";

        $params = [
            'tournament_id' => $tournament_id,
            'place' => $place,
            'faculty_id' => $faculty_id
        ];

        return $this->query($query, $params);
    }

    public function finddd($rr) {
        $query = "SELECT * FROM tournament_place tp 
        JOIN faculties f ON f.facultyid= tp.faculty_id
        where tp.tournament_id = $rr->recordid ORDER BY place ASC";
        return $this->query($query);
    }
}
