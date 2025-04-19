<?php
class PoolBooking{
    use Model;
    protected $table = 'pool_bookings';

    public function findAllBookings(){
        $query = "SELECT * FROM $this->table JOIN user ON $this->table.user_id = user.userid WHERE status='approved'"; 
        return $this->query($query);
    }

    public function deleteBooking($bookingID){
        $query = "UPDATE $this->table SET status='cancelled' WHERE booking_id = :booking_id";
        $params = [':booking_id' => $bookingID];
        return $this->query($query, $params);
    }
}

?>