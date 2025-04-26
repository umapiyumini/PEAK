<?php

class TournamentRecord
{
    use Model;
    protected $table = 'tournaments_records';

    public function addTournament($year, $sportID, $tournament_name, $category)
    {
        $userID = $this->getUserID();

        // Get the actual sport ID based on logged-in user
        $sportQuery = "SELECT sport_id FROM sports_captain WHERE userid = :userid";
        $sportResult = $this->query($sportQuery, ['userid' => $userID]);

        if (!$sportResult) {
            throw new Exception("Sport ID not found for the current user.");
        }

        $sportID = $sportResult[0]->sport_id;

        $query = "INSERT INTO tournaments_records (year, sport_id, tournament_name, category) 
                  VALUES (:year, :sport_id, :tournament_name, :category)";

        $data = [
            'year' => $year,
            'sport_id' => $sportID,
            'tournament_name' => $tournament_name,
            'category' => $category
        ];



        $this->query($query, $data);
        return $this->db->lastInsertId(); // get the ID of newly added record

    }


    public function getInterfacultyRecords()
    {
        $userID = $this->getUserID();

        $query = "SELECT * FROM tournaments_records
                JOIN sports_captain ON tournaments_records.sport_id = sports_captain.sport_id 
                  WHERE sports_captain.userid = :userid AND tournaments_records.tournament_name = :tournament_name";

        $params = [
            'userid' => $userID,
            'tournament_name' => 'Inter Faculty'

        ];

        return $this->query($query, $params);
    }


    public function lastInsertId() {
        $result = $this->query("SELECT LAST_INSERT_ID()");
        return $result[0]->{"LAST_INSERT_ID()"};
    }
    
    public function deleteRecord($tournament_id)
    {
        $query = "DELETE FROM tournaments_records WHERE recordid = :tournament_id";
        $params = ['recordid' => $tournament_id];
        return $this->query($query, $params);
    }


    public function findInterfacultyRecords(){
        $query= "SELECT * FROM $this->table r
                  JOIN sport s ON  r.sport_id= s.sport_id 
                  WHERE tournament_name= 'Inter Faculty'";

        return $this->query($query);
    }

    public function findFreshersRecords(){
        $query= "SELECT * FROM $this->table r
                  JOIN sport s ON  r.sport_id= s.sport_id 
                  WHERE tournament_name= 'Freshers'";

        return $this->query($query);
    }

    

}
