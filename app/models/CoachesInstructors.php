<?php

class CoachesInstructors{
    use Model;
    protected $table = 'coaches';
    protected $columns = ['name','role', 'email', 'phone', 'address', 'experience', 'sport_id' ];

    public function getCoaches(){

        $userId = $this->getUserId();

        $query = "SELECT sports_captain.sport_id, coaches.*
                FROM sports_captain
                JOIN coaches ON sports_captain.sport_id = coaches.sport_id
                WHERE sports_captain.userid = :userid";

        $result = $this->query($query, ['userid' => $userId]);

        return $result;
    }

}