<?php 

class Interfacultyrecords{

    use Model;
    protected $table = 'interfacultyrecords';
    protected $columns = ['tournament_name','year','first_place','second_place','third_place','no_of_players','players_regno','sport_id'];

    public function getInterfacultyrecords(){

        $userId = $this->getUserID();

        $query = "SELECT sport_captain.sport_id,interfacultyrecords.*
                FROM sport_captain
                JOIN interfacultyrecords ON sport_captain.sport_id = interfacultyrecords.sport_id
                WHERE sport_captain.userid = :userid";

        $result = $this->query($query, ['userid' => $userId]);
        return $result;
    }
}