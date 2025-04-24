<?php

class Feedback {
    use Model;
    
    protected $table = 'feedback';
    protected $allowed_columns = ['userid', 'content', 'rating', 'date', 'time']; // Include rating here

    public function getTable() {
        return $this->table;
    }


    public function insert($data) {
        $columns = implode(", ", array_keys($data));
        $values  = ":" . implode(", :", array_keys($data));
    
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($values)";
        
        
        return $this->query($sql, $data);
    }
    
    
        public function getLatest($limit = 2) {
            
            $query = "SELECT * FROM {$this->table} ORDER BY date DESC, time DESC LIMIT $limit";
            return $this->query($query);
        }
    }
    

