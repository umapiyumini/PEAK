<?php
class Strengthhall {
    use Model;

    protected $table = 'strengthhall'; // Ensure this is the correct table name
    protected $fillable = ['subscription', 'price'];

 // Custom method to fetch price by subscription
 public function getPriceBySubscription($subscription) {
    $query = "SELECT price FROM $this->table WHERE subscription = :subscription LIMIT 1";
    $params = ['subscription' => $subscription];

    // Assuming query() works as it did before (handles parameterized queries)
    $result = $this->query($query, $params);

    return $result ? $result[0]->price : null;
}

    
}