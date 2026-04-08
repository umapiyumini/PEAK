
<?php

class Tempplayers{
    use Model;
    public $errors;
    protected $table = 'temp_players';

    protected $allowedColumns = [
        'temp_id ',
        'temp_tournamentid ',
        'reg_no',

    ];

    public function validate($data){
        $this->errors = [];

        if(empty($data['reg_no'])){
            $this->errors['reg_no'] = 'Registration number is required';
        }
        //var_dump($this->errors);
        return empty($this->errors);
    }

    public function getAll2() {
        $sql = "SELECT * FROM temp_players";
        return $this->query($sql);
    }
  
  public function getPlayers($tournament_id,$faculty_id)
    {
        $query = "SELECT reg_no FROM temp_players WHERE temp_tournament_id = :tournament_id AND faculty_id = :faculty_id";

        $params = [
            'tournament_id' => $tournament_id,
            'faculty_id' => $faculty_id
        ];

        return $this->query($query, $params);
    }
    
}

