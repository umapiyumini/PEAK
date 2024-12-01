<?php
class Signupex1 extends Controller{

    public function index(){
        $data = [];
        $user = new User;
        $exuser = new External_User;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $uservalid = $user->validate($_POST);
            $exvalid = $exuser->validate($_POST);
            
            if($uservalid && $exvalid) {
                // show("validated");
                $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $_POST['createdate'] = date('Y-m-d H:i:s');

                $_POST['username'] = $_POST['email'];
                $_POST['role'] = "External User";

                $user->insert($_POST);
                
                $userid = $user->getLastID();
                $_POST['userid'] = $userid;

                $exuser->insert($_POST);
                header('Location: '.ROOT.'/login');
                exit;
            }
            $data['errors'] = $user->errors;
            $data['exerrors'] = $exuser->exerrors;
        }


        $this->view('signupex1', $data);
    }
}