<?php
    class Users extends Controller{
        public function index(){
            $sportModel= new Sport();
            $sportsList= $sportModel->findAllSports();
            $this->view('ped_incharge/users', ['sportsList' => $sportsList]);
        }
        public function studentReg(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            show($_POST);
            $user = new User();
            $user->studentReg($_POST);
            $_POST['userid'] = $user->getLastID();
            $student = new Student();
            $student->studentReg($_POST);
            header('Location: users');
        }
        }

        public function captainReg(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $player = new Players();
                if($player->playerByRegno($_POST['regno'])){
                    $student = new Student();
                    $_POST['userid'] = $student->getuserID($_POST['regno'])[0]->userid;
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
                    $club= new Amalgamatedclub();
                    $club->clubReg($_POST);
                }
                header('Location: users');
            }
        }
}