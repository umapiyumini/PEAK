<?php
 if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Baseballform extends Controller {
   
    

   // Display the baseball form
   public function index() {
    $this->view('external/baseballform');
}

// Handle the booking logic (form submission)
// Handle the booking logic (form submission)
public function book() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $reservation = new Reservations();
        $discountModel = new Discounts();

        // Handle file uploads
        $proofPath = isset($_FILES['proof']) && $_FILES['proof']['error'] === UPLOAD_ERR_OK
            ? $this->uploadFile($_FILES['proof'])
            : null;

        $paymentProofPath = isset($_FILES['paymentProof']) && $_FILES['paymentProof']['error'] === UPLOAD_ERR_OK
            ? $this->uploadFile($_FILES['paymentProof'])
            : null;

        // Get the user ID from the session
        $userid = $_SESSION['userid'] ?? null;
        if (!$userid) {
            $_SESSION['error'] = "User not logged in or session data is missing.";
            redirect('login');
            return;
        }

        // Fixed baseball court ID
        $courtid = 24; 

        // Get POST data
        $event = $_POST['bookingFor'] ?? '';
        $duration = ($_POST['duration'] === 'halfDay') ? ($_POST['timeSlot'] ?? '') : $_POST['duration'];
        $description = !empty($_POST['extraDetails']) ? $_POST['extraDetails'] : 'no';
        $basePrice = $_POST['price'] ?? 0;

        // Validate price
        if ($basePrice == 0) {
            $_SESSION['error'] = "Price not found for the selected combination.";
            redirect('external/baseballform');
            return;
        }

        // Fetch discount based on user type
        $userType = $_POST['userType'] ?? '';
        $discountPercentage = $discountModel->getDiscountByUserType($userType);
        $discountedPrice = $basePrice - ($basePrice * ($discountPercentage / 100));

        // Prepare the data for insertion
        $data = [
            'userid' => $userid,
            'courtid' => $courtid,
            'section' => $_POST['section'] ?? 'A', // Or whatever default
            'event' => $event,
            'duration' => $_POST['duration'] ?? '',
            'date' => $_POST['date'] ?? '',
            'time' => $duration,
            'status' => 'pending',
            'usertype' => $userType,
            'userdescription' => $description,
            'userproof' => $proofPath,
            'numberof_participants' => $_POST['participants'] ?? 0,
            'extradetails' => $_POST['extraDetails'] ?? '',
            'price' => $basePrice,
            'discountedprice' => $discountedPrice,
            'occupied' => 0,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        

      
        error_log("Reached here!");  // This log will confirm if the code is running till this point.
        error_log("Data to be inserted: " . print_r($data, true));  // The original log you want to check.
        
if ($reservation->insert($data)) {
    $_SESSION['success'] = "Baseball court booked successfully.";
} else {
    $_SESSION['error'] = "Failed to book the court. Please try again.";
}

// Log after the insert call
error_log("Insert method executed.");

        // Redirect to the form after processing
        redirect('external/baseballform');
    } else {
        // If it's not a POST request, simply display the form
        $this->view('external/baseballform');
    }
}

    
    private function uploadFile($file) {
        $targetDir = "uploads/";
        $filename = time() . '_' . basename($file['name']);
        $targetFilePath = $targetDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            return $targetFilePath;
        }

        return null;
    }

    public function getPrice() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Capture the POST data
            $event = $_POST['event'];
            $duration = $_POST['duration'];
            $description = $_POST['description'];
    
            // Log the received values
            error_log("Received event: $event, duration: $duration, description: $description");
    
            // Now you will continue the logic of fetching the price
            // Fetch the price from the database
            $groundcourt = new Groundcourts();
            $price = $groundcourt->getPriceByDetails($event, $duration, $description);


            // Log the fetched price
            error_log("Fetched price: " . $price);
    
            if ($price !== null) {
                echo $price; // Send the price as the response
            } else {
                echo "Price not available"; // If no price found, send this message
            }
        }
    }

     


          


    
    


// Sample modified code in the checkAvailability method
public function checkAvailability() {
    // Capture the POST data
    $date = $_POST['date'];
    $section = $_POST['section'];


    // Create an instance of the Reservations model
    $reservationsModel = new Reservations();

    // Check availability for the selected date and section
    $reservations = $reservationsModel->checkExistingReservations($date, $section);

    // Handle the response
    if ($reservations !== null) {
        // Handle full day bookings
        if ($reservations['fullDayCount'] > 0) {
            echo json_encode([
                'fullDayCount' => 1,
                'halfDayCount' => 0,
                'bookedHalfSlot' => ''
            ]);
        } 
        // Handle half day bookings
        else if ($reservations['halfDayCount'] > 0) {
            // Assuming that the time slot for the half-day booking is available
            echo json_encode([
                'fullDayCount' => 0,
                'halfDayCount' => 1,
                'bookedHalfSlot' => $reservations['bookedHalfSlot']
            ]);
        } else {
            echo json_encode([
                'fullDayCount' => 0,
                'halfDayCount' => 0,
                'bookedHalfSlot' => ''
            ]);
        }
    } else {
        // In case there is an issue fetching data
        error_log("Error checking availability for date: $date, section: $section");
        echo json_encode(['error' => 'Something went wrong while checking availability']);
    }
}


public function getDiscountedPrice() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get POST data
        $event = $_POST['event'] ?? null;
        $duration = $_POST['duration'] ?? null;
        $description = $_POST['description'] ?? null;
        $usertype = $_POST['usertype'] ?? null;
        $basePrice = $_POST['basePrice'] ?? null; // Get the price from the frontend input

        if ($event && $duration && $description && $usertype && $basePrice) {
            // Fetch the discount for the usertype
            $discountModel = new Discounts();
            $discount = $discountModel->getDiscountByUserType($usertype);

            // Apply the discount (if any)
            
$discountedPrice = $basePrice * (1 - $discount);  // Multiply base price by (1 - discount)

            // Send the discounted price as response
            echo json_encode(['discountedPrice' => $discountedPrice]);
        } else {
            echo json_encode(['error' => 'Invalid input.']);
        }
    }
}








}