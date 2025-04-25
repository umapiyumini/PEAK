<?php

class Temptournament{

    use Model;
    protected $table = 'temp_tournaments';

    public function getTempRecords(){

        $userID = $this->getUserID();

        $sportQuery = "SELECT sport_id FROM sports_captains WHERE user_id = :user_id";
        $sportResult = $this->query($sportQuery, ['user_id' => $userID]);
        $sportID = $sportResult[0]['sport_id'];
        $year = $_POST['year'];
        $faculty_id = $_POST['faculty_id'];
        $category = $_POST['category'];
        $name = $_POST['tournament_name'];


        $query = "SELECT temp_tournaments.tournament_id FROM temp_tournaments WHERE year = :year AND faculty_id = :faculty_id AND category = :category AND sport_id = :sport_id AND tournment_name = :tournament_name";
        $params = [
            'year' => $year,
            'faculty_id' => $faculty_id,
            'category' => $category,
            'sport_id' => $sportID,
            'tournament_name' => $name
        ];

        $result = $this->query($query, $params);

        
        
        return true;
    }

    

}