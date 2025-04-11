<?php

class Payments {
    use Model;
    protected $table = 'payments';
    protected $fillable = ['paymentid', 'userid', 'reservationid', 'payment_proof', 'created_at'];

    // Insert the payment into the database
    public function create($data) {
        // Insert payment into the database
        $sql = "INSERT INTO $this->table (userid, reservationid, payment_proof, created_at) 
                VALUES (:userid, :reservationid, :payment_proof, :created_at)";
        
        // Prepare the query and bind parameters
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userid', $data['userid']);
        $stmt->bindParam(':reservationid', $data['reservationid']);
        $stmt->bindParam(':payment_proof', $data['payment_proof']);
        $stmt->bindParam(':created_at', $data['created_at']);

        // Execute the query and check if successful
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
