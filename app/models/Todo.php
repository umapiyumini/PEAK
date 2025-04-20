<?php

class Todo {
    use Model;
    protected $table = 'stafftodo';
    protected $columns = ['taskid','taskname','date', 'time', 'description', 'deadline', 'status'];


    public function findAllStaffTodo() {
        $query = "SELECT * FROM stafftodo WHERE status = 'Pending' ORDER BY deadline ASC";
        return $this->query($query);
    }

    public function updateStatus($taskid, $status){

        $query = "UPDATE stafftodo SET status = :status WHERE taskid = :taskid";

        $result = $this->query($query,[
            'taskid' => $taskid,
            'status' => $status
        ]);

        return $result;
            

    }
}

