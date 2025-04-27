<?php
class External_customer extends Controller
{
    public function index() {
        $userModel = new User();
        $externalUserModel = new External_User();
        $feedbackModel = new Feedback();

        // Fetch external users
        $query = "SELECT u.userid, u.name, eu.company_name, u.nic, u.email, u.contact_number, u.address
                  FROM user u
                  JOIN external_user eu ON u.userid = eu.userid";
        $external_users = $userModel->query($query);

        // Fetch feedbacks ordered by date ascending (earliest to latest)
        $feedbacks = $feedbackModel->query("SELECT * FROM feedback ORDER BY date ASC");

        // Prepare feedbacks with user info
        $feedbackList = [];
        foreach ($feedbacks as $feedback) {
            $user = $userModel->getUser($feedback->userid)[0] ?? null;
            if ($user) {
                $feedbackList[] = [
                    'content' => $feedback->content,
                    'rating' => $feedback->rating,
                    'date' => $feedback->date,
                    'user_name' => $user->name,
                    'user_image' => !empty($user->image) ? $user->image : 'default.jpg',
                ];
            }
        }

        $messageModel = new Message();
    
        // Get messages with user info using JOIN
        $messageList = $messageModel->getMessagesWithUsers();
        // echo '<pre>';
        // print_r($messageList);
        // echo '</pre>';
        // exit;
        // Pass both external users and feedbacks to the view
        $this->view('ped_incharge/external_customer', [
            'external_users' => $external_users,
            'feedbacks' => $feedbackList,
            'messages' => $messageList        ]);
    }


    public function send_reply() {
        // Check if this is a POST request
        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // Redirect back to the external customers page
            redirect('ped_incharge/external_customer');
            return;
        }
        
        // Get the POST data
        $toUserId = $_POST['toUserId'] ?? null;
        $reply = $_POST['replyMessage'] ?? null;
        $messageId = $_POST['messageId'] ?? null;

        // Debug: Log the received values
        error_log("toUserId: " . ($toUserId ? $toUserId : 'null'));
        error_log("reply: " . ($reply ? $reply : 'null'));
        error_log("POST data: " . print_r($_POST, true));
        
        if(!$toUserId || !$reply) {
            // Set error message in session with more specific information
            $_SESSION['error'] = 'Missing required data: ' . 
                                (!$toUserId ? 'User ID is missing. ' : '') . 
                                (!$reply ? 'Reply message is missing.' : '');
            redirect('ped_incharge/external_customer');
            return;
        }
        
        // Create notification
        $notifications = new Notifications();
        $result = $notifications->sendReplyNotification($toUserId, $reply);
        // Update message read status if messageId is provided
        if($messageId) {
            $messageModel = new Message();
             $updateResult = $messageModel->markAsRead($messageId);
        error_log("Message update result: " . ($updateResult ? 'success' : 'failed'));
    }
        
        if($result) {
            // Set success message in session
            $_SESSION['success'] = 'Reply sent successfully!';
        } else {
            // Set error message in session
            $_SESSION['error'] = 'Failed to send reply';
        }
        
        // Redirect back to the external customers page
        redirect('ped_incharge/external_customer');
    }
    
    

}
