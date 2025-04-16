<?php

class Feedback {
    use Model;
    
    protected $table = 'feedback';
    protected $fillable = ['userid', 'content', 'rating', 'date', 'time']; // Include rating here

    public function getTable() {
        return $this->table;
    }
}
