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
        
        // For active reservations (future only)
        $this->data['active_reservations'] = $reservationsModel->getFutureReservationsByUser($user_id);
        
        // For reservation history (all)
        $this->data['history_reservations'] = $reservationsModel->getAllReservationsByUser($user_id);
        
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
    
    public function checkAvailability() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $date = $_POST['date'] ?? null;
            $section = $_POST['section'] ?? null;
            if ($date && $section) {
                $reservationsModel = new Reservations();
                // Get all bookings for this date/section
                $bookings = $reservationsModel->getBookingsForDateSection($date, $section);
                header('Content-Type: application/json');
                echo json_encode($bookings);
                exit;
            }
        }
        http_response_code(400);
        echo json_encode(['error' => 'Invalid request']);
        exit;
    }

    public function rescheduleReservation() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $reservationid = $_POST['reservationid'] ?? null;
            $date = $_POST['date'] ?? null;
            $time = $_POST['time'] ?? null;
            $duration = $_POST['duration'] ?? null;
            $userid = $_SESSION['userid'] ?? null;
    
            if ($reservationid && $userid && $date && $time && $duration) {
                $reservationsModel = new Reservations();
                $reservation = $reservationsModel->findById($reservationid);
                if ($reservation && $reservation->userid == $userid) {
                    // Update only date, time, duration
                    $reservationsModel->update($reservationid, [
                        'date' => $date,
                        'time' => $time,
                        'duration' => $duration,
                        'status' => 'pending'
                    ]);
                    
                    header("Location: " . ROOT . "/external/reservation?reschedule=success");
                    exit;
                }
            }
            header("Location: " . ROOT . "/external/reservation?reschedule=fail");
            exit;
        }
    }
    
    
    
}
?>
