<?php

class Payments {
    use Model;
    protected $table = 'payments';
    protected $fillable = ['paymentid', 'userid', 'reservationid', 'payment_proof', 'created_at'];

    
    public function create($data) {
       
        $sql = "INSERT INTO $this->table (userid, reservationid, payment_proof, created_at) 
                VALUES (:userid, :reservationid, :payment_proof, :created_at)";
        
       
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userid', $data['userid']);
        $stmt->bindParam(':reservationid', $data['reservationid']);
        $stmt->bindParam(':payment_proof', $data['payment_proof']);
        $stmt->bindParam(':created_at', $data['created_at']);

        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
