<?php

class Recruit{
    use Model;

    public $errors;

    protected $table = 'recruitments';
    protected $allowed_columns = [
        'recruitmentid  ',
        'regno',
        'faculty',
        'reason',
        'sport_id',
        'status'
    ];

    public $recruiterrors = [];

    public function validate($data) {
        //check if registrationnumber is empty
        if (empty($data['regno'])) {
            $this->recruiterrors['regno'] = 'Registration number is required';
        }

        if (empty($data['faculty'])) {
            $this->recruiterrors['faculty'] = 'Faculty is required';
        }   

        if (empty($data['sport_id'])) {
            $this->recruiterrors['sport_id'] = 'Sport ID  is required';
        }

        if (empty($data['reason'])) {
            $this->recruiterrors['reason'] = 'Reason is required';
        }


       



        //return true if no errors
        return empty($this->recruiterrors);
    }

    public function getAll() {
        $sql = "SELECT * FROM recruitments";
        return $this->query($sql);
    }
    
  


}