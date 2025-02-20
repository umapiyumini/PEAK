<?php
class Externalhome extends Controller {
    
    public function index() {
        $reservationsModel = new Reservations();
        $user_id = $_SESSION['userid']; // Assuming user is logged in

        // Fetch pending reservations for the user
        $this->data['pendingRequests'] = $reservationsModel->getPendingReservations($user_id);
        $this->data['duePayments'] = $reservationsModel->getDuePayments($user_id);
        $this->view('external/externalhome', $this->data);
    }
}


   
   

