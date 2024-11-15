<?php

class User{
    use Model;

    protected $table = 'user';
    protected $allowedColumns = [
        'name',
        'gender',
        'nic',
        'email',
        'date_of_birth',
        'contact_number',
        'address',
        'username',
        'password',
        'role',
    ];
    

    public function validate($data){
        $this->errors = [];

          

        if(empty($this->errors)){
            return true;
        }
        return false;
    }

}