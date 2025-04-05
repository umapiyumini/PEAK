<?php 

class Interunirecords{
    use Model;
    protected $table = 'interuniversityrecords';
    protected $columns = ['tournament_name','year','place','venueid','no_of_players','sport_id'];

    public function getIntrunirecords(){

        $userId = $this->getUserID();

        if (!$userId) {
            die("User ID not found in session.");
        }

        $query = "SELECT sport_captain.sport_id,interuniversityrecords.*
                FROM sport_captain
                JOIN interuniversityrecords ON sport_captain.sport_id = interuniversityrecords.sport_id
                WHERE sport_captain.userid = :userid";
            
        $result = $this->query($query,['userid' =>$userId]);

        return $result;
    }
}