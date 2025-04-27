<?php 

class ColoursNight{
    use Model;
    protected $table = 'coloursnight_forms';
    protected $allowcolumns = [
        'sport_id',
        'team_gender',
        'student_name',
        'reg_no',
        'interuni_performance',
        'awards',
        'rewards',
        'merit_awards',
        'captain_regno',
        'submit_date'
    ];

    private function getUserId(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['userid'])) {
            die("User not logged in.");
        }
        return $_SESSION['userid'];
    
    }

    public function addFormdetails(){

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

            $teamgender = $_POST['team_gender'] ?? null;
            $studentname = $_POST['student_name'] ?? null;
            $regno = $_POST['reg_no'] ?? null;
            $interuniperformance = $_POST['interuni_performance'] ?? null;
            $awards = $_POST['awards'] ?? null;
            $rewards = $_POST['rewards'] ?? null;
            $meritawards = $_POST['merit_awards'] ?? null;
            $captainregno = $_POST['captain_regno'] ?? null;
            $submitdate = $_POST['submit_date'] ?? null;

            $query = "INSERT INTO coloursnight_form (sport_id, team_gender, student_name, reg_no, interuni_performance, awards, rewards, merit_awards, captain_regno, submit_date)
                    VALUES(:sport_id, :team_gender, :student_name, :reg_no, :interuni_performance, :awards, :rewards, :merit_awards, :captain_regno, :submit_date)";

            $result = $this->query($query, [
                    'sport_id' => $sportId, 
                    'team_gender' => $teamgender, 
                    'student_name' => $studentname,
                    'reg_no' => $regno, 
                    'interuni_performance' => $interuniperformance,
                    'awards' => $awards,
                    'rewards' => $rewards,
                    'merit_awards' => $meritawards,
                    'captain_regno' => $captainregno,
                    'submit_date' => $submitdate
            ]);

            return $result;

        

        }catch(Exception $e){

            $_SESSION['error'] = $e->getMessage();
            return false;
        }
    }
    

}