<?php

class Faculty{
    use Model;
    public $errors;
    protected $table = 'faculties';

    protected $allowedColumns = [
        'facultyid  ',
        'faculty_name'
    ];

    public function validate($data){
        $this->errors = [];

        if(empty($data['faculty_name'])){
            $this->errors['faculty_name'] = 'Faculty Name is required';
        }

    
        //var_dump($this->errors);
        return empty($this->errors);
    }

  
}