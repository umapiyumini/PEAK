<?php

class Faculties {

    use Model;
    protected $table = 'faculties';

    public function getAllFaculties() {
        $query = "SELECT * FROM faculties";
        return $this->query($query);
    }

    
}
    