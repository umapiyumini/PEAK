<?php
class Courts {
    use Model; // Use the Database trait to access the query methods

    protected $table = 'courts';
    protected $fillable = ['courtid', 'name', 'location', 'section', 'description', 'image','sport_id'];

    private function getUserId() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['userid'])) {
            die("User not logged in.");
        }
        return $_SESSION['userid'];
    }


    //used 

    // Fetch all courts
    public function getAllCourts() {
        // Query to select all records from the courts table
        $query = "SELECT * FROM " . $this->table;
        
        // Use the query method from the Database trait to execute the query
        return $this->query($query);
    }


    public function getCourtById($id) {
        $query = "SELECT * FROM $this->table WHERE courtid = :id";
        $result = $this->query($query, ['id' => $id]);
        return $result ? $result[0] : null;
    }

    //not yet



    
    


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


    
    public function getcourt($userId = null){

        if($userId === null) {
            $userId = $this->getUserId();
        }

        if (!$userId) {
            die("User ID not found in session.");
        }

        try{
            $query = "SELECT * FROM courts 
                        JOIN sports_captain ON courts.sport_id = sports_captain.sport_id 
                        WHERE sports_captain.userid = :userid";

            $result = $this->query($query, ['userid' => $userId]);

            return $result[0] ?? null;

        }catch(Exception $e){
            die("Error fetching court by sport: " . $e->getMessage());
        }
    }



    public function update($id, $data) {
        $keys = array_keys($data);
        $set = implode(", ", array_map(fn($key) => "$key = :$key", $keys));
        $data['courtid'] = $id;
    
        $query = "UPDATE $this->table SET $set WHERE courtid = :courtid";
        return $this->query($query, $data);
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

    public function delete($courtid) {
        $query = "DELETE FROM $this->table WHERE courtid = :courtid";
        return $this->query($query, ['courtid' => $courtid]);
    }

    public function getGroundCourtsBySection(){
        $query = "SELECT * FROM $this->table WHERE location = 'ground' 
          AND section IS NOT NULL 
          AND section != ''";
        return $this->query($query);
    }

    public function getIndoorCourtsBySection(){
        $query = "SELECT * FROM $this->table WHERE location = 'indoor' 
          AND section IS NOT NULL 
          AND section != ''";
        return $this->query($query);
    }
    


    public function getCourtByName($name) {
        $query = "SELECT * FROM {$this->table} WHERE name = :name LIMIT 1";
        $result = $this->query($query, ['name' => $name]);
        return $result ? $result[0] : null;
    }
    
    
}

?>