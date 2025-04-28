<?php

class Enhancementreq{
    use Model;
    public $errors;
    protected $table = 'enhancement';

    protected $allowedColumns = [
        'RequestID',
        'name',
        'registration_number',
        'sport',
        'achievement',
        'status',
        'userid'
        
    ];

    public function validate($data){
        $this->errors = [];

        if(empty($data['name'])){
            $this->errors['name'] = 'Name is required';
        }

        if(empty($data['registration_number'])){
            $this->errors['registration_number'] = 'Registration Number is required';
        }

        if(empty($data['sport'])){
            $this->errors['sport'] = 'Sport is required';
        }



        if(empty($data['achievement'])){
            $this->errors['achievement'] = 'Achievement is required';
        }

       

        //var_dump($this->errors);
        return empty($this->errors);
    }

  
}