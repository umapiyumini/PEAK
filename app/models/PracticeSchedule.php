<?php

class PracticeSchedule{

    use Model;
    protected $table = 'practiceschedule';
    protected $allowcolumns = [
        'date',
        'start_time',
        'end_time',
        'category',
        'sport_id'
    ];

    private function getUserId() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['userid'])) {
            die("User not logged in.");
        }
        return $_SESSION['userid'];
    }

    public function getSchedule(){

        $userId = $this->getUserId();

        if (!$userId) {
            die("User ID not found in session.");
        }

        try{
        $query = "SELECT practiceschedule.*, sport.sport_id
                    FROM sports_captain
                    JOIN practiceschedule ON sports_captain.sport_id = practiceschedule.sport_id
                    JOIN sport ON sports_captain.sport_id = sport.sport_id
                    WHERE sports_captain.userid = :userid";

        $result = $this->query($query, ['userid' => $userId]);

        return $result;

        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
        }
    }

    public function addSchedule(){

        $userId = $this->getUserId();

        if(!$userId){
            die("User Id not found in session.");
        }

        try{

            $sportQuery = "SELECT sport_id FROM sports_captain WHERE userid = :userid LIMIT 1";
            $sportResult = $this->query($sportQuery, ['userid' => $userId]);
            
            if ($sportResult && count($sportResult) > 0) {
                $sport_id = $sportResult[0]->sport_id;
                
                $query = "INSERT INTO practiceschedule (date, start_time, end_time,category, sport_id)
                         VALUES (:date, :start_time, :end_time,:category, :sport_id)";
                         
                $result = $this->query($query, [
                    'date' => $_POST['date'],
                    'start_time' => $_POST['start_time'],
                    'end_time' => $_POST['end_time'],
                    'category' => $_POST['category'],
                    'sport_id' => $sport_id
                ]);

            if(is_bool($result)) {
                return $result; 
            }
            return $result->rowCount() > 0;
            }

        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
        }
    }

    public function deleteSchedule($id){

        try{

        $query = "DELETE FROM practiceschedule WHERE scheduleid = :scheduleid";
        $result = $this->query($query, ['sheduleid' => $id]);

        if(is_bool($result)) {
            return $result; 
        }

        return $result->rowCount() > 0;

        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
        }
    }

    public function editSchedule($id, $date, $start_time, $end_time,$category){

        $userId = $this->getUserId();

        if(!$userId){
            die("User Id not found in session.");
        }

        try{

            $sportQuery = "SELECT sport_id FROM sports_captain WHERE userid = :userid LIMIT 1";
            $sportResult = $this->query($sportQuery, ['userid' => $userId]);

            if ($sportResult && count($sportResult) > 0) {
                $sport_id = $sportResult[0]->sport_id;

                $query = "UPDATE practiceschedule
                        SET date = :date, start_time = :start_time, end_time = :end_time, category = :category
                        WHERE scheduleid = :scheduleid AND sport_id = :sport_id";
                
                $result = $this->query($query, [
                    'date' => $date, 
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'category' => $category,
                    'scheduleid' => $id,
                    'sport_id' => $sport_id
                ]);

                if(is_bool($result)) {
                    return $result; 
                }

                 return $result->rowCount() > 0;

            }
                return false;

        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
            return false;
        }
    }
}

    
