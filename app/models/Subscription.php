<?php
class Subscription {
    use Model;

    protected $table = 'subscription'; // Ensure this is the correct table name
    protected $fillable = ['subscriptionid','userid','subscription','status','date_of_payment','subscription_end_date'];
   
    public function insert($data){
        //remove unwanted data
        if(!empty($this->allowed_columns)){
           foreach($data as $key => $value){
               if(!in_array($key,$this->allowed_columns)){
                   unset($data[$key]);
               }
           }
       }
       
       $keys = array_keys($data);
       $query = "INSERT INTO $this->table (".implode(",",$keys).") VALUES (:".implode(",:",$keys).") ";
       $this->query($query, $data);
       return false;
   }
    

    

   // Method to get the subscription end date for a user
//    public function getSubscriptionEndDateByUser($userId) {
//     $query = "SELECT subscription_end_date FROM $this->table WHERE userid = :userid ORDER BY subscription_end_date DESC LIMIT 1";
//     $result = $this->query($query, ['userid' => $userId]);
    
//     if (isset($result[0]['subscription_end_date'])) {
//         return $result[0]['subscription_end_date'];  // Return the latest subscription end date
//     } else {
//         return null;  // No subscription found for the user
//     }
// }


public function getSubscriptionEndDateByUser($userid) {
    $userid = intval($userid); 
    return $this->query("SELECT * FROM subscription WHERE userid = $userid ORDER BY subscription_end_date DESC LIMIT 1");
}



public function getOngoingByUserId($userid) {
    $query = "SELECT * FROM {$this->table} WHERE userid = :userid AND status IN ('paid', 'to pay','active')";
    $data = ['userid' => $userid];

    return $this->query($query, $data);  // use your trait's query() method
}


public function getById($id) {
    $query = "SELECT * FROM subscriptions WHERE subscriptionid = :id";
    return $this->query($query, ['id' => $id])[0] ?? null;  // Returns the first result or null if not found
}

public function updateStatus($data, $condition) {
    // Prepare the update query for the subscription table
    $query = "UPDATE subscription SET status = :status WHERE userid = :userid";
    
    // Execute the query with the provided data
    return $this->query($query, $data);
}


public function updateSubscriptionStatus($subscriptionId, $paymentDate) {
    $query = "UPDATE subscription SET status = :status, date_of_payment = :date_of_payment WHERE subscriptionid = :subscriptionid";
    $data = [
        'status' => 'paid', // Setting status to 'paid'
        'date_of_payment' => $paymentDate, // Date when payment was made
        'subscriptionid' => $subscriptionId, // Subscription to be updated
    ];

    // Execute the query using the query function (which you already have)
    return $this->query($query, $data);
}

public function isWithinTwoWeeksOfExpiry($userId) {
    $query = "SELECT subscription_end_date 
              FROM {$this->table} 
              WHERE userid = :userid AND subscription_end_date >= CURDATE()
              ORDER BY subscription_end_date DESC LIMIT 1";
    
    $result = $this->query($query, ['userid' => $userId]);

    if (!empty($result[0]->subscription_end_date)) {

        $endDate = $result[0]->subscription_end_date; 

        $today = date('Y-m-d');
        $diff = (strtotime($endDate) - strtotime($today)) / (60 * 60 * 24); // difference in days

        if ($diff <= 14) {
            return ['allowed' => true, 'message' => 'You are within 2 weeks of expiry. You can proceed.'];
        } else {
            return ['allowed' => false, 'message' => 'You already have a subscription. Please pay within two weeks prior to the expiration date.'];
        }
    } else {
        return ['allowed' => true, 'message' => 'No active subscription. You can proceed.'];
    }
}


}

