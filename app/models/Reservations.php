<?php

class Reservations {
    use Model;
    
    protected $table = 'reservations';
    protected $fillable = ['reservationid','userid','courtid','event','date','time','status','usertype','userdescription','userproof','numberof_participants','extradetails','price','discountedprice','occupied','created_at'];

    
    public function insert($data) {
        // Assuming you have a query method in the Model trait
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $query = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";
        
        return $this->query($query, $data);
    }
    
    
    // Get all reservations by user id
    public function getReservationsByUser($userid) {
        $query = "SELECT * FROM {$this->table} WHERE userid = :userid";
        return $this->query($query, ['userid' => $userid]);
    }

    // Get pending reservations for a user
    public function getPendingReservations($userid) {
        $query = "SELECT * FROM {$this->table} WHERE userid = :userid AND status = 'Pending'";
        return $this->query($query, ['userid' => $userid]);
    }

    // Get confirmed payments for a user
    public function getDuePayments($userid) {
        $query = "SELECT * FROM {$this->table} WHERE userid = :userid AND status = 'confirmed'";
        return $this->query($query, ['userid' => $userid]); 
    }
}