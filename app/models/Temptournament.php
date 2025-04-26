<?php

class Temptournament{

    use Model;
    protected $table = 'temp_tournaments';

    public function getTempRecordId($year,$category,$sportID,$tournament_name){

        $userID = $this->getUserID();

        $sportQuery = "SELECT sport_id FROM sports_captain WHERE userid = :userid";
        $sportResult = $this->query($sportQuery, ['userid' => $userID]);
        $sportID = $sportResult[0]->sport_id;


        $query = "SELECT tournament_id FROM temp_tournaments WHERE year = :year AND category = :category AND sport_id = :sport_id AND tournament_name = :tournament_name";
        $data = [
            'year' => $year,
            'category' => $category,
            'sport_id' => $sportID,
            'tournament_name' => $tournament_name
        ];

        $result = $this->query($query, $data);
        
        
        return true;
    }

    

}