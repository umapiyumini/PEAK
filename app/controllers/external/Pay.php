<?php
class Pay extends Controller {

    use Database; 

    public function index() {
        
        $this->view('external/pay');
    }

    public function submitPayment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          
            $reservationId = $_POST['reservationid'];
            $discountedPrice = $_POST['totalprice']; 
            $paymentProof = $_FILES['paymentproof'];
    
           
            if ($paymentProof['error'] === UPLOAD_ERR_OK) {
                $uploadDir = dirname(__DIR__, 3) . '/uploads/payment_proofs/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
    
                $filename = basename($paymentProof['name']);
                $targetPath = $uploadDir . $filename;
                $relativePath = 'uploads/payment_proofs/' . $filename;//db
    
                if (move_uploaded_file($paymentProof['tmp_name'], $targetPath)) {
                    // Insert into the database
                    $userId = $_SESSION['userid']; 
    
                    $payment = new Payments();
                    $payment->insert([ 
                        'userid' => $userId,
                        'reservationid' => $reservationId,
                        'payment_proof' => $relativePath,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
    
                    
                   $result= $this->updateReservationStatus($reservationId);
    
                    if ($result) {
                        if (session_status() === PHP_SESSION_NONE) session_start();
                        $_SESSION['payment_success'] = true;
                        header('Location: ' . ROOT . '/external/pay');
                        exit;
                    }
                    
                } else {
                    if (session_status() === PHP_SESSION_NONE) session_start();
                    $_SESSION['payment_success'] = true;
                    header('Location: ' . ROOT . '/external/pay');
                    exit;
                }
            } else {
                echo "Error uploading file. Code: " . $paymentProof['error'];
            }
        }
    }

  
    private function updateReservationStatus($reservationId) {
      
        $query = "UPDATE reservations SET status = 'paid' WHERE reservationid = :reservationid";
        $data = [':reservationid' => $reservationId];
        
     
        $result = $this->query($query, $data); 

        if ($result) {
            header('Location: ' . ROOT . '/external/reservation');
        } else {
            if (session_status() === PHP_SESSION_NONE) session_start();
                    $_SESSION['payment_success'] = true;
                    header('Location: ' . ROOT . '/external/pay');
                    exit;
        }
    }
}
