<?php

class Upcomingevent{
    use Model;
    protected $table = 'upcomingevents';
    protected $columns = ['event_name','date','time','venue','sport_id'];

    private function getUserId() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['userid'])) {
            die("User not logged in.");
        }
        return $_SESSION['userid'];
    }

    public function getUpcomingevents(){

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

    public function addUpcomingevent(){

        $userId = $this->getUserId();
       
        if (!$userId) {
            die("User ID not found in session.");
        }

        try{

        $query = "INSERT INTO upcomingevents(event_name,date,time,venue,sport_id)
                VALUES(
                    :event_name,
                    :date,
                    :time,
                    :venue,
                    (SELECT sport_id FROM sports_captain WHERE userid = :userid)
                )";

        $result = $this->query($query,[
            'event_name' => $_POST['event_name'],
            'date' => $_POST['date'],
            'time' => $_POST['time'],
            'venue' => $_POST['venue'],
            'userid' => $userId
        ]);

        return $result;
        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
            return false;
        }
    }
    

    public function editUpcomingevent($id,$event_name, $date, $time, $venue,$userId){

        try{

        $query ="UPDATE upcomingevents
                SET event_name = :event_name,
                    date = :date,
                    time = :time,
                    venue = :venue
                WHERE id = :id AND sport_id = (SELECT sport_id FROM sports_captain WHERE userid = :userid)";
        
        return $this->query($query,[
            'event_name' => $event_name,
            'date' => $date,
            'time' => $time,
            'venue' => $venue,
            'id' => $id,
            'userid' => $userId
        ]);

    }catch(Exception $e){
        $_SESSION['error'] = $e->getMessage();
        return false;
    
    }   
}

    public function deleteUpcomingevent($id){

        try{

            $query = "DELETE FROM upcomingevents WHERE id = :id";
            $result = $this->query($query, ['id' => $id]);

            return $result;

        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
            return false;
        }
    }

}
    
    
        