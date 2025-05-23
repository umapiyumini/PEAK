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

        if (empty($data['email'])) {
            $this->errors['email'] = 'Email is required';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Invalid email format';
        } elseif ($this->emailExists($data['email'])) {
            $this->errors['email'] = 'Email already exists in our system';
        }
        
        // NIC validation
        if (empty($data['nic'])) {
            $this->errors['nic'] = 'NIC is required';
        } elseif (!preg_match("/^([0-9]{9}[vV]|[0-9]{12})$/", $data['nic'])) {
            $this->errors['nic'] = 'Invalid NIC format. Must be 9 digits ending with V/v or 12 digits.';
        } elseif ($this->nicExists($data['nic'])) {
            $this->errors['nic'] = 'NIC already exists in our system';
        }
        
        // Contact number validation
        if (empty($data['contact_number'])) {
            $this->errors['contact_number'] = 'Contact Number is required';
        } elseif (!preg_match("/^[0-9]{10}$/", $data['contact_number'])) {
            $this->errors['contact_number'] = 'Invalid Contact Number format';
        } elseif ($this->contactNumberExists($data['contact_number'])) {
            $this->errors['contact_number'] = 'Contact Number already exists in our system';
        }
        
        
        return empty($this->errors);
    }


    private function validateNicWithDob($nic, $dob, $gender)
    {
      
        $nic = trim($nic);
        
       
        $dobYear = date('Y', strtotime($dob));
        $dobYearLastTwo = substr($dobYear, -2);
        
        // Get day of year from DOB (1-366)
        $dobDayOfYear = date('z', strtotime($dob)) + 1;
        
        // old format?
        if(strlen($nic) == 10 && (strtoupper(substr($nic, -1)) === 'V' || strtoupper(substr($nic, -1)) === 'X')) {
            // Extract year and day from old NIC
            $nicYear = substr($nic, 0, 2);
            $nicDayGender = (int)substr($nic, 2, 3);
            
            // Calculate actual day
            $nicDay = ($nicDayGender > 500) ? $nicDayGender - 500 : $nicDayGender;
            
            // Check gender consistency
            $nicGender = ($nicDayGender > 500) ? 'female' : 'male';
            if($nicGender !== $gender) {
                $this->errors['gender'] = "Gender doesn't match the gender encoded in NIC";
                return false;
            }
            
            // Verify year and day match
            if($nicYear != $dobYearLastTwo || $nicDay != $dobDayOfYear) {
                $this->errors['nic'] = "NIC number doesn't match the provided date of birth";
                return false;
            }
            
            return true;
        }
        // Check if new NIc format
        else if(strlen($nic) == 12 && is_numeric($nic)) {
            // Extract year and day from new NIC
            $nicYear = substr($nic, 0, 4);
            $nicDayGender = (int)substr($nic, 4, 3);
            
            // Calculate actual day (removing gender offset)
            $nicDay = ($nicDayGender > 500) ? $nicDayGender - 500 : $nicDayGender;
            
            // Check gender consistency
            $nicGender = ($nicDayGender > 500) ? 'female' : 'male';
            if($nicGender !== $gender) {
                $this->errors['gender'] = "Gender doesn't match the gender encoded in NIC";
                return false;
            }
            
            // Verify year and day match
            if($nicYear != $dobYear || $nicDay != $dobDayOfYear) {
                $this->errors['nic'] = "NIC number doesn't match the provided date of birth";
                return false;
            }
            
            return true;
        }
        
        // Invalid NIC format
        $this->errors['nic'] = "Invalid NIC format";
        return false;
    }


    

    public function validate2($data) {

        //email validation
        if (empty($data['email'])) {
            $this->errors['email'] = 'Email is required';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Invalid email format';
        } elseif ($this->emailExists($data['email'])) {
            $this->errors['email'] = 'Email already exists in our system';
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
        } elseif ($this->nicExists($data['nic'])) {
            $this->errors['nic'] = 'NIC already exists in our system';
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
        } elseif ($this->contactNumberExists($data['contact_number'])) {
            $this->errors['contact_number'] = 'Contact Number already exists in our system';
        }

        // Registered Date and Last Examination Date validation
        if (!empty($data['id_start']) && !empty($data['id_end'])) {
            $start_date = new DateTime($data['id_start']);
            $end_date = new DateTime($data['id_end']);
            
            $interval = $start_date->diff($end_date);
            $years = $interval->y;
            
            if ($years < 2 || ($years == 2 && $interval->m == 0 && $interval->d == 0)) {
                $this->errors['id_end'] = 'Last Examination Date must be at least 2 years after Registered Date';
            }
        }
        
        // Return true if no errors
        return empty($this->errors);
    }

  
    public function getUser($userid){
        $query = "SELECT * FROM $this->table WHERE userid = :userid";
        $params = [':userid' => $userid];
        return $this->query($query, $params);
    }



    public function getLastID() {
        $query = "SELECT userid FROM $this->table ORDER BY userid DESC LIMIT 1";
        $result = $this->query($query); // Likely returns an array of objects
        return $result[0]->userid ?? null; 
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
