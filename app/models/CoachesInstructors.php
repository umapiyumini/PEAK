<?php

class CoachesInstructors{
    use Model;
    protected $table = 'coaches';
    protected $columns = ['name','role', 'email', 'phone', 'address', 'experience', 'sport_id','image' ];

    public function getCoaches(){

        $userId = $this->getUserId();

        $query = "SELECT sports_captain.sport_id, coaches.*
                FROM sports_captain
                JOIN coaches ON sports_captain.sport_id = coaches.sport_id
                WHERE sports_captain.userid = :userid";

        $result = $this->query($query, ['userid' => $userId]);

        return $result;
    }

    public function getCoachesBySport($sportid){
        $query = "SELECT * FROM $this->table WHERE sport_id = $sportid";
        return $this->query($query);
    }

    public function addNewCoach($data) {
        $query = "INSERT INTO $this->table (name, role, email, phone, nic, address, experience, sport_id) VALUES (:name, :role, :email, :phone, :nic, :address, :experience, :sport_id)";
        $params = [
            ':name' => $data['name'],
            ':role' => $data['role'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':nic' => $data['nic'],
            ':address' => $data['address'],
            ':experience' => $data['bio'],
            ':sport_id' => $data['sportid']
        ];
        return $this->query($query, $params);
    }

    public function getCoachDetails($coachid) {
        $query = "SELECT * FROM $this->table WHERE empid = $coachid";
        return $this->query($query)[0];
    }

    public function editCoach($data) {
        $query = "UPDATE $this->table SET name = :name, role = :role, email = :email, phone = :phone, nic = :nic, address = :address, experience = :experience WHERE empid = :empid";
        $params = [
            ':name' => $data['name'],
            ':role' => $data['role'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':nic' => $data['nic'],
            ':address' => $data['address'],
            ':experience' => $data['bio'],
            ':empid' => $data['empid']
        ];
        return $this->query($query, $params);
    }

    public function deleteCoach($coachid) {
        $query = "DELETE FROM $this->table WHERE empid = $coachid";
        return $this->query($query);
    }

}