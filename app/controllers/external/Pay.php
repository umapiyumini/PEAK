<?php
class Pay extends Controller {

    use Database; // Use the Database trait to have access to the query and other methods

    public function index() {
        // Show the payment form
        $this->view('external/pay');
    }

    public function submitPayment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get reservation ID and total price from the form
            $reservationId = $_POST['reservationid'];
            $discountedPrice = $_POST['totalprice']; // Not used in DB, just for display
            $paymentProof = $_FILES['paymentproof'];
    
            // Process file upload
            if ($paymentProof['error'] === UPLOAD_ERR_OK) {
                $uploadDir = dirname(__DIR__, 3) . '/uploads/payment_proofs/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
    
                $filename = basename($paymentProof['name']);
                $targetPath = $uploadDir . $filename;
                $relativePath = 'uploads/payment_proofs/' . $filename; // for saving in DB
    
                if (move_uploaded_file($paymentProof['tmp_name'], $targetPath)) {
                    // Insert into the database
                    $userId = $_SESSION['userid']; // make sure user is logged in
    
                    $payment = new Payments();
                    $payment->insert([ // Assuming you have the insert method in Payments model
                        'userid' => $userId,
                        'reservationid' => $reservationId,
                        'payment_proof' => $relativePath,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
    
                    // After inserting the payment, update the reservation status to 'paid'
                    $this->updateReservationStatus($reservationId);
    
                    // Redirect to a success page
                    header('Location: ' . ROOT . '/external/pay?success=1');
                    exit;
                } else {
                    echo "Error: Could not upload the payment proof.";
                }
            } else {
                echo "Error uploading file. Code: " . $paymentProof['error'];
            }
        }
    }

    // Update the reservation status to 'paid'
    private function updateReservationStatus($reservationId) {
        // Update the reservation status in the database
        $query = "UPDATE reservations SET status = 'paid' WHERE reservationid = :reservationid";
        $data = [':reservationid' => $reservationId];
        
        // Use the query method directly from the trait
        $result = $this->query($query, $data); // Using the trait's query method

        if ($result) {
            echo "Reservation status updated to 'paid'.";
        } else {
            echo "Error: Could not update reservation status.";
        }
    }
}
