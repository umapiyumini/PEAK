<?php

class StaffTodo {
    use Model;
    protected $table = 'stafftodo';

    public function findAllStaffTodo() {
        $query = "SELECT stafftodo.*, staff.staff_id, staff.userid FROM stafftodo 
        JOIN staff ON stafftodo.staffid = staff.staff_id
        JOIN User ON staff.userid = user.userid 
        WHERE staff.userid = :userid ORDER BY stafftodo.deadline DESC";

        $result = $this->query($query, [
            'userid' => $_SESSION['userid']
        ]);

        return $result;
    }

    public function updateStatus($taskid, $status){

        $query = "UPDATE stafftodo SET status = :status WHERE taskid = :taskid";
        $result = $this->query($query, [
            'status' => $status,
            'taskid' => $taskid
        ]);

        return $result;
    }

    public function getAllStaffTodo() {
        $query = "SELECT * FROM $this->table s
        JOIN staff ON staff.staff_id = s.staffid";
        return $this->query($query);
    }

    public function addTask($data) {
        $query = "INSERT INTO $this->table (taskname, date, deadline, description, staffid) VALUES (:taskname, :date, :deadline, :description, :staffid)";
        $params = [
            ':taskname' => $data['taskname'],
            ':date' => $data['date'],
            ':deadline' => $data['deadline'],
            ':description' => $data['description'],
            ':staffid' => $data['staffid']
        ];
      
        return $this->query($query, $params);
    }

    public function updateStatus2($taskid){
        $query= "UPDATE $this->table SET status = 'Overdue' WHERE taskid = :taskid";
        $params = [

            ':taskid' => $taskid
        ];
        return $this->query($query, $params);
    }


}

