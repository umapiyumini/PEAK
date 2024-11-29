<?php

class User {
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
        'createdate',
    ];

    public function validate($data) {
        $this->errors = [];

        // Email validation
        if (empty($data['email'])) {
            $this->errors['email'] = 'Email is required';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Invalid email format';
        }

        // Username validation
        if (empty($data['username'])) {
            $this->errors['username'] = 'Username is required';
        } elseif (!preg_match("/^[a-zA-Z0-9]+$/", $data['username'])) {
            $this->errors['username'] = 'Username cannot contain spaces or special characters';
        }

        // Password validation
        if (empty($data['password'])) {
            $this->errors['password'] = 'Password is required';
        } elseif ($data['password'] != $data['confirm_password']) {
            $this->errors['confirm_password'] = 'Passwords do not match';
        }

        if (empty($data['confirm_password'])) {
            $this->errors['confirm_password'] = 'Confirm Password is required';
        }

        // Name validation
        if (empty($data['name'])) {
            $this->errors['name'] = 'Name is required';
        }

        // Gender validation
        if (empty($data['gender'])) {
            $this->errors['gender'] = 'Gender is required';
        }

        // NIC validation
        if (empty($data['nic'])) {
            $this->errors['nic'] = 'NIC is required';
        }

        // Date of birth validation
        if (empty($data['date_of_birth'])) {
            $this->errors['date_of_birth'] = 'Date of Birth is required';
        }

        // Contact number validation
        if (empty($data['contact_number'])) {
            $this->errors['contact_number'] = 'Contact Number is required';
        }

        // Address validation
        if (empty($data['address'])) {
            $this->errors['address'] = 'Address is required';
        }

        // Terms acceptance validation
        if (empty($data['terms'])) {
            $this->errors['terms'] = 'You must agree to the terms and conditions';
        }

        if (empty($data['company'])) {
            $this->errors['company'] = 'Company is required';
        }

        if(empty($data['companyid'])) {
            $this->errors['companyid'] = 'Company ID is required';
        }

        // Return true if no errors
        return empty($this->errors);
    }

    // Other methods as needed...
}
