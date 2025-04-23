<?php

class Feedback {
    use Model;
    
    protected $table = 'feedback';
    protected $fillable = ['userid', 'content', 'rating', 'date', 'time']; // Include rating here

    public function getTable() {
        return $this->table;
    }

    
        public function getLatest($limit = 2) {
            // Adjust the column names if you use something else for ordering
            $query = "SELECT * FROM {$this->table} ORDER BY date DESC, time DESC LIMIT $limit";
            return $this->query($query);
        }
    }
    

