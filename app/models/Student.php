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
        if (empty($data['registrationnumber'])) {
            $this->studenterrors['registrationnumber'] = 'Registration Number is required';
        } else {
            // Check for duplicate registration number
            $query = "SELECT COUNT(*) as count FROM $this->table WHERE registrationnumber = :regno";
            $params = [':regno' => $data['registrationnumber']];
            $result = $this->query($query, $params);
            
            if ($result[0]->count > 0) {
                $this->studenterrors['registrationnumber'] = 'Registration Number already exists';
            }
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
    
<<<<<<< HEAD
=======

>>>>>>> 9dca0a0ac48735620d60b8f87062b0554b1f37ff
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

<<<<<<< HEAD
=======
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
>>>>>>> 9dca0a0ac48735620d60b8f87062b0554b1f37ff

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