<?php

class Certificaterequest{
    use Model;
    public $errors;
    protected $table = 'certificaterequest';

    protected $allowedColumns = [
        'RequestID',
        'Name',
        'RegistrationNumber',
        'Year',
        'Sport',
        'UserID',
        
        
    ];

    public function validate($data){
        $this->errors = [];

        if(empty($data['Name'])){
            $this->errors['Name'] = 'Name is required';
        }

        if(empty($data['RegistrationNumber'])){
            $this->errors['RegistrationNumber'] = 'RegistrationNumber is required';
        }

        if(empty($data['Year'])){
            $this->errors['Year'] = 'Year is required';
        }

        if(empty($data['Sport'])){
            $this->errors['Sport'] = 'Sport is required';
        }

        //var_dump($this->errors);
        return empty($this->errors);
    }

  
}