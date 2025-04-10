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

        // Step 1: Ensure the user is logged in and has a valid user ID
        $userId = $this->getUserId(); // Uses updated session key 'userid'

        // Step 2: Prepare data for insertion into the database
        $data = [
            'userid' => $userId,
            'courtid' => 38, // Fixed court ID
            'price' => $_POST['price'] ?? 0,
            'discountedprice' => $_POST['price'] ?? 0,
            'status' => 'pending',
            'occupied' => 0,
        ];

        // Insert reservation
        $reservation = new Reservations();
        $reservation->insert($data);

        // Redirect after booking (optional)
        header("Location: " . ROOT . "/external/externalhome");
        exit;
    }

    public function getUserId() {
        // Use correct session key
        if (!isset($_SESSION['userid'])) {
            die("User not logged in");
        }

        return $_SESSION['userid'];
    }
}