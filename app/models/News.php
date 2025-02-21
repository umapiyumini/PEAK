<?php

class News{
    use Model;
    protected $table = 'sportnews';
    protected $allowcolumns = [
        'topic',
        'content',
        'published_date',
        'sport_id'
    ];

    public function getnewsbysport(){

        $userId = $this->getUserId();

        if (!$userId) {
            die("User ID not found in session.");
        }

        $query = "SELECT sport_captain.sport_id,sportnews.*
                  FROM sport_captain
                  JOIN sportnews ON sport_captain.sport_id = sportnews.sport_id
                  WHERE  sport_captain.userid = :userid";

        $result = $this->query($query, ['userid' => $userId]);
        
        return $result;
    }

    
}