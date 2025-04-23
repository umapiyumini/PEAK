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

    
}

?>