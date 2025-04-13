<?php
class Volleyballform extends Controller {
    public function index() {
        // This will load the hockey form view
        $this->view('external/volleyballform');
    }

    public function getPrice() {
        // Assuming form values are coming from a POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $event = $_POST['bookingFor']; // 'practice' or 'tournament'
            $duration = $_POST['duration']; // 'half' or 'full'
            $description ="no"; // Get the 'court markings' value (Yes or No)
            $courtid = 34; // Hockey court id
   
            // Create an instance of the Groundcourts model
            $groundcourt = new Groundcourts();
   
            // Call the getPriceByDetails function with the form values and court ID
            $price = $groundcourt->getPriceByDetails($event, $duration, $description, $courtid);
   
            // Return the price as JSON so JavaScript can handle it
            echo json_encode(['price' => $price]);
        }
    }
   
    public function getDiscountedPrice() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usertype = $_POST['userType'];
            $price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
    
            $discountModel = new Discounts();
            $discount = $discountModel->getDiscountByUserType($usertype);
    
            $discountedPrice = $price - ($price * $discount);
    
            echo json_encode([
                'discount' => $discount,
                'discountedPrice' => round($discountedPrice, 2)
            ]);
        }
    }
    
}