<?php

class Subscriptionpay extends Controller {
    public function index() {
      // Check if session is already started, if not, start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

        $this->view('external/subscriptionpay');
    }

public function show($subscriptionid, $subscriptionName) {
    // Load the Subscription model
    $subscriptionModel = new Subscription();

    // Create the $data array for conditions (where subscriptionid = :subscriptionid)
    $data = ['subscriptionid' => $subscriptionid];

    // Create an empty $data_not array since you don't need "!=" conditions in this case
    $data_not = [];

    // Fetch subscription details using the where condition
    $subscriptions = $subscriptionModel->where($data, $data_not);

    // Check if there's a result and pass the first one (assuming the array is not empty)
    $subscription = $subscriptions ? $subscriptions[0] : null;

    // Pass the subscription and name to the view
    $this->view('external/subscriptionpay', [
        'subscription' => $subscription,
        'subscriptionName' => $subscriptionName
    ]);
}

private function handleFileUpload() {
    if (isset($_FILES['paymentproof']) && $_FILES['paymentproof']['error'] == 0) {
        $fileTmp = $_FILES['paymentproof']['tmp_name'];
        $fileName = basename($_FILES['paymentproof']['name']);
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if ($fileExt !== 'pdf') {
            echo "❌ Only PDF files are allowed.";
            return false;
        }

        // Absolute path on your computer
        $uploadDir = "C:/xampp1/htdocs/PEAK/uploads/payment_proofs/";

        // Relative path to store in database
        $relativePath = "uploads/payment_proofs/";

        // Create folder if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $newFileName = uniqid("proof_", true) . ".pdf";
        $fullPath = $uploadDir . $newFileName;         // For moving the file
        $dbPath = $relativePath . $newFileName;        // For storing in DB

        if (!move_uploaded_file($fileTmp, $fullPath)) {
            echo "❌ Failed to upload file.";
            return false;
        }

        return $dbPath; // Return relative path for database storage
    } else {
        echo "❌ No file uploaded or error occurred.";
        return false;
    }
}

public function submitPayment() {
  
   
        // Your existing code...
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if the session is started and session is active
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Ensure user is logged in
        $userId = $_SESSION['userid'] ?? null;
        if (!$userId) {
            echo "❌ User not logged in.";
            return;
        }

        // Get payment details
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
                // Create an instance of Subscriptionpayment and insert into DB
                $paymentModel = new Subscriptionpayments();
                $subscriptionId = $_POST['subscriptionid'] ?? null;

                $insertData = [
                    'userid' => $userId,
                    'subscriptionid' => $subscriptionId,
                    'paymentproof' => $relativePath,
                    'payment_date' => date('Y-m-d H:i:s')
                ];

             
                // Insert data and check success
                $insertSuccess = $paymentModel->insert($insertData);
                
                if ($insertSuccess) {
                    // If insertion is successful, redirect the user to the success page
                    header("Location: " . ROOT . "/external/strengthform");
                    exit; // Make sure to call exit after header redirection
                    
                } else {
                    // If insertion fails, show the failure message
                    // If insertion is successful, redirect the user to the success page
                    $subscriptionModel = new Subscription(); // Assuming the subscription model is available
                    $updateSuccess = $subscriptionModel->updateSubscriptionStatus($subscriptionId, $insertData['payment_date']);
        
                    if ($updateSuccess) {
                        echo "Payment and subscription status successfully updated.";
                        header("Location: " . ROOT . "/external/strengthform");
                        exit;
                    } else {
                        echo "Payment and subscription status successfully updated.";
                        header("Location: " . ROOT . "/external/strengthform");
                        exit;
                    }
                }
                }
            } else {
                echo "❌ Error: Could not upload the payment proof.";
            }
        } else {
            echo "❌ Error uploading file. Code: " . $paymentProof['error'];
        }
    }
}




