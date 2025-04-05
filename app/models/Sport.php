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

    
}