<?php

class Reservations {
    use Model;
    
    protected $table = 'reservations';
    protected $fillable = ['reservationid','userid','facility','event','date','time','price','status'];

    public function getReservationsByUser($userid) {
        $query = "SELECT * FROM {$this->table} WHERE userid = :userid";
        return $this->query($query, ['userid' => $userid]);
    }

    public function getPendingReservations($userid) {
        $query = "SELECT * FROM {$this->table} WHERE userid = :userid AND status = 'Pending'";
        return $this->query($query, ['userid' => $userid]);
    }

    public function getDuePayments($userid) {
        $query = "SELECT * FROM {$this->table} WHERE userid = :userid AND status = 'confirmed'";
        return $this->query($query, ['userid' => $userid]); 
    }
    
    
    
    
    
}




   




 
