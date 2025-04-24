<?php

class Groundcourts {
    use Model;
    
    protected $table = 'groundcourts';
    protected $fillable = ['courtid', 'event', 'duration', 'description', 'price']; // Include rating here

    public function getTable() {
        return $this->table;
    }


    //used
    public function getAllGroundRates() {
        $query = "SELECT * FROM $this->table ORDER BY description, event, duration";
        return $this->query($query);
    }


    public function getPriceByDetails($event, $duration, $description, $courtid) {
        // Adjust the query to include courtid
        $query = "SELECT price FROM $this->table WHERE event = :event AND duration = :duration AND description = :description AND courtid = :courtid LIMIT 1";
        
        // Add courtid to the parameters array
        $params = [
            'event' => $event, 
            'duration' => $duration, 
            'description' => $description, 
            'courtid' => $courtid
        ];
    
        // Assuming query() works as it did before (handles parameterized queries)
        $result = $this->query($query, $params);
    
        return $result ? $result[0]->price : null;
    }
    


    //not yet
    
    
public function getPriceByEventDurationDescription($event, $duration, $description) {
    // Query the database to get the base price based on event, duration, and description
    // For example:
    $query = "SELECT price FROM prices WHERE event = :event AND duration = :duration AND description = :description LIMIT 1";
    $stmt = $this->query($query, [
        'event' => $event,
        'duration' => $duration,
        'description' => $description
    ]);

    if ($stmt && count($stmt) > 0) {
        return (float) $stmt[0]->price;  // Return the price as float
    }

    return false;  // If no price is found, return false
}


public function getByKeys($courtid, $event, $duration, $description) {
    $query = "SELECT * FROM $this->table WHERE courtid = :courtid AND event = :event AND duration = :duration AND description = :description LIMIT 1";
    $params = [
        'courtid' => $courtid,
        'event' => $event,
        'duration' => $duration,
        'description' => $description
    ];
    $result = $this->query($query, $params);
    return $result ? $result[0] : null;
}

public function updatePrice($courtid, $event, $duration, $description, $price) {
    $query = "UPDATE $this->table SET price = :price WHERE courtid = :courtid AND event = :event AND duration = :duration AND description = :description";
    $params = [
        'price' => $price,
        'courtid' => $courtid,
        'event' => $event,
        'duration' => $duration,
        'description' => $description,
    ];
    return $this->query($query, $params);
}





}
