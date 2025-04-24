<?php

class Coachesinstructor{
    use Model;
    protected $table = 'coaches';
    protected $columns = ['name','role', 'email', 'phone', 'address', 'experience', 'sport_id' ];

    public function getCoaches(){

        $userId = $this->getUserId();

        $query = "SELECT sport_captain.sport_id, coaches.*
                FROM sport_captain
                JOIN coaches ON sport_captain.sport_id = coaches.sport_id
                WHERE sport_captain.userid = :userid";

        $result = $this->query($query, ['userid' => $userId]);

        return $result;
    }

}