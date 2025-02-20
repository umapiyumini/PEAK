<?php

class Contact extends Controller {
    public function index() {
        $this->view('external/contact');
    }

    public function sendMessage() {
        var_dump($_SESSION['userid']);
        var_dump($_POST['content']);
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get user ID from session
            $userid = $_SESSION['userid'] ?? null;  // Get user ID from session
            $content = $_POST['content'] ?? '';
    
            // Trim content to avoid spaces causing issues
            $content = trim($content);
    
            // Debugging to check if content is correctly trimmed
            var_dump($content);
    
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
                    echo "Message sent successfully!";
                } else {
                    echo "Failed to send message.";
                }
            } else {
                // Debugging - if content is empty or user ID is missing
                var_dump($userid);
                echo "User ID and message content are required.";
            }
        } else {
            echo "Invalid request.";
        }
    }
    
    
}
