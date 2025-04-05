<?php

class Freshersrecords{

    use Model;
    protected $table = 'freshersrecords';
    protected $columns = ['tournament_name','year','first_place','second_place','third_place','no_of_players','playersregno','sport_id'];

    public function getFreshersrecords(){

        $userId = $this->getUserId();

        if (!$userId) {
            die("User ID not found in session.");
        }

        $query = "SELECT sport_captain.sport_id,freshersrecords.*
                FROM sport_captain
                JOIN freshersrecords ON sport_captain.sport_id = freshersrecords.sport_id
                WHERE sport_captain.userid = :userid";

        $result = $this->query($query,['userid' => $userId]);
        
        return $result;
    }
}