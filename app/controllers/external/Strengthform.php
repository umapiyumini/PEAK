<?php
// Your existing code follows below:
class Strengthform extends Controller {

    // public function index() {
    //     $this->view('external/strengthform');
    // }

    public function index() {
        $subscriptions = $this->getOngoingSubscriptions();
        $this->view('external/strengthform', ['subscriptions' => $subscriptions]);
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

    
    public function getUserId() {
        // Use correct session key
        if (!isset($_SESSION['userid'])) {
            die("User not logged in");
        }

        return $_SESSION['userid'];
    }




    public function submitReservation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subscription = isset($_POST['subscription']) ? $_POST['subscription'] : '';
            $price = isset($_POST['price']) ? $_POST['price'] : '';
            $userid = $this->getUserId();
    
            if ($subscription && $userid) {
                $subscriptionModel = new Subscription();
    
                // 🔍 Check if the user is allowed to make a reservation
                // $check = $subscriptionModel->isWithinTwoWeeksOfExpiry($userid);
    
                // if (!$check['allowed']) {
                //     echo $check['message']; // ❌ Not allowed: send back a message
                //     return;
                // }
    
                // ✅ Allowed to make reservation
                $data = [
                    'userid' => $userid,
                    'subscription' => $subscription,
                    'paymentproof' => null,
                    'status' => 'pending',
                    'date_of_payment' => null,
                ];
    
                $subscriptionModel->insert($data);
                echo "Reservation successfully made. Awaiting payment.";
            } else {
                echo "Failed to make reservation. Missing required data.";
            }
        }
    }
    

   // Controller Method to handle the Strength Form page
public function showStrengthForm() {
    // Fetch the ongoing subscriptions for the logged-in user
    $subscriptions = $this->getOngoingSubscriptions();

    // Pass the subscriptions data to the view
    $this->view('external/strengthform', ['subscriptions' => $subscriptions]);
}

public function getOngoingSubscriptions() {
    $userId = $this->getUserId();  // still fine

    $subscriptionModel = new Subscription();
    return $subscriptionModel->getOngoingByUserId($userId);
}


public function checkSubscriptionStatus() {
    $userId = $_POST['userId'] ?? '';
    $subscriptionType = $_POST['subscriptionType'] ?? '';

    if (!$userId || !$subscriptionType) {
        echo json_encode([
            'status' => 'failed',
            'canPay' => false,
            'message' => 'Failed to get user or subscription details.'
        ]);
        exit;
    }

    $subscriptionModel = new Subscription();
    $subscriptions = $subscriptionModel->getSubscriptionEndDateByUser($userId);

    if (!$subscriptions || empty($subscriptions[0])) {
        echo json_encode([
            'status' => 'failed',
            'canPay' => false,
            'message' => 'No active subscription found for the user.'
        ]);
        exit;
    }

    $subscription = $subscriptions[0];
    $endDate = new DateTime($subscription->subscription_end_date);
    $now = new DateTime();

    // Calculate days remaining or past expiry
    $interval = $now->diff($endDate);
    $daysLeft = (int) $interval->format('%r%a'); // +ve if in future, -ve if expired

    if ($subscription->status === 'active') {
        if ($daysLeft <= 14 && $daysLeft >= 0) {
            echo json_encode([
                'status' => 'active',
                'canPay' => true,
                'message' => "Your subscription is active, but will expire in $daysLeft days. You can pay now."
            ]);
        } else {
            echo json_encode([
                'status' => 'active',
                'canPay' => false,
                'message' => "You already have an active subscription. No need to pay again."
            ]);
        }
    } else {
        if ($daysLeft < 0) {
            echo json_encode([
                'status' => 'expired',
                'canPay' => true,
                'message' => "Your subscription has expired. Please renew to proceed."
            ]);
        } else if ($daysLeft <= 14) {
            echo json_encode([
                'status' => 'expiring',
                'canPay' => true,
                'message' => "Your subscription is expiring in $daysLeft days. You can proceed with the reservation."
            ]);
        } else {
            echo json_encode([
                'status' => 'valid',
                'canPay' => true,
                'message' => "Your subscription is valid. You can proceed."
            ]);
        }
    }

    exit;
}

}


