<?php

class Gymrequest{
    use Model;
    protected $errors;
    protected $table = 'requestgym';

    protected $allowedColumns = [
        'ID',
        'StudentRegistrationID'
        
        
    ];

    public function validate($data){
        $this->errors = [];

        if(empty($data['StudentRegistrationID'])){
            $this->errors['StudentRegistrationID'] = 'StudentRegistrationID is required';
        }

       

        //var_dump($this->errors);
        return empty($this->errors);
    }

  
}