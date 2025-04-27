<?php

class Notifications {
    use Model;
    protected $table = 'notifications';
    protected $fillable = ['notificationid', 'title', 'content', 'to_user_id','	to_role', 'from_user_id','time','date','created_at','expiry_date'];

    public function sendRescheduleNotification($userId, $newDate) {
        $userModel = new User();
        $user = $userModel->getUser($userId);
        
        // Check if user exists and access the first element of the array
        $userName = $user && isset($user[0]) ? $user[0]->name : "A user";
        
        $expiryDate = date('Y-m-d', strtotime('+2 weeks'));
        
        return $this->insert([
            'title' => 'Booking was rescheduled',
            'content' => $userName . ' has rescheduled a booking to the new date ' . $newDate,
            'to_user_id' => 30, // PED incharge ID
            'to_role' => 'admin',
            'from_user_id' => $userId,
            'time' => date('H:i:s'),
            'date' => date('Y-m-d'),
            'created_at' => date('Y-m-d H:i:s'),
            'expiry_date' => $expiryDate
        ]);
    }


    public function sendCancelNotification($userId, $reservationDetails) {
        // Get user information
        $userModel = new User();
        $user = $userModel->getUser($userId);
        $userName = isset($user[0]) ? $user[0]->name : "A user";
        
        // Calculate expiry date (2 weeks from now)
        $expiryDate = date('Y-m-d', strtotime('+2 weeks'));
        
        // Format the cancellation date for display
        $cancellationDate = date('Y-m-d');
        
        // Create notification content
        $content = $userName . ' has cancelled a booking ';
        
        // Insert notification
        return $this->insert([
            'title' => 'Booking Cancellation',
            'content' => $content,
            'to_user_id' => 29, // PED incharge ID
            'to_role' => 'admin',
            'from_user_id' => $userId,
            'time' => date('H:i:s'),
            'date' => $cancellationDate,
            'created_at' => date('Y-m-d H:i:s'),
            'expiry_date' => $expiryDate
        ]);
    }

    public function getActiveUnreadNotifications($userId) {
        $currentDate = date('Y-m-d'); // Today's date
        
        $query = "SELECT * FROM {$this->table} 
                  WHERE to_user_id = :userid 
                  AND expiry_date >= :currentDate
                  ORDER BY created_at DESC";
        
        return $this->query($query, [
            'userid' => $userId,
            'currentDate' => $currentDate
        ]);
    }


    public function sendReplyNotification($toUserId, $replyContent) {
        // Get the current user ID from the session
        $fromUserId = $_SESSION['userid'] ?? 0;
        // Calculate expiry date (1 week from now)
        $expiryDate = date('Y-m-d', strtotime('+1 week'));
        
        // Insert notification
        return $this->insert([
            'title' => 'PED incharge replied to your message',
            'content' => $replyContent,
            'to_user_id' => $toUserId,
            'to_role' => 'external_user',
            'from_user_id' => $fromUserId,
            'time' => date('H:i:s'),
            'date' => date('Y-m-d'),
            'created_at' => date('Y-m-d H:i:s'),
            'expiry_date' => $expiryDate
        ]);
    }
    
    
    
    
}
