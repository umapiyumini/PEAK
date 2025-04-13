<?php
class Footballform extends Controller {
    public function index() {
        // This will load the hockey form view
        $this->view('external/footballform');
    }

    public function getPrice() {
        // Assuming form values are coming from a POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $event = $_POST['bookingFor']; // 'practice' or 'tournament'
            $duration = $_POST['duration']; // 'half' or 'full'
            $description = $_POST['description']; // Get the 'court markings' value (Yes or No)
            $courtid = 30; // Hockey court id
   
            // Create an instance of the Groundcourts model
            $groundcourt = new Groundcourts();
   
            // Call the getPriceByDetails function with the form values and court ID
            $price = $groundcourt->getPriceByDetails($event, $duration, $description, $courtid);
   
            // Return the price as JSON so JavaScript can handle it
            echo json_encode(['price' => $price]);
        }
    }
   
}