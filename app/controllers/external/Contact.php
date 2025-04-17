<?php

class Contact extends Controller {
    public function index() {
        $this->view('external/contact');
    }

    public function sendMessage() {
        // var_dump($_SESSION['userid']);
        // var_dump($_POST['content']);
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get user ID from session
            $userid = $_SESSION['userid'] ?? null;  // Get user ID from session
            $content = $_POST['content'] ?? '';
        
            // Trim content to avoid spaces causing issues
            $content = trim($content);
        
            // Debugging to check if content is correctly trimmed
            // var_dump($content);
        
            if ($userid && !empty($content)) {
                $messageModel = new Message();
                $messageData = [
                    'userid' => $userid,  // Use the session user ID
                    'content' => $content,
                    'date' => date('Y-m-d'), // Current date
                ];
        
                // Construct the SQL query
                $keys = array_keys($messageData);
                $query = "INSERT INTO " . $messageModel->getTable() . " (" . implode(",", $keys) . ") 
                          VALUES (:" . implode(",:", $keys) . ")";
        
                // Execute the query using the custom executeQuery method
                if ($messageModel->executeQuery($query, $messageData)) {
                    // Set success message in session
                    $_SESSION['success_message'] = "Message sent successfully!";
                } else {
                    // Set error message in session
                    $_SESSION['error_message'] = "Failed to send message.";
                }
            } else {
                // If user ID or content is missing
                $_SESSION['error_message'] = "User ID and message content are required.";
            }
        
            // Redirect to the contact page (refreshes the page)
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit; // Stop further execution
        } else {
            echo "Invalid request.";
        }
    }
    


    // Feedback submission method
    public function sendFeedback() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Debugging: Check if POST data is received
            var_dump($_POST);
            
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
    
                $keys = array_keys($feedbackData);
                $query = "INSERT INTO " . $feedbackModel->getTable() . " (" . implode(",", $keys) . ") 
                          VALUES (:" . implode(",:", $keys) . ")";
    
                if ($feedbackModel->executeQuery($query, $feedbackData)) {
                    $_SESSION['success_message'] = "Feedback submitted successfully!";
                } else {
                    $_SESSION['error_message'] = "Failed to submit feedback.";
                }
            } else {
                $_SESSION['error_message'] = "User ID, feedback content, and rating are required.";
            }
    
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            echo "Invalid request.";
        }
    }
    
}

