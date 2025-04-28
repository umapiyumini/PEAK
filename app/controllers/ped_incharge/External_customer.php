<?php
class External_customer extends Controller
{
    public function index() {
        $userModel = new User();
        $externalUserModel = new External_User();
        $feedbackModel = new Feedback();

       
        $query = "SELECT u.userid, u.name, eu.company_name, u.nic, u.email, u.contact_number, u.address
                  FROM user u
                  JOIN external_user eu ON u.userid = eu.userid";
        $external_users = $userModel->query($query);

       
        $feedbacks = $feedbackModel->query("SELECT * FROM feedback ORDER BY date ASC");

       
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
    
        
        $messageList = $messageModel->getMessagesWithUsers();
      
        $this->view('ped_incharge/external_customer', [
            'external_users' => $external_users,
            'feedbacks' => $feedbackList,
            'messages' => $messageList        ]);
    }


    public function send_reply() {
       
        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            
            redirect('ped_incharge/external_customer');
            return;
        }
        
     
        $toUserId = $_POST['toUserId'] ?? null;
        $reply = $_POST['replyMessage'] ?? null;
        $messageId = $_POST['messageId'] ?? null;

        
        error_log("toUserId: " . ($toUserId ? $toUserId : 'null'));
        error_log("reply: " . ($reply ? $reply : 'null'));
        error_log("POST data: " . print_r($_POST, true));
        
        if(!$toUserId || !$reply) {
            
            $_SESSION['error'] = 'Missing required data: ' . 
                                (!$toUserId ? 'User ID is missing. ' : '') . 
                                (!$reply ? 'Reply message is missing.' : '');
            redirect('ped_incharge/external_customer');
            return;
        }
        
       
        $notifications = new Notifications();
        $result = $notifications->sendReplyNotification($toUserId, $reply);
        
        if($messageId) {
            $messageModel = new Message();
             $updateResult = $messageModel->markAsRead($messageId);
        error_log("Message update result: " . ($updateResult ? 'success' : 'failed'));
    }
        
        if($result) {
           
            $_SESSION['success'] = 'Reply sent successfully!';
        } else {
            
            $_SESSION['error'] = 'Failed to send reply';
        }
        
        
        redirect('ped_incharge/external_customer');
    }
    
    

}
