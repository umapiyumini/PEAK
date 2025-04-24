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
}