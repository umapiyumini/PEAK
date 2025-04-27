<?php
class Message {
    use Model;
    
    protected $table = 'message';
    protected $fillable = ['userid', 'content', 'date', 'time','isread'];

    public function insert($data) {
        $columns = implode(", ", array_keys($data));
        $values  = ":" . implode(", :", array_keys($data));
    
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($values)";
        
        
        return $this->query($sql, $data);
    }
    
    // Inside the Message model
public function getTable() {
    return $this->table;
}

public function getMessagesWithUsers() {
    $query = "SELECT 
                m.messageid,
                m.content,
                m.date,
                m.time,
                u.userid,
                u.name,
                u.image
              FROM {$this->table} m
              JOIN user u ON m.userid = u.userid
              WHERE m.isread = '0'
              ORDER BY m.date ASC, m.time ASC";

    $messages = $this->query($query);
    
    // Format the results
    return array_map(function($message) {
        return [
            'id' => $message->messageid, // Add this line
            'content' => $message->content,
            'date' => $message->date,
            'time' => $message->time,
            'user_id' => $message->userid,
            'user_name' => $message->name,
            'user_image' => $message->image ?: 'default.jpg'
        ];
    }, $messages);
}


public function markAsRead($messageId) {
    error_log("Attempting to mark message $messageId as read");
    $query = "UPDATE {$this->table} SET isread = '1' WHERE messageid = :messageid";
    return $this->query($query, ['messageid' => $messageId]);
}



    
}
