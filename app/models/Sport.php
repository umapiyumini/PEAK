<?php

class Sport {
    use Model;
    protected $table = 'sport';
    protected $allowedColumns = [
        'sport_id',
        'sport_name'];

    public function findAllSports() {
        $query = "SELECT * FROM $this->table";
        return $this->query($query);        
    }

    public function getSport() {  
        $userId = $this->getUserId(); // Ensure this function exists or define it below

        if (!$userId) {
            die("User ID not found in session.");
        }

        $query = "SELECT sports_captain.userid, sport.*
                  FROM sports_captain
                  JOIN sport ON sports_captain.sport_id = sport.sport_id
                  WHERE sports_captain.userid = :userid";

        $result = $this->query($query, ['userid' => $userId]);
        
        return $result[0] ?? null;
    }

    public function findSportId($sportName) {
        $query = "SELECT sport_id FROM $this->table WHERE sport_name = :sport_name";
        $params = [':sport_name' => $sportName];
        return $this->query($query, $params);
    }

    public function addNewSport($data){
        $query= "INSERT INTO $this->table (sport_name,frontimage) VALUES (:sport_name, :frontimage)";
        $params= [':sport_name' => $data['sport_name'],
                  ':frontimage' => $data['image']];
        return $this->query($query, $params);
    }

    public function getSportDetails($sport_id){
        $query = "SELECT * FROM $this->table d
                JOIN sports_captain C ON c.sport_id = d.sport_id
                LEFT JOIN sportnews n ON n.sport_id = d.sport_id
                LEFT JOIN sport_players p ON p.sport_id = d.sport_id
                LEFT JOIN attendance a ON a.sport_id = d.sport_id
                LEFT JOIN coaches ON coaches.sport_id = d.sport_id
                WHERE d.sport_id= :sport_id";
                
        $params=[':sport_id'=> $sport_id];

        return $this->query($query, $params)[0];
    }
    
}

