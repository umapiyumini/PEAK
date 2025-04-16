<?php

class Sport {
    use Model;
    protected $table = 'sport';

    public function findAllSports() {
        $query = "SELECT * FROM $this->table";
        return $this->query($query);        
    }
  
    public function findSportId($sportName) {
        $query = "SELECT sport_id FROM $this->table WHERE sport_name = :sport_name";
        $params = [':sport_name' => $sportName];
        return $this->query($query, $params);
    }
}

