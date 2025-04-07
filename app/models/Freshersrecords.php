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

        $query = "SELECT sports_captain.sport_id,freshersrecords.*
                FROM sports_captain
                JOIN freshersrecords ON sports_captain.sport_id = freshersrecords.sport_id
                WHERE sports_captain.userid = :userid";

        $result = $this->query($query,['userid' => $userId]);
        
        return $result;
    }

    public function getFreshersrecordsId(){

        $userId = $this->getUserId();

        if(!$userId) {
            die("User ID not found in session.");
        }

        $query = "SELECT sports_captain.sport_id,freshersrecords.freshersid
                    FROM sports_captain
                    JOIN freshersrecords ON sports_captain.sport_id = freshersrecords.sport_id
                    WHERE sports_captain.userid = :userid"; 

        $result = $this->query($query,['userid' => $userId]);
        
        return $result;
    }

    public function addFreshersrecords(){

        $userId = $this->getUserId();

        if(!$userId){
            die("User Id not found in session.");
        }

        try{
            $sportquery = "SELECT sport_id FROM sports_captain WHERE userid = :userid";
            $sportresult = $this->query($sportquery, ['userid' => $userId]);
            $_POST['sport_id'] = $sportresult[0]->sport_id;

            if(!$sportresult || count($sportresult) == 0){
                throw new Exception("Sport ID not found for this user");
            }

            $query = "INSERT INTO freshersrecords (tournament_name, year, first_place, second_place, third_place, no_of_players, playersregno, sport_id)
                    VALUES (:tournament_name, :year, :first_place, :second_place, :third_place, :no_of_players, :playersregno, :sport_id)";

            $result = $this->query($query,[
                     'tournament_name' => $_POST['tournament_name'],
                     'year' => $_POST['year'],
                     'first_place' => $_POST['first_place'],
                     'second_place' => $_POST['second_place'],
                     'third_place' => $_POST['third_place'],
                     'no_of_players' => $_POST['no_of_players'],
                     'playersregno' => $_POST['playersregno'],
                     'sport_id' => $_POST['sport_id']
            ]);

            if(is_bool($result)) {
                return $result; 
            }
            return $result->rowCount() > 0;
            
        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
        }

    }

    public function editFreshersrecords($id){

        $userId = $this->getUserId();

        if(!$userId){
            die("User ID not found in session.");
        }

        try{

            $query = "UPDATE freshersrecords
                    SET tournament_name = :tournament_name,
                        year = :year,
                        first_place = :first_place,
                        second_place = :second_place,
                        third_place = :third_place,
                        no_of_players = :no_of_players,
                        playersregno = :playersregno
                    WHERE freshersid =:id
                    AND sport_id = (SELECT sport_id FROM sports_captain WHERE userid = :userid)";

            $result = $this->query($query,[
                'tournament_name' => $_POST['tournament_name'],
                'year' => $_POST['year'],
                'first_place' => $_POST['first_place'],
                'second_place' => $_POST['second_place'],
                'third_place' => $_POST['third_place'],
                'no_of_players' => $_POST['no_of_players'],
                'playersregno' => $_POST['playersregno'],
                'id' => $id,
                'userid' => $userId
            ]);

            if(is_bool($result)) {
                return $result; 
        }

            return $result->rowCount() > 0;
        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
            return false;
        }

    }

    public function deleteFreshersrecords($id){

        $userId = $this->getUserId();

        try{

            $query = "DELETE FROM freshersrecords
                    WHERE freshersid = :id
                    AND SPORT_ID = (SELECT sport_id FROM sports_captain WHERE userid = :userid)";
                    
            $result = $this->query($query,['id' => $id, 'userid' => $userId]);

            if(is_bool($result)) {
                return $result; 
            }
            return $result->rowCount() > 0;


        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
            return false;
        }
    }

        
}