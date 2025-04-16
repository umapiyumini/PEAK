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
        'submit_date'
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

            $query = "INSERT INTO attendance_excuse(faculty, sport_id, tournament_name, start_date, end_date, reg_no, submit_date)
                 VALUES (:faculty, :sport_id, :tournament_name, :start_date, :end_date, :reg_no, :submit_date)
                 ";

            $result = $this->query($query,[
                'faculty' => $_POST['faculty'],
                'sport_id' => (int) $sportId,
                'tournament_name' => $_POST['tournament_name'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'reg_no' =>  $regNumbersStr,
                'submit_date' => $_POST['submit_date']
            ]);

            return $result;

            
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
            return false;
        }

    
}



}