<?php
class Message {
    use Model;
    
    protected $table = 'message';
    protected $fillable = ['userid', 'content', 'date', 'time'];

    public function insert($data) {
        $columns = implode(", ", array_keys($data));
        $values  = ":" . implode(", :", array_keys($data));
    
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($values)";
        
        // Debug: Output the SQL query
        echo "SQL Query: " . $sql . "<br>";
        var_dump($data);  // Check the values being passed to the query
        
        return $this->query($sql, $data);
    }
    
    // Inside the Message model
public function getTable() {
    return $this->table;
}

    
}
