<?php 
class Subscriptionpayments {
    use Model; 

    protected $table = 'subscriptionpayments';  
    protected $fillable = ['paymentid', 'userid', 'subscriptionid', 'payment_date', 'paymentproof'];
    protected $allowed_columns = ['userid', 'subscriptionid', 'paymentproof', 'payment_date'];

    public function insert($data) {
        
        if (!empty($this->allowed_columns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowed_columns)) {
                    unset($data[$key]);
                }
            }
        }

        
        $keys = array_keys($data);
        $query = "INSERT INTO $this->table (" . implode(",", $keys) . ") VALUES (:" . implode(",:", $keys) . ")";
        
      
        return $this->query($query, $data); 
    }
   
    
}
