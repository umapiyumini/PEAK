<?php

class MedicalRequest{
    use Model;
    public $errors;
    protected $table = 'medicalrequests';

    protected $allowedColumns = [
        'RequestID',
        'Name',
        'RegistrationID',
        'ReasonForMedical',
        'TimePeriod',
        'userid'
    ];

    public function validate($data){
        $this->errors = [];

        if(empty($data['Name'])){
            $this->errors['Name'] = 'Name is required';
        }

        if(empty($data['RegistrationID'])){
            $this->errors['RegistrationID'] = 'Registration ID is required';
        }

        if(empty($data['ReasonForMedical'])){
            $this->errors['ReasonForMedical'] = 'Reason for medical is required';
        }

        if(empty($data['TimePeriod'])){
            $this->errors['TimePeriod'] = 'Time Period is required';
        }

        //var_dump($this->errors);
        return empty($this->errors);
    }

  
}