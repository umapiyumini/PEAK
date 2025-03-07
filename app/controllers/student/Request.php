<?php 
class Request extends Controller{
    public function index(){

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            //Get DATA

            $data =[
                'Name' => $_POST['Name'],
                'RegistrationID' => $_POST['RegistrationID'],
                'HaveYouPlayedBefore'=>$_POST['HaveYouPlayedBefore'],
                'ReasonForJoining'=>$_POST['ReasonForJoining'],
            ];

            $teamrequest = new Teamrequest();

            if($teamrequest->validate($data))
            {
                $isInserted = $teamrequest->insert($data);

                if(!$isInserted){
                    redirect('student/Addteamrequest');
                }
            }
        }
        else{
            $this->view('student/request');
        }
    }
}