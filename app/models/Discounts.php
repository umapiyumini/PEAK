<?php

class Discounts {
    use Model;  
    
    protected $table = 'discounts';

    // Method to get discount by user type
    public function getDiscountByUserType($usertype) {
        $query = "SELECT discount FROM {$this->table} WHERE usertype = :usertype LIMIT 1";
        $stmt = $this->query($query, ['usertype' => $usertype]);
    
        if ($stmt && count($stmt) > 0) {
            $discount = (float) $stmt[0]->discount;
            error_log("Fetched discount for usertype {$usertype}: " . $discount); // Debug line
            return $discount;
        }
        return 0;  // If no discount, return 0
    }
    
}
