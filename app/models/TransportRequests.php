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
    }
