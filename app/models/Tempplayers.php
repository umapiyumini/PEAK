
<?php

class Tempplayers{
    use Model;
    public $errors;
    protected $table = 'temp_players';

    protected $allowedColumns = [
        'temp_id ',
        'temp_tournamentid',
        'reg_no'
    ];

    public function validate($data){
        $this->errors = [];

        if(empty($data['reg_no'])){
            $this->errors['reg_no'] = 'Registration Number is required';
        }

    
        //var_dump($this->errors);
        return empty($this->errors);
    }

  

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