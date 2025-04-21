<?php

class StaffTodo {
    use Model;
    protected $table = 'stafftodo';

    public function findAllStaffTodo() {
        $query = "SELECT * FROM $this->table";
        return $this->query($query);
    }

    public function addTask($data) {
        $query = "INSERT INTO $this->table (taskname, date, deadline, description, assignedto) VALUES (:taskname, :date, :deadline, :description, :assignedto)";
        $params = [
            ':taskname' => $data['taskname'],
            ':date' => $data['date'],
            ':deadline' => $data['deadline'],
            ':description' => $data['description'],
            ':assignedto' => $data['assignedto']
        ];
      
        return $this->query($query, $params);
    }

    public function updateStatus($taskid){
        $query= "UPDATE $this->table SET status = 'Overdue' WHERE taskid = :taskid";
        $params = [

            ':taskid' => $taskid
        ];
        return $this->query($query, $params);
    }
}

