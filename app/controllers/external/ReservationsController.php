<?php

session_start(); // Start session

// Debugging
echo "<pre>";
var_dump($_SESSION);
echo "</pre>";
exit;

class ReservationsController {
    public function index() {
        // if (!isset($_SESSION['userid'])) {
        //     die("User not logged in");
        // }

        $reservations = new Reservations();
        $user_id = $_SESSION['userid'];

        $this->data['reservations'] = $reservations->where('userid', $user_id);

        $this->view('/staffdashboard', $this->data);
    }
}
?>
