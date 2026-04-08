<?php

class Groundcourts {
    use Model;
    
    protected $table = 'groundcourts';
    protected $fillable = ['courtid', 'event', 'duration', 'description', 'price']; 

    public function getTable() {
        return $this->table;
    }


    
    public function getAllGroundRates() {
        $query = "SELECT * FROM $this->table ORDER BY description, event, duration";
        return $this->query($query);
    }



    public function getPriceByCourtName($event, $duration, $description, $courtName) {
    
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
    





    
    
    
    
public function getPriceByEventDurationDescription($event, $duration, $description) {
    
    $query = "SELECT price FROM prices WHERE event = :event AND duration = :duration AND description = :description LIMIT 1";
    $stmt = $this->query($query, [
        'event' => $event,
        'duration' => $duration,
        'description' => $description
    ]);

    if ($stmt && count($stmt) > 0) {
        return (float) $stmt[0]->price; 
    }

    return false;  
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
