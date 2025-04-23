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

}

