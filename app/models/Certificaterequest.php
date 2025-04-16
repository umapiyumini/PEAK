<?php

class Certificaterequest{
    use Model;
    protected $errors;
    protected $table = 'requestcertificates';

    protected $allowedColumns = [
        'ID',
        'Name',
        'Gender',
        'StudentRegistrationNumber',
        'ContactNumber',
        'WhatsAppNumber',
        'EmailAddress',
        'YearOfStudy',
        'YearOfFinalExamCompletion'
        
    ];

    public function validate($data){
        $this->errors = [];

        if(empty($data['Name'])){
            $this->errors['Name'] = 'Name is required';
        }

        if(empty($data['RegistrationID'])){
            $this->errors['RegistrationID'] = 'Registration ID is required';
        }

        if(empty($data['HaveYouPlayedBefore'])){
            $this->errors['HaveYouPlayedBefore'] = 'HaveYouPlayedBefore is required';
        }

        if(empty($data['ReasonForJoining'])){
            $this->errors['ReasonForJoining'] = 'ReasonForJoining is required';
        }

        //var_dump($this->errors);
        return empty($this->errors);
    }

  
}