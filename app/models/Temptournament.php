<?php

class Temptournament{
    use Model;
    public $errors;
    protected $table = 'temp_tournaments';

    protected $allowedColumns = [
        'tournament_id ',
        'year',
        'category',
        'tournament_name',
        'sport_id',
        'faculty_id '
    ];

    public function validate($data){
        $this->errors = [];

        if(empty($data['year'])){
            $this->errors['year'] = 'Year is required';
        }

        if(empty($data['category'])){
            $this->errors['category'] = 'Category is required';
        }

        if(empty($data['tournament_name'])){
            $this->errors['tournament_name'] = 'Tournament Name is required';
        }

       

        //var_dump($this->errors);
        return empty($this->errors);
    }

    public function getAll1() {
        $sql = "SELECT * FROM temp_tournaments";
        return $this->query($sql);
    }

  
}