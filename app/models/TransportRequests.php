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
        'sport_id',
        'status'
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


            $query = "INSERT INTO transport_requests (no_of_members, date, location, time, reason, sport_id, status)
             VALUES (:no_of_members, :date, :location, :time, :reason, :sport_id, :status)";

                $result = $this->query($query,[
                'no_of_members' => $_POST['no_of_members'], 
                'date' => $_POST['date'],
                'location' => $_POST['location'],
                'time' => $_POST['time'],
                'reason' => $_POST['reason'],
                'status' => $_POST['status'],
                'sport_id' => (int) $sportId

            ]);

            return $result;

        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
            return false;
        }
    }


        public function getRequests(){

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

                $query = "SELECT * FROM transport_requests WHERE sport_id = :sport_id";
                return $this->query($query, ['sport_id' => $sportId]);
            }catch(Exception $e){
                $_SESSION['error'] = $e->getMessage();
                return false;
            }
        }

        
    public function viewAllTransportRequests(){
        $query="SELECT * FROM $this->table t
                JOIN sport ON sport.sport_id= t.sport_id";
        return $this->query($query);        

    }

    public function handleAction($id, $action)
    {
        if (!in_array($action, ['approve', 'reject'])) {
            return ['success' => false, 'message' => 'Invalid action'];
        }
        
        $status = ($action === 'approve') ? 'Approved' : 'Rejected';
        
        $query = "UPDATE $this->table SET status = :status WHERE request_id = :id";
        $params = [':status' => $status, ':id' => $id];
        
        $result = $this->query($query, $params);
        
        if ($result) {
            return [
                'success' => true, 
                'message' => "transport request " . ($action === 'approve' ? 'approved' : 'rejected') . " successfully"
            ];
        } else {
            return [
                'success' => false,
                'message' => "Failed to " . $action . " transport request"
            ];
        }
    }
}
