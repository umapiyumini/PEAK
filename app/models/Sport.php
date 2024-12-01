<?php

class Sport {
    use Model;
    protected $table = 'sport';

    public function findAllSports() {
        $query = "SELECT * FROM $this->table";
        return $this->query($query);
    }
}