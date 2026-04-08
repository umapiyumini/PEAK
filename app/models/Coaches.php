<?php

class Coaches{
    use Model;

    protected $table = 'coaches';
    protected $allowed_columns = [
        'empid ',
        'name',
        'role',
        'email',
        'phone',
        'nic',
        'address',
        'experience',
        'sport_id'
    ];

    public $studenterrors = [];

    public function validate($data) {
        //check if registrationnumber is empty
        if (empty($data['name'])) {
            $this->studenterrors['name'] = 'Name is required';
        }

        if (empty($data['role'])) {
            $this->studenterrors['role'] = 'Role is required';
        }   

        if (empty($data['email'])) {
            $this->studenterrors['email'] = 'Email is required';
        }

        if (empty($data['phone'])) {
            $this->studenterrors['phone'] = 'Phone Number is required';
        }

        if (empty($data['nic'])) {
            $this->studenterrors['nic'] = 'NIC Number is required';
        }

        if (empty($data['address'])) {
            $this->studenterrors['address'] = 'Address is required';
        }

        if (empty($data['experience'])) {
            $this->studenterrors['experience'] = 'Experience is required';
        }



        //return true if no errors
        return empty($this->studenterrors);
    }
    
    public function getCoaches($empid)
    
    {
        $query = "SELECT * FROM $this->table WHERE $this->table.empid = :empid";
        $param = [
            'empid' => $empid
        ];
        $result = $this->query($query, $param);
        return $result;
    }

    public function find($empid)
    {
        $query = "SELECT * FROM $this->table WHERE empid = :empid";
        $param = [
            'empid' => $empid
        ];
        $result = $this->query($query, $param);
        return $result;
    }


}