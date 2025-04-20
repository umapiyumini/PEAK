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

    public function cancelReservation() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $reservationid = $_POST['reservationid'] ?? null;
            $userid = $_SESSION['userid'] ?? null;
    
            if ($reservationid && $userid) {
                $reservationsModel = new Reservations();
                // Optional: Check if reservation belongs to this user
                $reservation = $reservationsModel->findById($reservationid);
                if ($reservation && $reservation->userid == $userid) {
                    $reservationsModel->delete($reservationid);
                    // Optionally, log the cancellation reason
                    // Redirect or show success message
                    header("Location: " . ROOT . "/external/reservation?cancel=success");
                    exit;
                }
            }
            // If failed
            header("Location: " . ROOT . "/external/reservation?cancel=fail");
            exit;
        }
    }
    
}
?>
