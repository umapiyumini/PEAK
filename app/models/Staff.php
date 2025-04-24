<?php
class Staff{
    use Model;
    protected $table ='staff';

    public function findAllPedStaff(){
        $query = "SELECT * FROM $this->table WHERE type='ped'"; 
        return $this->query($query);
    }

    public function findAllGroundIndoorStaff(){
        $query = "SELECT * FROM $this->table WHERE type='ground' OR type='indoor'"; 
        return $this->query($query);
    }


    public function getStaffType($userid){

        $query = "SELECT type FROM $this->table 
                JOIN user ON staff.userid = user.userid
                WHERE user.userid = :userid";

        $result = $this->query($query, ['userid' => $userid]);

        return $result;

    }


    public function addStaff($data){
        $query = "INSERT INTO $this->table (name, emp_no, reg_no, designation, appointment_date, nic, dob, phone, address, type) VALUES (:name, :emp_no, :reg_no, :designation, :appointment_date, :nic, :dob, :phone, :address, :type)";
        $params = [
            ':name' => $data['name'],
            ':emp_no' => $data['emp_no'],
            ':reg_no' => $data['reg_no'],
            ':designation' => $data['designation'],
            ':appointment_date' => $data['appointment_date'],
            ':nic' => $data['nic'],
            ':dob' => $data['dob'],
            ':phone' => $data['phone'],
            ':address' => $data['address'],
            ':type' => $data['type']
        ];
        return $this->query($query, $params);
    }

    public function getById($id) {
        $query = "SELECT * FROM $this->table WHERE staff_id = :id";
        return $this->query($query, [':id' => $id])[0] ?? null;
    }
    
    public function editGroundIndoorStaff($data){
        $query = "UPDATE $this->table SET name=:name, emp_no=:emp_no, reg_no=:reg_no, designation=:designation, appointment_date=:appointment_date, nic=:nic, dob=:dob, phone=:phone, address=:address, type=:type WHERE staff_id = :staff_id";
        $params = [
            ':name' => $data['name'],
            ':emp_no' => $data['emp_no'],
            ':reg_no' => $data['reg_no'],
            ':designation' => $data['designation'],
            ':appointment_date' => $data['appointment_date'],
            ':nic' => $data['nic'],
            ':dob' => $data['dob'],
            ':phone' => $data['phone'],
            ':address' => $data['address'],
            ':type' => $data['type'],
            ':staff_id' => $data['staff_id']
        ];
        return $this->query($query, $params);
    }

    public function editPedStaff($data){
        $query = "UPDATE $this->table SET name=:name, emp_no=:emp_no, reg_no=:reg_no, designation=:designation, appointment_date=:appointment_date, nic=:nic, dob=:dob, phone=:phone, address=:address WHERE staff_id = :staff_id";
        $params = [
            ':name' => $data['name'],
            ':emp_no' => $data['emp_no'],
            ':reg_no' => $data['reg_no'],
            ':designation' => $data['designation'],
            ':appointment_date' => $data['appointment_date'],
            ':nic' => $data['nic'],
            ':dob' => $data['dob'],
            ':phone' => $data['phone'],
            ':address' => $data['address'],
            ':staff_id' => $data['staff_id']
        ];
        return $this->query($query, $params);
    }

    public function deleteById($id) {
        $query = "DELETE FROM $this->table WHERE staff_id = :id";
        return $this->query($query, [':id' => $id]);
    }
    
}

