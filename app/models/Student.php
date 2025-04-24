<?php

class Student{
    use Model;

    protected $table = 'student';
    protected $allowed_columns = [
        'userid',
        'registrationnumber',
        'faculty',
        'department'
    ];

    public $studenterrors = [];

    public function validate($data) {
        //check if registrationnumber is empty
        if (empty($data['registrationnumber'])) {
            $this->studenterrors['registrationnumber'] = 'Registration Number is required';
        }

        if (empty($data['faculty'])) {
            $this->studenterrors['faculty'] = 'Faculty is required';
        }   

        if (empty($data['department'])) {
            $this->studenterrors['department'] = 'Department is required';
        }

        if (empty($data['address'])) {
            $this->studenterrors['address'] = 'Address is required';
        }

        //return true if no errors
        return empty($this->studenterrors);
    }
    
    public function getStudent($userid)
    
    {
        $query = "SELECT * FROM $this->table
        JOIN user ON $this->table.userid = user.userid
        WHERE $this->table.userid = :userid";
        $param = [
            'userid' => $userid
        ];
        $result = $this->query($query, $param);
        return $result;
    }

    public function find($userid)
    {
        $query = "SELECT * FROM $this->table WHERE userid = :userid";
        $param = [
            'userid' => $userid
        ];
        $result = $this->query($query, $param);
        return $result[0];
    }


}