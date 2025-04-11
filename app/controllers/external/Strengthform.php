<?php
// Your existing code follows below:
class Strengthform extends Controller {

    public function index() {
        $this->view('external/strengthform');
    }

    public function getPrice() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subscription = isset($_POST['subscription']) ? $_POST['subscription'] : '';
    
            $strengthhall = new Strengthhall();
            $price = $strengthhall->getPriceBySubscription($subscription);
    
            // Return the price as plain text
            if ($price !== null) {
                echo $price;  // Return the price as plain text
            } else {
                echo "Price not found";  // In case no price is returned
            }
        }
    }

    public function book() {
        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        // Get the user ID (from session)
        $userId = $this->getUserId(); // This should check if the user is logged in
    
        // Get the subscription and price from POST data
        $subscription = $_POST['subscription'];
        $price = $_POST['price'];
    
        // Convert the subscription type into months (for the expiry check)
        $months = match ($subscription) {
            'annual' => 12,
            '6 month' => 6,
            '3 month' => 3,
            default => 0,
        };
    
        if ($months > 0) {
            // Check if there is already a reservation for this user within the last year (or subscription period)
            $reservation = new Reservations();
            $query = "SELECT * FROM reservations WHERE userid = :userid AND subscription = :subscription AND created_at >= DATE_SUB(NOW(), INTERVAL :months MONTH)";
            $existing = $reservation->query($query, ['userid' => $userId, 'subscription' => $subscription, 'months' => $months]);
    
            // Check if any existing reservation is found
            if ($existing) {
                // If an existing reservation is found, show an error message and don't continue with the booking
                $_SESSION['error_message'] = "You already have an active {$subscription} subscription.";
                // Redirect back to the form or stay on the page
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            } else {
                // If no existing reservation, continue with the booking process
    
                // Prepare data for inserting the reservation into the database
                $data = [
                    'userid' => $userId,
                    'courtid' => 38,  // Assuming the court ID is fixed
                    'price' => $price,
                    'status' => 'pending',  // Set status to 'pending'
                    'subscription' => $subscription,
                    'created_at' => date('Y-m-d H:i:s'),  // Current timestamp
                ];
    
                // Insert the new reservation
                $reservation->insert($data);
    
                // Set a success message for the user
                $_SESSION['success_message'] = "Your {$subscription} subscription has been successfully booked!";
                // Redirect to a confirmation page or stay on the same page
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
        } else {
            // If the subscription type is invalid
            $_SESSION['error_message'] = "Invalid subscription type.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
    

    public function getUserId() {
        // Use correct session key
        if (!isset($_SESSION['userid'])) {
            die("User not logged in");
        }

        return $_SESSION['userid'];
    }
}