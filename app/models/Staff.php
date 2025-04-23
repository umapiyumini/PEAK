<?php
class Staff{
    use Model;
    protected $table ='staff';

    public function findAllPedStaff(){
        $query = "SELECT * FROM $this->table WHERE type='ped'"; 
        return $this->query($query);
    }

    public function findAllGroundIndoorStaff(){
        $query = "SELECT * FROM $this->table WHERE type='ground' OR type='indoor'"; 
        return $this->query($query);
    }

    public function getStaffType($userid){

        $query = "SELECT type FROM $this->table 
                JOIN user ON staff.userid = user.userid
                WHERE user.userid = :userid";

        $result = $this->query($query, ['userid' => $userid]);

        return $result;

    }
}