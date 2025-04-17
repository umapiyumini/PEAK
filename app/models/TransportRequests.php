<?php 

class TransportRequests{
    use Model;
    protected $table = 'transport_requests';
    protected $allowcolumns = [
        'no_of_members',
        'date',
        'location',
        'time',
        'reason', 
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

    public function insertRequestTransport(){

        $userId = $this->getUserId();
        if(!$userId){
            die("User ID not found in session.");
        }

        try{

            $sportQuery = "SELECT sport_id FROM sports_captain WHERE userid = :userid";
            $sportResult = $this->query($sportQuery, ['userid' => $userId]);

            if(!$sportResult || count($sportResult) == 0){
                throw new Exception("Sport ID not found for this user");
            }

            $sportId = $sportResult[0]->sport_id;

            $noOfMembers = $_POST['no_of_members'] ?? null;
            $date = $_POST['date'] ?? null;
            $location = $_POST['location'] ?? null;
            $time = $_POST['time'] ?? null;
            $reason = $_POST['reason'] ?? null;

            if(empty($noOfMembers) || empty($date) || empty($location) || empty($time) || empty($reason)){
                throw new Exception("All fields are required");
            }

            $query = "INSERT INTO transport_requests (no_of_members, date, location, time, reason, sport_id)
             VALUES (:no_of_members, :date, :location, :time, :reason, :sport_id)";

            $result = $this->query($query,[
                'no_of_members' => $noOfMembers,
                'date' => $date,
                'location' => $location,
                'time' => $time,
                'reason' => $reason,
                'sport_id' => $sportId
            ]);

            return $result;

        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
            return false;
        }

    }
}