<?php

class Players{

    use Model;
    protected $table = 'players';
    protected $columns = ['regno', 'position', 'jerseyno', 'sport_id' ];

    public function getPlayers(){

        $userId = $this->getUserId();

        $query = "SELECT sport_captain.sport_id, players.*
                FROM sport_captain
                JOIN players ON sport_captain.sport_id = players.sport_id
                WHERE sport_captain.userid = :userid";
                
        $result = $this->query($query, ['userid' => $userId]);

        return $result;
    }

    public function addPlayer($regno, $position, $jerseyno){
        error_log(print_r($data, true));
        $userId  = $this->getUserId();

        $query = "INSERT INTO players (regno, position, jerseyno, sport_id)
                VALUES (
                :regno, 
                :position, 
                :jerseyno, 
                (SELECT sport_id FROM sport_captain WHERE userid = :userid)
                )";


        $result = $this->query($query, ['regno' => $regno, 'position' => $position, 'jerseyno' => $jerseyno, 'userid' => $userId]);
        // $result = $this->query($query, ['regno' => $regno, 'position' => $position, 'jerseyno' => $jerseyno]);
    
        return $result;
    }

    public function deletePlayer($regno){

        $userId = $this->getUserId();

        try{
        $query = "DELETE FROM players
                WHERE regno = :regno
                AND sport_id = (SELECT sport_id FROM sport_captain WHERE userid = :userid)";

        $result = $this->query($query, ['regno' => $regno, 'userid' => $userId]);

    }catch(Exception $e){
        return false;
    }
    }

    public function updatePlayer($regno){

        $userId = $this->getuserId();

        try{
            $query = "UPDATE players
                    SET position = :position, jerseyno = :jerseyno
                    WHERE regno = :regno
                    AND sport_id = (SELECT sport_id FROM sport_captain WHERE userid = :userid)";

            $result = $this->query($query, ['position' => $position, 'jerseyno' => $jerseyno, 'regno' => $regno, 'userid' => $userId]);
            return $result;
        
        }catch(Exception $e){
            return false;
        }
    }

}