<?php

class External_User{
    use Model;

    protected $table = 'external_user';
    protected $allowed_columns = [
        'userid',
        'companyid',
        'company_name'
    ];

    public $exerrors = [];

    public function validate($data) {
        if (empty($data['companyid'])) {
            $this->exerrors['companyid'] = 'Organization ID is required';
        }

        if (empty($data['company_name'])) {
            $this->exerrors['company_name'] = 'Organization Name is required';
        }

        if (empty($data['address'])) {
            $this->exerrors['address'] = 'Organization Address is required';
        }

        //return true if no errors
        return empty($this->exerrors);
    }
    

}