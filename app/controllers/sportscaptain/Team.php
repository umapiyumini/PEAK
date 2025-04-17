<?php
class Team extends Controller{

    private function getUserId() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['userid'])) {
            die("User not logged in.");
        }
        return $_SESSION['userid'];
    }

   public function index(){

    $teamModel = new Players();
    $players = $teamModel->getPlayers();

        $this->view('sportscaptain/team',['players'=>$players]);
    }

    public function addplayer(){
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $regno = trim($_POST['regno'] ?? '');
            $position = trim($_POST['position'] ?? '');
            $jerseyno = trim($_POST['jerseyno'] ?? '');

            if(empty($regno) || empty($position) || empty($jerseyno)){
                $_SESSION['error'] = 'All fields are required';
                header('Location:' . ROOT . '/sportscaptain/team');
                exit();
            }
            try{
            $teamModel = new Players();

            $result = $teamModel->addPlayer($regno, $position, $jerseyno);
             
            if ($result) {
                $_SESSION['success'] = "Player added successfully!";
            } else {
                $_SESSION['error'] = "Failed to add player. Please try again.";
            }
         
        }catch(Exception $e){
            $_SESSION['error'] = 'Something went wrong while adding the player. Please try again.'; 
        }

        header('Location:' . ROOT . '/sportscaptain/team');
        exit();
    }
}

    public function deleteplayer(){

        if($_SERVER['REQUEST_METHOD']=== 'POST'){

            $regno = $_POST['regno'] ?? null;

            if(!$regno){
                $_SESSION['error'] = 'Registration number is required';
                header('Location:' . ROOT . '/sportscaptain/team');
                exit();
            }

            try{
            $teamModel = new Players();
            $result = $teamModel->deletePlayer(
                $_POST['regno']
            );

            if($result){
                $_SESSION['success'] = 'Player deleted successfully!';
            }else{
                $_SESSION['error'] = 'Failed to delete player. Please try again.';
            }

        }catch(Exception $e){
            $_SESSION['error'] = 'Something went wrong while adding the player. Please try again.';
        }

        header('Location:' . ROOT . '/sportscaptain/team');
        }
    }

    public function updateplayer(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $regno = trim($_POST['regno'] ?? '');
            $position = trim($_POST['position'] ?? '');
            $jerseyno = trim($_POST['jerseyno'] ?? ''); 
            
            if(empty($regno) || empty($position) || empty($jerseyno)){
                $_SESSION['error'] = 'All fields are required';
                header('Location:' . ROOT . '/sportscaptain/team');
                exit();
            }
            
            try{
                $teamModel = new Players();
                $result = $teamModel->updatePlayer(
                    $regno,
                    $position,
                    $jerseyno
                );

                if($result){
                    $_SESSION['success'] = 'Player updated successfully!';
                }else{
                    $_SESSION['error'] = 'Failed to update player. Please try again.';
                }
                
                
            }catch(Exception $e){
                $_SESSION['error'] = 'Something went wrong while adding the player. Please try again.';
            }
            
            header('Location:' . ROOT . '/sportscaptain/team');
            exit();
        }
    }
    }



   

