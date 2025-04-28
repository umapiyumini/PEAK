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

        $query = "SELECT sports_captain.sport_id,sportnews.*
                  FROM sports_captain
                  JOIN sportnews ON sports_captain.sport_id = sportnews.sport_id
                  WHERE  sports_captain.userid = :userid";

        $result = $this->query($query, ['userid' => $userId]);
        
        return $result;
    }

    public function addnews(){

    
        $userId = $this->getUserId();

        if(!$userId){
            die("User ID not found in session.");
        }


        $query = "SELECT sport_id FROM sports_captain WHERE userid = :userid";
        $sportId = $this->query($query, ['userid' => $userId])[0]->sport_id;

        $query = "INSERT INTO sportnews (topic, content, published_date, sport_id)
                  VALUES (:topic, :content, :published_date, :sport_id)";

        $result = $this->query($query, [
            'topic' => $_POST['topic'],
            'content' => $_POST['content'],
            'published_date' => $_POST['published_date'],
            'sport_id' => $sportId
        ]);
        
        return true;
    }

    public function getBySportID($sportid) {
        $query = "SELECT * FROM $this->table WHERE sport_id = $sportid";
        return $this->query($query);
    }

    
}