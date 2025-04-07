<?php 

class Interfacultyrecords{

    use Model;
    protected $table = 'interfacultyrecords';
    protected $columns = ['tournament_name','year','first_place','second_place','third_place','no_of_players','players_regno','sport_id'];

    
    
    public function getInterfacultyrecords() {
        $userId = $this->getUserId();
        $query = "SELECT sports_captain.sport_id, interfacultyrecords.*                 
                FROM sports_captain                 
                JOIN interfacultyrecords ON sports_captain.sport_id = interfacultyrecords.sport_id                 
                WHERE sports_captain.userid = :userid";
        $result = $this->query($query, ['userid' => $userId]);
        return $result;
    }
    
    public function getInterfacultyrecordsId() {
        $userId = $this->getUserId();
        if(!$userId) {
            die("User ID not found in session.");
        }
        
        $query = "SELECT sports_captain.sport_id, interfacultyrecords.interfacrecid                 
                FROM sports_captain                 
                JOIN interfacultyrecords ON sports_captain.sport_id = interfacultyrecords.sport_id                 
                WHERE sports_captain.userid = :userid";
        
        $result = $this->query($query, ['userid' => $userId]);
        return $result;
    }

    public function addInterfacultyrecords(){

        $userId = $this->getUserId();
        if(!$userId){
            die("User Id not found in session.");
        }

        try{

            $sportQuery = "SELECT sport_id FROM sports_captain WHERE userid = :userid";
            $sportresult = $this->query($sportQuery, ['userid' => $userId]);
            $_POST['sport_id'] = $sportresult[0]->sport_id;

            if(!$sportresult || count($sportresult) == 0){
                throw new Exception("Sport ID not found for this user");
            }

            $query = "INSERT INTO interfacultyrecords (tournament_name, year, first_place, second_place, third_place, no_of_players, players_regno, sport_id)
                    VALUES (:tournament_name, :year, :first_place, :second_place, :third_place, :no_of_players, :players_regno, :sport_id)";
            
            $result = $this->query($query, [
                'tournament_name' => $_POST['tournament_name'],
                'year' => $_POST['year'],
                'first_place' => $_POST['first_place'],
                'second_place' => $_POST['second_place'],
                'third_place' => $_POST['third_place'],
                'no_of_players' => $_POST['no_of_players'],
                'players_regno' => $_POST['players_regno'],
                'sport_id' => $_POST['sport_id']
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
    
    public function editInterfacultyrecords($id) {
        $userId = $this->getUserId();
        if(!$userId) {
            die("User ID not found in session.");
        }
        
        try {
            // Check if the column name is 'players_regno' instead of 'players_Regno'
            $query = "UPDATE interfacultyrecords
                    SET tournament_name = :tournament_name, 
                        year = :year, 
                        first_place = :first_place, 
                        second_place = :second_place, 
                        third_place = :third_place, 
                        no_of_players = :no_of_players, 
                        players_regno = :players_regno
                    WHERE interfacrecid = :id
                    AND sport_id = (SELECT sport_id FROM sports_captain WHERE userid = :user_id)";
            
           
            
            
            $params = [
                'tournament_name' => $_POST['tournament_name'],
                'year' => $_POST['year'],
                'first_place' => $_POST['first_place'],
                'second_place' => $_POST['second_place'],
                'third_place' => $_POST['third_place'],
                'no_of_players' => $_POST['no_of_players'],
                'players_regno' => $_POST['players_regno'],
                'id' => $id,
                'user_id' => $userId
            ];
            
            
            
            $result = $this->query($query, $params);
            
            if(is_bool($result)) {
                return $result;
            }
            
            $rowCount = $result->rowCount();
            error_log("Rows affected: " . $rowCount);
            
            return $rowCount > 0;
        } catch(Exception $e) {
            error_log("Exception in editInterfacultyrecords model: " . $e->getMessage());
            $_SESSION['error'] = $e->getMessage();
            return false;
        }
    }

    public function deleteInterfacultyrecords($id){

        $userID = $this->getUserId();
        if(!$userID){
            die("User ID not found in session.");
        }

        try{

            $query = "DELETE FROM interfacultyrecords
            WHERE interfacrecid = :id
            AND sport_id = (SELECT sport_id FROM sports_captain WHERE userid = :userid)";

            $result = $this->query($query, ['id'=> $id, 'userid' => $userID]);

            if(is_bool($result)) {
                return $result;
            }

            return $result->rowcount() >0;
        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
            return false;
        }
    }

}