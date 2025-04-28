<?php 

class Teammembership{
    use Model;
    public $errors;
    protected $table = 'membership';

    protected $allowedColumns = [
        'request_id',
        'full_name',
        'student_id',
        'faculty',
        'year_of_study',
        'contact_number',
        'university_email',
        'userid'
    ];

    public function validate($data){
        $this->errors = [];

        if(empty($data['full_name'])){
            $this->errors['full_name'] = 'FullName is required';
        }

        if(empty($data['student_id'])){
            $this->errors['student_id'] = 'Student ID is required';
        }

        if(empty($data['faculty'])){
            $this->errors['faculty'] = 'Faculty is required';
        }

        if(empty($data['year_of_study'])){
            $this->errors['year_of_study'] = 'Year of Study is required';
        }

        if(empty($data['contact_number'])){
            $this->errors['contact_number'] = 'Contact Number is required';
        }

        if(empty($data['university_email'])){
            $this->errors['university_email'] = 'University Email is required';
        }

        //var_dump($this->errors);
        return empty($this->errors);
    }

  
}


