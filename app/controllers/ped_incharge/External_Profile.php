<?php

class External_Profile extends Controller
{
    public function index($userid = null)
    {
        if (!$userid) {
            die("No user specified.");
        }

        $userModel = new User();
        $reservationsModel = new Reservations();


       
        $query = "SELECT u.*, eu.company_name 
                  FROM user u 
                  JOIN external_user eu ON u.userid = eu.userid 
                  WHERE u.userid = :userid";
        $params = [':userid' => $userid];
        $result = $userModel->query($query, $params);

        if (!$result || count($result) === 0) {
            die("User not found.");
        }

        $user = $result[0];

        
        if (!empty($user->image)) {
            $user->image_url = LINKROOT . '/uploads/profile_pictures/' . htmlspecialchars($user->image);
        } else {
            $user->image_url = LINKROOT . '/assets/images/ped_incharge/externalcustomer.png';
        }

        
       
        $reservations = $reservationsModel->getReservationsByUser($userid);

        $this->view('ped_incharge/external_Profile', [
            'user' => $user,
            'reservations' => $reservations
        ]);
      

      
}
}