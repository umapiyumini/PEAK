<?php

class Upcomingevent{
    use Model;
    protected $table = 'upcomingevents';
    protected $columns = ['event_name','date','time','venue','sport_id'];

    public function getupcomingevents(){

        $userId = $this->getUserId();

        if (!$userId) {
            die("User ID not found in session.");
        }

        $query = "SELECT sports_captain.sport_id, upcomingevents.*
                FROM sports_captain
                JOIN upcomingevents ON sports_captain.sport_id = upcomingevents.sport_id
                WHERE sports_captain.userid = :userid";

        $result = $this->query($query,['userid' => $userId]);

        return $result;
    }

    public function addupcomingevent(){

        $userId = $this->getUserId();
       
        if (!$userId) {
            die("User ID not found in session.");
        }

        $query = "INSERT INTO upcomingevents(event_name,date,time,venue,sport_id)
                VALUES(
                    :event_name,
                    :date,
                    :time,
                    :venue,
                    (SELECT sport_id FROM sports_captain WHERE userid = :userid),
                )";

        $result = $this->query($query,[
            'event_name' => $_POST['event_name'],
            'date' => $_POST['date'],
            'time' => $_POST['time'],
            'venue' => $_POST['venue'],
            'userid' => $userId
        ]);

        return $result;
    }
}