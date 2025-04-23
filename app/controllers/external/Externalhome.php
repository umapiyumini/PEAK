<?php

    
    class Externalhome extends Controller {
        public function index() {
            $reservationsModel = new Reservations();
            $user_id = $_SESSION['userid']; // Assuming the user is logged in
    
            // Fetch upcoming events and due payments
            $this->data['upcoming'] = $reservationsModel->getupcomingevents($user_id);
            $this->data['duePayments'] = $reservationsModel->getDuePayments($user_id);
    
            // Fetch user details
            $userModel = new User();
            $user_data = $userModel->getUser($user_id);
            $user = (!empty($user_data)) ? $user_data[0] : null;
            $this->data['user'] = $user;
    
            // Fetch company details
            $externalUserModel = new External_User();
            $company_data = $externalUserModel->where(['userid' => $user_id]);
            $company_name = (!empty($company_data)) ? $company_data[0]->company_name : '';
            $this->data['company_name'] = $company_name;
    

            //top picks
            $user_id = $_SESSION['userid'];

        $this->data['upcoming'] = $reservationsModel->getUpcomingevents($user_id);
        $this->data['duePayments'] = $reservationsModel->getDuePayments($user_id);

        $userModel = new User();
        $user_data = $userModel->getUser($user_id);
        $user = (!empty($user_data)) ? $user_data[0] : null;
        $this->data['user'] = $user;

        $externalUserModel = new External_User();
        $company_data = $externalUserModel->where(['userid' => $user_id]);
        $company_name = (!empty($company_data)) ? $company_data[0]->company_name : '';
        $this->data['company_name'] = $company_name;

        // Fetch top 3 courts
        $courtsModel = new Courts();
        $topCourts = $courtsModel->query("SELECT * FROM courts LIMIT 4");
        $this->data['topCourts'] = $topCourts;

        $this->view('external/externalhome', $this->data);
    }
           
        }
    
    

