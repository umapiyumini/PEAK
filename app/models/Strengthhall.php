<?php
class Strengthhall {
    use Model;

    protected $table = 'strengthhall'; 
    protected $fillable = ['subscription', 'price'];


 public function getPriceBySubscription($subscription) {
    $query = "SELECT price FROM $this->table WHERE subscription = :subscription LIMIT 1";
    $params = ['subscription' => $subscription];

   
    $result = $this->query($query, $params);

    return $result ? $result[0]->price : null;
}

    
}