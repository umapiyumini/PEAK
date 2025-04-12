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
             
         
        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();  
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

        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
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
                
                
            }catch(Exception $e){
                $_SESSION['error'] = $e->getMessage();
            }
            
            header('Location:' . ROOT . '/sportscaptain/team');
            exit();
        }
    }
    }



   

