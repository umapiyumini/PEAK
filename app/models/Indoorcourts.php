<?php

class Indoorcourts {
    use Model;
    
    protected $table = 'indoorcourts';
    protected $fillable = ['courtid', 'event', 'duration',  'price']; // Include rating here

    public function getTable() {
        return $this->table;
    }

    
    public function getPriceByDetails($event, $duration, $courtid) {
        // Adjust the query to include courtid
        $query = "SELECT price FROM $this->table WHERE event = :event AND duration = :duration  AND courtid = :courtid LIMIT 1";
        
        // Add courtid to the parameters array
        $params = [
            'event' => $event, 
            'duration' => $duration, 
            
            'courtid' => $courtid
        ];
    
        // Assuming query() works as it did before (handles parameterized queries)
        $result = $this->query($query, $params);
    
        return $result ? $result[0]->price : null;
    }
    
public function getPriceByEventDurationDescription($event, $duration) {
    // Query the database to get the base price based on event, duration, and description
    // For example:
    $query = "SELECT price FROM prices WHERE event = :event AND duration = :duration  LIMIT 1";
    $stmt = $this->query($query, [
        'event' => $event,
        'duration' => $duration,
        
    ]);

    if ($stmt && count($stmt) > 0) {
        return (float) $stmt[0]->price;  // Return the price as float
    }

    return false;  // If no price is found, return false
}


}
