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


    public function getuserID($regno){
        $query = "SELECT userid FROM $this->table WHERE registrationnumber = :regno";
        $params = [':regno' => $regno];
        return $this->query($query, $params);
    }
    
    public function findAllStudents(){
        $query = "SELECT u.userid, u.name, u.gender, u.nic, u.email, u.date_of_birth, u.contact_number, u.address, 
        s.registrationnumber, s.faculty, s.department, s.id_start, s.id_end FROM $this->table s 
        JOIN user u ON s.userid = u.userid";

        return $this->query($query);
    }

    public function getStudentInfo($regno){
        $query = "SELECT u.userid, u.name, u.gender, u.nic, u.email, u.date_of_birth, u.contact_number, u.address, 
                s.registrationnumber, s.faculty, s.department, s.id_start, s.id_end FROM $this->table s 
                JOIN user u ON s.userid = u.userid WHERE s.registrationnumber = :regno";

        $params = [':regno' => $regno];
        return $this->query($query, $params);
    }

    public function editStudentDetails($data){
        $query = "UPDATE $this->table SET registrationnumber = :registrationnumber, faculty = :faculty, department = :department, id_start = :id_start, id_end = :id_end WHERE userid = :userid";
        $params = [
            ':registrationnumber' => $data['regNumber'],
            ':faculty' => $data['faculty'],
            ':department' => $data['department'],
            ':id_start' => $data['id_start'],
            ':id_end' => $data['id_end'],
            ':userid' => $data['userid']
        ];
        return $this->query($query, $params);
    }
}