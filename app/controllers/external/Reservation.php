<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Reservation extends Controller { 
    private $data = []; 

    public function index() {
        if (!isset($_SESSION['userid'])) {
            die("User not logged in inside index()");
        }

        $reservationsModel = new Reservations(); 
        $user_id = $_SESSION['userid'];

        // Fetch reservations from the database
        $this->data['reservations'] = $reservationsModel->getReservationsByUser($user_id);

        $this->view('external/reservation', $this->data); 
    }
}
?>
