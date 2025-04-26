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


    //fetching price in form column
    public function getPriceByCourtName($event, $duration, $description, $courtName) {
        // Join courts and groundcourts tables to find the price based on court name
        $query = "SELECT gc.price 
                  FROM $this->table gc
                  JOIN courts c ON gc.courtid = c.courtid
                  WHERE gc.event = :event 
                  AND gc.duration = :duration 
                  AND gc.description = :description 
                  AND c.name = :courtName
                  LIMIT 1";
        
        $params = [
            'event' => $event, 
            'duration' => $duration, 
            'description' => $description, 
            'courtName' => $courtName
        ];
    
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
