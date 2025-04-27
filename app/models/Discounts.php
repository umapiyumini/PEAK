<?php

class Discounts {
    use Model;  
    
    protected $table = 'discounts';

    
    public function getDiscountByUserType($usertype) {
        $query = "SELECT discount FROM {$this->table} WHERE usertype = :usertype LIMIT 1";
        $stmt = $this->query($query, ['usertype' => $usertype]);
    
        if ($stmt && count($stmt) > 0) {
            $discount = (float) $stmt[0]->discount;
            error_log("Fetched discount for usertype {$usertype}: " . $discount); 
            return $discount;
        }
        return 0;  
    }
    
}
