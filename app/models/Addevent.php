<?php

class Addevent{
    use Model;
    protected $errors;
    protected $table = 'event';

    protected $allowedColumns = [
        'EventName',
        'EventDescription',
        'EventDate',
        'StartTime',
        'EndTime'
        
    ];

    public function validate($data){
        $this->errors = [];

        if(empty($data['EventName'])){
            $this->errors['EventName'] = 'EventName is required';
        }

        if(empty($data['EventDescription'])){
            $this->errors['EventDescription'] = 'EventDescription ID is required';
        }

        if(empty($data['EventDate'])){
            $this->errors['EventDate'] = 'EventDate is required';
        }

        if(empty($data['StartTime'])){
            $this->errors['StartTime'] = 'StartTime is required';
        }

        if(empty($data['EndTime'])){
            $this->errors['EndTime'] = 'EndTime is required';
        }


        //var_dump($this->errors);
        return empty($this->errors);
    }

  
}