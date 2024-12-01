<?php

class Signups2 extends Controller{

    public function index(){
        $data = [];
        $user = new User;
        $student = new Student;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $uservalid = $user->validate($_POST);
            $studentvalid = $student->validate($_POST);
            if($uservalid && $studentvalid) {
                // show("validated");
                $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $_POST['createdate'] = date('Y-m-d H:i:s');

                $_POST['username'] = $_POST['email'];
                $_POST['role'] = "Internal User";

                $user->insert($_POST);
                
                $userid = $user->getLastID();
                $_POST['userid'] = $userid;

                $student->insert($_POST);
                header('Location: login');
                exit;
            }
            $data['errors'] = $user->errors;
            $data['studenterrors'] = $student->studenterrors;
        }

        $this->view('signups2', $data);
    }
}