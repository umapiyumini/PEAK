<?php

class Tournaments{
    use Model;
    public $errors;
    protected $table = 'tournament';

    protected $allowedColumns = [
        'tourid ',
        'tournament',
        'faculty',
        'category',
        'registration_number',
        'year',
        'Sport',
        'userid'
    ];

    //Getting the data of football
    public function find($Sport)
    {
        $query = "SELECT * FROM $this->table WHERE Sport = :Sport";
        $param = [
            'Sport' => $Sport
        ];
        $result = $this->query($query, $param);
        return $result[0];
    }

      
        

    
    public function validate($data){
        $this->errors = [];

        if(empty($data['tournament'])){
            $this->errors['tournament'] = 'Tournament is required';
        }

        if(empty($data['faculty'])){
            $this->errors['faculty'] = 'Faculty is required';
        }

        if(empty($data['category'])){
            $this->errors['category'] = 'Category is required';
        }

        
        if(empty($data['registration_number'])){
            $this->errors['registration_number'] = 'Registration number is required';
        }

        if(empty($data['year'])){
            $this->errors['year'] = 'Year is required';
        }

        
        if(empty($data['Sport'])){
            $this->errors['Sport'] = 'Sport is required';
        }


        

        //var_dump($this->errors);
        return empty($this->errors);
    }


}