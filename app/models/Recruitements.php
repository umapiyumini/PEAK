<?php

class Recruitements{
    use Model;
    protected $errors;
    protected $table = 'reuruitments';

    protected $allowedColumns = [
        'recruitmentid',
        'regno',
        'name',
        'faculty',
        'reason',
        'sport_id',
        'accept',
        'userid'
        
        
    ];

    public function validate($data){
        $this->errors = [];

        if(empty($data['regno'])){
            $this->errors['regno'] = 'Registration Number is required';
        }

        if(empty($data['name'])){
            $this->errors['name'] = 'Name is required';
        }

        if(empty($data['faculty'])){
            $this->errors['faculty'] = 'Faculty is required';
        }

        if(empty($data['reason'])){
            $this->errors['reason'] = 'Reason is required';
        }

        
        if(empty($data['sport_id'])){
            $this->errors['sport_id'] = 'Sport ID is required';
        }

        
        if(empty($data['accept'])){
            $this->errors['accept'] = 'Acceptance is required';
        }

        //var_dump($this->errors);
        return empty($this->errors);
    }

  
}