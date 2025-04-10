<?php
class Externalhome extends Controller {
    
    public function index() {
        $reservationsModel = new Reservations();
        $user_id = $_SESSION['userid']; // Assuming the user is logged in

        // Fetch pending reservations for the user
        $this->data['pendingRequests'] = $reservationsModel->getPendingReservations($user_id);
        
        // Fetch due payments for the user
        $this->data['duePayments'] = $reservationsModel->getDuePayments($user_id);
        
        // Pass the data to the view
        $this->view('external/externalhome', $this->data);
    }
}
