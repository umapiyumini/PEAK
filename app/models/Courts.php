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
}

?>