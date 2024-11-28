<?php
class Signupex1 extends Controller{

   public function index(){
    // $data = [];
   

        $user = new User();
    

        if($user->validate($_POST)){
            
            $password = password_hash($_POST('password'),PASSWORD_DEFAULT);

            $func->set('password',$pasword);
            $user->insert($_POST);
            redirect('login');
        }
        $data['errors'] =$user ->errors;
    
   

    

        $this->view('signupex1',$data);
    }

   

}