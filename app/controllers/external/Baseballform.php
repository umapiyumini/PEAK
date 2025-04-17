<?php
class Baseballform extends Controller {
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservation = new Reservations();

            // Handle file uploads (optional validation can be added)
            $proofPath = $this->uploadFile($_FILES['proof']);
            $paymentProofPath = $this->uploadFile($_FILES['paymentProof']);

            // Build data array
            $data = [
                'userid' => $_SESSION['USER']->userid ?? 1, // Example fallback
                'courtid' => 39, // Assuming courtid for baseball court is 39
                'event' => $_POST['bookingFor'],
                'date' => $_POST['date'],
                'time' => $_POST['duration'] === 'halfDay' ? $_POST['timeSlot'] : $_POST['duration'], // ← this is the only line modified
                'status' => 'pending',
                'usertype' => $_POST['userType'],
                'userdescription' => $_POST['extraDetails'],
                'userproof' => $proofPath,
                'numberof_participants' => $_POST['participants'],
                'extradetails' => $_POST['extraDetails'],
                'price' => $_POST['price'],
                'discountedprice' => $_POST['discountedPrice'],
                'occupied' => 1
            ];

            $reservation->insert($data);
            redirect('reservations'); // You can change where it goes next
        }

        $this->view('external/baseballform');
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

// Assuming your controller is handling this




}