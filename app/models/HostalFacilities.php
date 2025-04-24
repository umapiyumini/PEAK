<?php
class HostalFacilities{
    use Model;
    protected $table = 'hostal_facilities';
    protected $allowcolumns = [
        'reg_no',
        'start_date',
        'end_date',
        'priority',
        'sport_id'
    ];
    
    private function getUserId() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['userid'])) {
            die("User not logged in.");
        }
        return $_SESSION['userid'];
    }
    
    public function insertRequesthostal($facilities){
        $userId = $this->getUserId();
        if (!$userId){
            die("User ID not found in session.");
        }
        
        try{
            $sportQuery = "SELECT sport_id FROM sports_captain WHERE userid = :userid";
            $sportResult = $this->query($sportQuery, ['userid' => $userId]);
            
            if (!$sportResult || count($sportResult) == 0) {
                throw new Exception("Sport ID not found for this user");
            }
            
            $sportId = $sportResult[0]->sport_id;
            
            foreach($facilities as $facility){
                $query = "INSERT INTO hostal_facilities(reg_no, start_date, end_date, priority, sport_id)
                    VALUES (:reg_no, :start_date, :end_date, :priority, :sport_id)";
                
                $data = [
                    'reg_no' => $facility['reg_no'],
                    'start_date' => $facility['start_date'],
                    'end_date' => $facility['end_date'],
                    'priority' => $facility['priority'],
                    'sport_id' => $sportId
                ];
                
                $result = $this->query($query, $data);
            }
                return true;
                
            
        } catch(Exception $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    public function getHostalData(){
        $userId = $this->getUserId();
        if(!$userId){
            die("User ID not found in session.");
        }
        
        try{
            $sportQuery = "SELECT sport_id FROM sports_captain WHERE userid = :userid";
            $sportResult = $this->query($sportQuery, ['userid' => $userId]);
            
            if (!$sportResult || count($sportResult) == 0) {
                return [];
            }
            
            $sportId = $sportResult[0]->sport_id;
            
            $query = "SELECT * FROM hostal_facilities WHERE sport_id = :sport_id";
            
            $result = $this->query($query, ['sport_id' => (int) $sportId]);
            
            return $result;
            
        } catch(Exception $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}