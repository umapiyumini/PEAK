<?php 

class Interunirecords{
    use Model;
    protected $table = 'interuniversityrecords';
    protected $columns = ['tournament_name','year','place','venue','no_of_players','sport_id'];

    public function getIntrunirecords(){

        $userId = $this->getUserID();

        if (!$userId) {
            die("User ID not found in session.");
        }

        $query = "SELECT sports_captain.sport_id,interuniversityrecords.*
                FROM sports_captain
                JOIN interuniversityrecords ON sports_captain.sport_id = interuniversityrecords.sport_id
                WHERE sports_captain.userid = :userid";
            
        $result = $this->query($query,['userid' =>$userId]);

        return $result;
    }

    public function getInterunirecordsId(){

        $userId = $this->getUserId();

        if(!$userId) {
            die("User ID not found in session.");
        }

        $query =  "SELECT sports_captain.sport_id,interuniversityrecords.interrecordid
                    FROM sports_captain
                    JOIN interuniversityrecords ON sports_captain.sport_id = interuniversityrecords.sport_id
                    WHERE sports_captain.userid = :userid"; 

        $result = $this->query($query,['userid' => $userId]);
        
        return $result;
    }

    public function addInterunirecords(){

        $userId = $this->getUserId();

        if(!$userId){
            die("User Id not found in session.");
        }

        try{

            $sportQuery = "SELECT sport_id FROM sports_captain WHERE userid = :userid";
            $sportResult = $this->query($sportQuery, ['userid' => $userId]);
            $_POST['sport_id'] = $sportResult[0]->sport_id;
            
            if(!$sportResult || count($sportResult) == 0){
                throw new Exception("Sport ID not found for this user");
            }
            
            $sportId = $sportResult[0]->sport_id;

            $query = "INSERT INTO interuniversityrecords 
          (tournament_name, year, place, venue, no_of_players, players_Regno, sport_id)
          VALUES 
          (:tournament_name, :year, :place, :venue, :no_of_players, :players_Regno, :sport_id)";
                      
            
            $result = $this->query($query, [
                'tournament_name' => $_POST['tournament_name'],
                'year' => $_POST['year'],
                'place' => $_POST['place'],
                'venue' => $_POST['venue'],
                'no_of_players' => $_POST['no_of_players'],
                'players_Regno' => $_POST['players_Regno'],
                'sport_id' => $_POST['sport_id'],
            ]);

            if(is_bool($result)) {
                return $result; // Just return the boolean
            }
            return $result->rowCount() > 0; // Return true if a row was inserted, false otherwise
        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
            return false;
            exit();
        }

    }

    public function deleteInterunirecords($id){

        $userId = $this->getUserId();

        try{
        $query = "DELETE FROM interuniversityrecords 
        WHERE interrecordid = :id
        AND sport_id = (SELECT sport_id FROM sports_captain WHERE userid = :userid)";
        
        $result = $this->query($query,['id' => $id, 'userid' => $userId]);

        if(is_bool($result)) {
            return $result; // Just return the boolean
        }
        return $result->rowCount() > 0; // Return true if a row was deleted, false otherwise

        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
            return false;
        }

    }

    public function editInterunirecords($id){

        $userId = $this->getUserId();

        if(!$userId) {

            die("User Id not found in session.");
        }

        try{

        $query = "UPDATE interuniversityrecords
        SET tournament_name =:tournament_name, year =:year, place=:place, venue = :venue, no_of_players=:no_of_players,players_Regno = :players_Regno
        WHERE interrecordid = :id
        AND sport_id = (SELECT sport_id FROM sports_captain WHERE userid = :userid)";

        $result = $this->query($query, [
            'tournament_name' => $_POST['tournament_name'],
            'year' => $_POST['year'],
            'place' => $_POST['place'],
            'venue' => $_POST['venue'],
            'no_of_players' => $_POST['no_of_players'],
            'players_Regno' => $_POST['players_Regno'],
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

}
         