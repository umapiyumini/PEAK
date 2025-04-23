<?php

class User {
    use Model;

    protected $table = 'user';
    protected $allowed_columns = [
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
        'role',
        'createdate',
    ];

    public $errors = [];


    public function validate($data) {

        // Email validation
        if (empty($data['email'])) {
            $this->errors['email'] = 'Email is required';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Invalid email format';
        }

        // Username validation
        // if (empty($data['username'])) {
        //     $this->errors['username'] = 'Username is required';
        // } elseif (!preg_match("/^[a-zA-Z0-9]+$/", $data['username'])) {
        //     $this->errors['username'] = 'Username cannot contain spaces or special characters';
        // }

        // Password validation
        if (empty($data['password'])) {
            $this->errors['password'] = 'Password is required';
        } elseif (strlen($data['password']) < 8) {
            $this->errors['password'] = 'Password must be at least 8 characters long';
        } elseif (!preg_match('/[A-Z]/', $data['password'])) {
            $this->errors['password'] = 'Password must include at least one uppercase letter';
        } elseif (!preg_match('/[a-z]/', $data['password'])) {
            $this->errors['password'] = 'Password must include at least one lowercase letter';
        } elseif (!preg_match('/\d/', $data['password'])) {
            $this->errors['password'] = 'Password must include at least one number';
        } elseif (!preg_match('/[\W_]/', $data['password'])) {
            $this->errors['password'] = 'Password must include at least one special character';
        }

        if (empty($data['confirm_password'])) {
            $this->errors['confirm_password'] = 'Confirm Password is required';
        } elseif ($data['password'] != $data['confirm_password']) {
            $this->errors['confirm_password'] = 'Passwords do not match';
        }

        // Name validation
        if (empty($data['name'])) {
            $this->errors['name'] = 'Name is required';
        } elseif (!preg_match("/^[a-zA-Z ]+$/", $data['name'])) {
            $this->errors['name'] = 'Name must only contain letters and spaces';
        }

        // Gender validation
        if (empty($data['gender'])) {
            $this->errors['gender'] = 'Gender is required';
        } elseif (!in_array($data['gender'], ['male', 'female'])) {
            $this->errors['gender'] = 'Invalid gender selected';
        }

        // NIC validation
        if (empty($data['nic'])) {
            $this->errors['nic'] = 'NIC is required';
        } elseif (!preg_match("/^([0-9]{9}[vV]|[0-9]{12})$/", $data['nic'])) {
            $this->errors['nic'] = 'Invalid NIC format. Must be 9 digits ending with V/v or 12 digits.';
        }

        // Date of birth validation
        if (empty($data['dob'])) {
            $this->errors['dob'] = 'Date of Birth is required';
        } elseif (!strtotime($data['dob'])) {
            $this->errors['dob'] = 'Invalid Date of Birth format';
        }

        // Contact number validation
        if (empty($data['contact_number'])) {
            $this->errors['contact_number'] = 'Contact Number is required';
        } elseif (!preg_match("/^[0-9]{10}$/", $data['contact_number'])) {
            $this->errors['contact_number'] = 'Invalid Contact Number format';
        }

        // Terms acceptance validation
        if (empty($data['terms'])) {
            $this->errors['terms'] = 'You must agree to the terms and conditions';
        }

        // if (empty($data['company'])) {
        //     $this->errors['company'] = 'Company is required';
        // }

        // if(empty($data['companyid'])) {
        //     $this->errors['companyid'] = 'Company ID is required';
        // }

        // Return true if no errors
        return empty($this->errors);
    }

    public function getLastID() {
        $query = "SELECT userid FROM $this->table ORDER BY userid DESC LIMIT 1";
        $result = $this->query($query); // Likely returns an array of objects
        return $result[0]->userid ?? null; // Access as an object
    }    

    public function getName($userid)
    {
        $query = "SELECT name FROM $this->table WHERE userid = :userid";
        $params = ['userid' => $userid];
        $result = $this->query($query, $params); // Likely returns an array of objects
        return $result[0]->name ?? null; // Access as an object
    }

    public function find($userid) {
        $query = "SELECT * FROM $this->table WHERE userid = :userid";
        $params = ['userid' => $userid];
        return $this->query($query, $params)[0] ?? null; // Access as an object
    }
}
