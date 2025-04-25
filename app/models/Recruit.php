<?php

class Recruit{
    use Model;

    protected $table = 'recruitments';
    protected $allowed_columns = [
        'recruitmentid  ',
        'regno',
        'name',
        'faculty',
        'reason',
        'sport_id',
        'accept'
    ];

    public $recruiterrors = [];

    public function validate($data) {
        //check if registrationnumber is empty
        if (empty($data['regno'])) {
            $this->recruiterrors['regno'] = 'Registration number is required';
        }

        if (empty($data['name'])) {
            $this->recruiterrors['name'] = 'Name is required';
        }   

        if (empty($data['faculty'])) {
            $this->recruiterrors['faculty'] = 'Faculty is required';
        }

        if (empty($data['reason'])) {
            $this->recruiterrors['reason'] = 'Reason is required';
        }

        if (empty($data['accept'])) {
            $this->recruiterrors['accept'] = 'Accept is required';
        }

       



        //return true if no errors
        return empty($this->recruiterrors);
    }
  


}