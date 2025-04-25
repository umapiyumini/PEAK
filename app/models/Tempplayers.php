    
<?php 

class Tempplayers{

    use Model;
    protected $table = 'temp_players';

    public function getPlayers($tournament_id){

        $query = "SELECT reg_no FROM temp_players WHERE tournament_id = :tournament_id";

        $params = [
            'tournament_id' => $tournament_id
        ];

        $result = $this->query($query, $params);
        return $result;
        
    }
  
}

