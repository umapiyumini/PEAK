<?php

class External_User{
    use Model;

    protected $table = 'external_user';
    protected $allowed_columns = [
        'userid',
        
        'company_name'
    ];

    public $exerrors = [];

    public function validate($data) {
        

        if (empty($data['company_name'])) {
            $this->exerrors['company_name'] = 'Organization Name is required';
        }

        

        //return true if no errors
        return empty($this->exerrors);
    }
    

}