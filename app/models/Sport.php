<?php

class Sport {
    use Model;
    protected $table = 'sport';
    protected $allowed_columns = [
        'sport_id',
        'sport_name'

    ];

    public $studenterrors = [];

    public function validate($data) {
        //check if registrationnumber is empty
        if (empty($data['sport_name'])) {
            $this->sporterrors['sport_name'] = 'Sport Name is required';
        }

         


        //return true if no errors
        return empty($this->sporterrors);
    }

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

    
}

