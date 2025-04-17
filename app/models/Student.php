<?php

class Student{
    use Model;

    protected $table = 'student';
    protected $allowed_columns = [
        'userid',
        'registrationnumber',
        'faculty',
        'department',
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
    
    public function studentReg($data){
        $querey ="INSERT INTO student (userid, registrationnumber, faculty, department, id_start, id_end) VALUES (:userid, :registrationnumber, :faculty, :department, :id_start, :id_end)";
        $params = [
            ':userid' => $data['userid'],
            ':registrationnumber' => $data['regNumber'],
            ':faculty' => $data['faculty'],
            ':department' => $data['department'],
            ':id_start' => $data['id_start'],
            ':id_end' => $data['id_end']
        ];
        return $this->query($querey, $params);
    }

    public function getuserID($regno){
        $query = "SELECT userid FROM $this->table WHERE registrationnumber = :regno";
        $params = [':regno' => $regno];
        return $this->query($query, $params);
    }
}