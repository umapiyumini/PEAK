<?php
class Courts {
    use Model; // Use the Database trait to access the query methods

    protected $table = 'courts';
    protected $fillable = ['courtid', 'name', 'location', 'section', 'description', 'image'];

    // Fetch all courts
    public function getAllCourts() {
        // Query to select all records from the courts table
        $query = "SELECT * FROM " . $this->table;
        
        // Use the query method from the Database trait to execute the query
        return $this->query($query);
    }


     // Fetch courts by location
     public function getCourtsByLocation($location) {
        $query = "SELECT * FROM " . $this->table . " WHERE location = :location";
        
        // Execute the query using the provided location
        return $this->query($query, ['location' => $location]);
    }
    // Additional methods can be added here if needed for other operations

    public function getTable() {
        return $this->table;
    }


    public function update($id, $data) {
        $keys = array_keys($data);
        $set = implode(", ", array_map(fn($key) => "$key = :$key", $keys));
        $data['courtid'] = $id;
    
        $query = "UPDATE $this->table SET $set WHERE courtid = :courtid";
        return $this->query($query, $data);
    }

    
    public function getCourtById($id) {
        $query = "SELECT * FROM $this->table WHERE courtid = :id";
        $result = $this->query($query, ['id' => $id]);
        return $result ? $result[0] : null;
    }
    
    public function getSectionByCourtid($courtid) {
        $query = "SELECT section FROM courts WHERE courtid = :courtid LIMIT 1";
        $result = $this->query($query, ['courtid' => $courtid]);
        return $result ? $result[0]->section : null;

    }
    
    public function insert($data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $query = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";
        return $this->query($query, $data);
    }
    
}

?>