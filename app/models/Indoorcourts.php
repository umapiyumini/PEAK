<?php

class Indoorcourts {
    use Model;
    
    protected $table = 'indoorcourts';
    protected $fillable = ['courtid', 'event', 'duration',  'price']; 

    public function getTable() {
        return $this->table;
    }

    public function getAllIndoorRates() {
        $query = "SELECT * FROM $this->table ";
        return $this->query($query);
    }


    public function getPriceByDetails($event, $duration, $courtid) {
      
        $query = "SELECT price FROM $this->table WHERE event = :event AND duration = :duration  AND courtid = :courtid LIMIT 1";
        
    
        $params = [
            'event' => $event, 
            'duration' => $duration, 
            
            'courtid' => $courtid
        ];
    
        
        $result = $this->query($query, $params);
    
        return $result ? $result[0]->price : null;
    }
    
public function getPriceByEventDurationDescription($event, $duration) {
   
    $query = "SELECT price FROM prices WHERE event = :event AND duration = :duration  LIMIT 1";
    $stmt = $this->query($query, [
        'event' => $event,
        'duration' => $duration,
        
    ]);

    if ($stmt && count($stmt) > 0) {
        return (float) $stmt[0]->price;  
    }

    return false;  
}

public function updatePrice($courtid, $event, $duration, $price) {
    $query = "UPDATE $this->table SET price = :price WHERE courtid = :courtid AND event = :event AND duration = :duration ";
    $params = [
        'price' => $price,
        'courtid' => $courtid,
        'event' => $event,
        'duration' => $duration,
       
    ];
    return $this->query($query, $params);
}



 
 public function getPriceByCourtName($event, $duration, $courtName) {
    
    $query = "SELECT ic.price 
              FROM $this->table ic
              JOIN courts c ON ic.courtid = c.courtid
              WHERE ic.event = :event 
              AND ic.duration = :duration 
              AND c.name = :courtName
              LIMIT 1";
    
    $params = [
        'event' => $event, 
        'duration' => $duration, 
        'courtName' => $courtName
    ];

    $result = $this->query($query, $params);
    
    return $result ? $result[0]->price : null;
}

}
