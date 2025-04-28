<?php

    
    class Externalhome extends Controller {
        public function index() {
            $user_id = $_SESSION['userid']; 
            

            $userModel = new User();
            $user_data = $userModel->getUser($user_id);
            $user = (!empty($user_data)) ? $user_data[0] : null;
            $this->data['user'] = $user;


          
            $externalUserModel = new External_User();
            $company_data = $externalUserModel->where(['userid' => $user_id]);
            $company_name = (!empty($company_data)) ? $company_data[0]->company_name : '';
            $this->data['company_name'] = $company_name;


     
            $courtsModel = new Courts();
            $topCourts = $courtsModel->query("SELECT * FROM courts LIMIT 4");
            $this->data['topCourts'] = $topCourts;



                
            $reservationsModel = new Reservations();
    
            $this->data['upcoming'] = $reservationsModel->getupcomingevents($user_id);
            $this->data['duePayments'] = $reservationsModel->getDuePayments($user_id);
    

            $this->view('external/externalhome', $this->data);
    }
           
        }
    
    

