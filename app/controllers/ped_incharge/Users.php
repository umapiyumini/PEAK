<?php
    class Users extends Controller{
        public function index(){
            $sportModel= new Sport();
            $userModel= new User();
            $sportsList= $sportModel->findAllSports();
            $usersList= $userModel->findAllUsers();
            $this->view('ped_incharge/users', ['sportsList' => $sportsList, 'usersList' => $usersList]);
        }
        public function studentReg(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();
            if($user->validate2($_POST)) {
                $user->studentReg($_POST);
                $_POST['userid'] = $user->getLastID();
                $student = new Student();
                $student->studentReg($_POST);
                $_SESSION['success']= "Student Registered Successfully";
            } else {
                // show($user->errors);
                $_SESSION['errors'] = $user->errors;
            }
            header('Location: users');
        }
        }

        public function captainReg(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $player = new Players();
                if($player->playerByRegno($_POST['regno'])){
                    $student = new Student();
                    $_POST['userid'] = $student->getuserID($_POST['regno'])[0]->userid;
                    
                    $user= new User();
                    $user->changeRole($_POST['userid'], 'Sports Captain');
                    
                    $sportcaptain = new Sports_captain();
                    show($_POST);
                    $sportcaptain->captainReg($_POST);
                }
                header('Location: users');
            }
        }

        public function clubReg(){
            if( $_SERVER['REQUEST_METHOD']=='POST'){
                $captain= new Sports_captain();
                $user= new User();
                if($captain->captainByRegno($_POST['regno'])){
                    $captain=new Sports_captain();
                    $_POST['userid'] = $captain->getuserID($_POST['regno'])[0]->userid;
                    $user= new User();
                    $user->changeRole($_POST['userid'], 'Amalgamated Club Executive');
                    $club= new Amalgamatedclub();
                    $club->clubReg($_POST);
                }
                header('Location: users');
            }
        }

    

}