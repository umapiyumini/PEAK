<?php

class StaffTodo {
    use Model;
    protected $table = 'stafftodo';

    public function findAllStaffTodo() {
        $query = "SELECT * FROM $this->table";
        return $this->query($query);
    }
}

