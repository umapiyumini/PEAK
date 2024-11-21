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
        'image',
        'username',
        'password',
        
    ];
    

    public function validate($data){
        $this->errors = [];

        if(empty($data['email'])){
            $this->errors['email'] = 'Email is required';
        }else if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            $this->errors['email'] = 'Invalid email ';
        }


        if(empty($data['username'])){
            $this->errors['username'] = 'Username is required';
        }else if(!preg_match("/^[a-zA-Z0-9]+$/" , $data['username'])){
            $this->errors['username'] = 'usernames cannot have spaces';
        }

        if(empty($data['password'])){
            $this->errors['password'] = 'Password is required';}

       //to ensure passwrod matched confirmed password
        // if($data['password']!= $data['confirm_password']){
        //     $this->errors['confirm_password1'] = 'Passwords do not match';
        // }
        //to ensure confirm passwrod is required
        if(empty($data['confirm_password'])){
            $this->errors['confirm_password2'] = 'Confirm Password is required';
        }

        


        if(empty($data['name'])){
            $this->errors['name'] = 'Name is required';
        }

        if(empty($data['gender'])){
            $this->errors['gender'] = 'Gender is required';
        }

        if(empty($data['nic'])){
            $this->errors['nic'] = 'NIC is required';
        }

        if(empty(['date_of_birth'])){
            $this->errors['date_of_birth'] = 'Date of Birth is required';
        }

        if(empty($data['contact_number'])){
            $this->errors['contact_number'] = 'Contact Number is required';
        }

        if(empty($data['address'])){
            $this->errors['address'] = 'Address is required';
        }

        if(empty($data['terms'])){
            $this->errors['terms'] = 'You must agree to the terms and conditions';
        }

        if(empty($data['company'])){
            $this->errors['company'] = 'Company is required';
        }

        
          

        if(empty($this->errors)){
            return true;
        }
        return false;
    }

    // public function create_table(){
    //     $query = "
    //     CREATE TABLE IF NOT EXISTS $this->table (
    //         userid INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //         name VARCHAR(255) NOT NULL,
    //         gender ENUM('Male', 'Female', 'Other') NOT NULL,
    //         nic VARCHAR(10) NOT NULL,
    //         email VARCHAR(255) NOT NULL UNIQUE,
    //         date_of_birth DATE NOT NULL,
    //         contact_number VARCHAR(10) NOT NULL,
    //         address TEXT NOT NULL,
    //         image VARCHAR(255) NOT NULL,

    //         key username (username),
    //         key email (email),
    //         key nic (nic),
    //         key date_of_birth (date_of_birth),
    //         key contact_number (contact_number),
    //         key address (address),
    //         key image (image)
    //     "
    // }

}