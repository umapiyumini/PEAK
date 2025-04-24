<?php

class Recruitmentrequests {

    use Model;
    protected $table = 'recruitments';
    protected $allowcolumns = [
        'regno',
        'name',
        'faculty',
        'reason',
        'sport_id',
        'status'
    ];

    public function getUserId(){

        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['userid'])){
            die("User not logged in.");
        }
        return $_SESSION['userid'];
    }

    public function getRecruitmentRequests(){

        $userId = $this->getUserId();
        if(!$userId){
            die("User ID not found in session.");
        }

        try{

        $query = "SELECT recruitments.* FROM sports_captain
                JOIN sport ON sports_captain.sport_id = sport.sport_id
                JOIN recruitments ON sports_captain.sport_id = recruitments.sport_id
                WHERE sports_captain.userid = :userid AND recruitments.status ='pending'";

        return $this->query($query, ['userid' => $userId]);

        }catch(Exception $e){
            die("Error fetching recruitment requests: " . $e->getMessage());
        }

    }

    
    
    

    public function rejectRequest($regno){

        try{

            $query = "UPDATE recruitments SET status = 'reject' WHERE regno = :regno";
            $result = $this->query($query, [
                'regno' => $regno,
               
            ]);

            return $result;
        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
        }
    }
       
    
    public function approverequest($regno){

        try{

            $query = "UPDATE recruitments SET status = 'approved' WHERE regno = :regno";
            $result = $this->query($query, [
                'regno' => $regno,
               
            ]);

            return $result;
        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
        }
    }  
}