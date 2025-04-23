<?php

class Recruitmentrequests{

    use Model;
    protected $table = 'recruitments';
    protected $allowcolumns = [
        'regno',
        'name',
        'faculty',
        'reason',
        'sport_id',
        'status'
    ];

    public function getUserId(){

        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['userid'])){
            die("User not logged in.");
        }
        return $_SESSION['userid'];
    }

    public function getRecruitmentRequests(){

        $userId = $this->getUserId();
        if(!$userId){
            die("User ID not found in session.");
        }

        try{

        $query = "SELECT recruitments.* FROM sports_captain
                JOIN sport ON sports_captain.sport_id = sport.sport_id
                JOIN recruitments ON sports_captain.sport_id = recruitments.sport_id
                WHERE sports_captain.userid = :userid AND recruitments.status ='pending'";

        return $this->query($query, ['userid' => $userId]);

        }catch(Exception $e){
            die("Error fetching recruitment requests: " . $e->getMessage());
        }

    }

    public function approverequest($regno = null){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $regno = $_POST['regno'] ?? $regno ?? null;
    
            if (!$regno) {
                $_SESSION['error'] = 'Registration number is required';
                header('Location:' . ROOT . '/sportscaptain/recruitment');
                exit();
            }
    
            try {
                $recruitmentModel = new Recruitmentrequests();
                $request = $recruitmentModel->approveRequest($regno);
    
                if ($request) {
                    $_SESSION['success'] = 'Request approved successfully';
                    // Respond with a success message for AJAX
                    echo json_encode(['success' => true]);
                } else {
                    $_SESSION['error'] = 'Failed to approve request';
                    echo json_encode(['success' => false]);
                }
            } catch(Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }
        }
        exit();
    }
    
    

    public function rejectRequest($regno){

        try{

            $query = "UPDATE recruitments SET status = 'reject' WHERE regno = :regno";
            $result = $this->query($query, [
                'regno' => $regno,
               
            ]);

            return $result;
        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
        }
    }
                
}