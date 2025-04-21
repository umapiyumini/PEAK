<?php 

class AttendenceExcuse{

    use Model;
    protected $table = 'attendance_excuse';
    protected $allowcolumns = [
        'faculty',
        'sport_id',
        'tournament_name',
        'start_date',
        'end_date',
        'reg_no',
        'submit_date',
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

    public function insertExcusedata(){

        $userId = $this->getUserId();
        if (!$userId) {
            die("User ID not found in session.");
        }

        try{

           $sportQuery = "SELECT sport_id FROM sports_captain WHERE userid = :userid";
           $sportResult = $this->query($sportQuery, ['userid' => $userId]);
        

            if (!$sportResult || count($sportResult) == 0) {
                throw new Exception("Sport ID not found for this user");
            }

            $sportId = $sportResult[0]->sport_id;

            $regNumbers = isset($_POST['reg_no']) ? $_POST['reg_no'] : [];
            $regNumbersStr = implode(',', $regNumbers);

            

            $query = "INSERT INTO attendance_excuse(faculty, sport_id, tournament_name, start_date, end_date, submit_date,status)
                 VALUES (:faculty, :sport_id, :tournament_name, :start_date, :end_date, :submit_date, :status)
                 ";

            $result = $this->query($query,[
                'faculty' => $_POST['faculty'],
                'sport_id' => (int) $sportId,
                'tournament_name' => $_POST['tournament_name'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'submit_date' => $_POST['submit_date'],
                'status' => $_POST['status']
            ]);


            $excuseId = $this->lastInsertId();

            foreach($regNumbers as $regNo) {
                $excusequery = "INSERT INTO attendance_excuse_players (excuse_id, reg_no) VALUES (:excuse_id, :reg_no)";
                $this->query($excusequery, [
                    'excuse_id' => $excuseId,
                    'reg_no' => $regNo
                ]);
            }


            if (!$result) {
                $success = false;
            }
        

            return $success;
        
            
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
            return false;
        }

    }

    public function getRequestBySport(){

        $userId = $this->getUserId();
        if(!$userId){
            die("User ID not found in session.");
        }

        try{

            $sportQuery = "SELECT sport_id FROM sports_captain WHERE userid = :userid";
            $sportResult = $this->query($sportQuery,['userid' => $userId]);

            if(!$sportResult || count($sportResult) == 0){
                throw new Exception("Sport ID not found for this user");
            }

            $sportId = $sportResult[0]->sport_id;

            $query = "SELECT * FROM attendance_excuse WHERE sport_id = :sport_id && status = 'Pending' ";

            $result = $this->query($query, ['sport_id' => (int) $sportId]);

            return $result;

        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }



}