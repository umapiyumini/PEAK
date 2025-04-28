<?php 

class Othertournaments{

    use Model;
    protected $table = 'othertournaments';
    protected $columns = [
        'tournament_name',
        'date',
        'place',
        'venue',
        'player_regno',
        'sport_id',
        'men_women'
    ];

    public function getotherrecords(){

        $userId = $this->getUserId();

        if(!$userId){
            die("User ID not found in session.");
        }

        $query = "SELECT user.name,othertournaments.*
                FROM sports_captain
                JOIN othertournaments ON sports_captain.sport_id = othertournaments.sport_id
                JOIN student ON othertournaments.player_regno = student.registrationnumber
                JOIN user ON student.userid = user.userid
                WHERE sports_captain.userid = :userid";

        $result = $this->query($query,['userid'=> $userId]);

        return $result;

    }

    public function addOtherRecords(){

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

            $query = "INSERT INTO othertournaments (tournament_name, date,place,venue,player_regno,sport_id,men_women)
                    VALUES (:tournament_name, :date, :place, :venue, :player_regno, :sport_id, :men_women)";

            $result = $this->query($query, [
                'tournament_name' => $_POST['tournament_name'],
                'date' => $_POST['date'],
                'place' => $_POST['place'],
                'venue' => $_POST['venue'],
                'player_regno' => $_POST['player_regno'],
                'sport_id' => $_POST['sport_id'],
                'men_women' => $_POST['men_women']
            ]);

            if($result){
                return true;
            }
            else{
                return false;
            }

        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
            return false;
        }
    }

    public function editOtherRecords($id){
        $userId = $this->getUserId();
        if(!$userId){
            die("User Id not found in session.");
        }
        
        try{
            $query = "UPDATE othertournaments SET
                tournament_name = :tournament_name,
                date = :date,
                place = :place,
                venue = :venue,
                player_regno = :player_regno
                WHERE tournamentid = :id";
                
            $result = $this->query($query, [
                'tournament_name' => $_POST['tournament_name'],
                'date' => $_POST['date'],
                'place' => $_POST['place'],
                'venue' => $_POST['venue'],
                'player_regno' => $_POST['player_regno'],
                'id' => $id
            ]);
            
            if($result){

                return true;
            }
            else{
                return false;
            }
        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
            return false;
        }
    }

    public function deleteOtherRecords($id){

        $userId = $this->getUserId();
        if(!$userId){
            die("User Id not found in session.");
        }
        
        try{
            $query = "DELETE FROM othertournaments WHERE tournamentid = :id";
            
            $result = $this->query($query, ['id' => $id]);
            
            if($result){
                return true;
            }
            else{
                return false;
            }
        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
            return false;
        }
    }

    public function getAllOtherTournaments(){
        $query = "SELECT * FROM $this->table";
        return $this->query($query);
    }
}