<?php

class Contact extends Controller {
    public function index() {
        $this->view('external/contact');
    }

    public function sendMessage() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $userid = $_SESSION['userid'] ?? null; 
            $content = $_POST['content'] ?? '';
    
            
            $content = trim($content);
    
            if ($userid && !empty($content)) {
                $messageModel = new Message();
                $messageData = [
                    'userid' => $userid,  
                    'content' => $content,
                    'date' => date('Y-m-d'), 
                ];
    
        
                if ($messageModel->insert($messageData)) {
                    $_SESSION['success_message'] = true; 
                } else {
                    $_SESSION['error_message'] = "Failed to send message.";
                }
            } else {
            
                $_SESSION['error_message'] = "User ID and message content are required.";
            }
    
            
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            echo "Invalid request.";
        }
    }
    


    public function sendFeedback() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            
            $userid = $_SESSION['userid'] ?? null;
            $content = $_POST['content'] ?? '';
            $rating = $_POST['rating'] ?? 0;
    
            $content = trim($content);
        
            if ($userid && !empty($content) && $rating > 0) {
                $feedbackModel = new Feedback();
                $feedbackData = [
                    'userid' => $userid,
                    'content' => $content,
                    'rating' => $rating,
                    'date' => date('Y-m-d'),
                    'time' => date('H:i:s'),
                ];
    
                
                   if ($feedbackModel->insert($feedbackData)) {
                    $_SESSION['success_message'] = "Message sent successfully!";
                } else {
                    $_SESSION['error_message'] = "Failed to send message.";
                }
            } else {
    
                $_SESSION['error_message'] = "User ID and message content are required.";
            }
    
        
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit; 
        } else {
            echo "Invalid request.";
        }
    }
    
    
    
}

