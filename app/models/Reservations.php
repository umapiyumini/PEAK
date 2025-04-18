<?php

class Reservations {
    use Model;
    
    protected $table = 'reservations';
    protected $fillable = ['reservationid','userid','courtid','section','event','duration','date','time','status','usertype','userdescription','userproof','numberof_participants','extradetails','price','discountedprice','occupied','created_at'];

    
    public function insert($data) {
        error_log("Insert method is called.");
        error_log("Data to insert: " . print_r($data, true));
    
        // Build query string
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $query = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";
        error_log("Query to execute: " . $query);
    
        try {
            // Use your existing DB connection method
            $con = $this->connect();
            $stm = $con->prepare($query);
            $result = $stm->execute($data);
    
            if ($result) {
                error_log("Insert successful!");
            } else {
                error_log("Insert failed!");
            }
    
            return $result;
        } catch (\PDOException $e) {
            error_log("PDO Exception: " . $e->getMessage());
            return false;
        }
    }
    
    
    // Get all reservations by user id
    public function getReservationsByUser($userid) {
        $query = 
        
        "SELECT r.*, c.name AS courtname, c.location

        FROM {$this->table} r
        JOIN courts c ON r.courtid = c.courtid
        WHERE userid = :userid
        AND r.courtid != '38'";

        return $this->query($query, ['userid' => $userid]);
    }

    public function getUpcomingevents($userid) {
        $query = "
            SELECT r.*, c.name AS courtname 
            FROM {$this->table} r 
            JOIN courts c ON r.courtid = c.courtid 
            WHERE r.userid = :userid 
              AND r.status = 'Paid' 
              AND r.courtid != '38'
              AND STR_TO_DATE(CONCAT(r.date, ' ', r.time), '%Y-%m-%d %H:%i:%s') > NOW()
        ";
        return $this->query($query, ['userid' => $userid]);
    }
    
    // Get confirmed payments for a user
    public function getDuePayments($userid) {
        $query = 
        "SELECT r.*,c.name AS courtname
        FROM {$this->table} r
        JOIN courts c ON r.courtid = c.courtid
        WHERE r.userid = :userid
        AND r.status = 'accepted'";
        return $this->query($query, ['userid' => $userid]); 
    }


    public function getActiveSubscription($userid, $courtid, $subscription) {
        // Convert subscription to months
        $months = match($subscription) {
            'annual' => 12,
            '6 month' => 6,
            '3 month' => 3,
            default => 0
        };
    
        $query = "SELECT * FROM {$this->table}
                  WHERE userid = :userid
                  AND courtid = :courtid
                  AND subscription = :subscription
                  AND created_at >= DATE_SUB(NOW(), INTERVAL :months MONTH)";
    
        return $this->query($query, [
            'userid' => $userid,
            'courtid' => $courtid,
            'subscription' => $subscription,
            'months' => $months
        ]);
    }

// Model function to check if the selected date is fully booked
// Model: Function to check if the date is fully booked
function isDateFullyBooked($date, $section, $conn) {
    $query = "SELECT * FROM reservations WHERE date = ? AND section = ? AND status IN ('to pay', 'paid', 'confirmed') AND duration = 'full'";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('ss', $date, $section);
        $stmt->execute();
        $result = $stmt->get_result();

        // If there's a match, it means the date is fully booked
        return $result->num_rows > 0;
    }

    return false;
}



public function getBookingsForDateSection($date, $section) {
    $query = "SELECT * FROM {$this->table} 
              WHERE date = :date 
              AND section = :section 
              AND status IN ('to pay', 'paid', 'confirmed')";
    return $this->query($query, [
        'date' => $date,
        'section' => $section
    ]);
}

    


    
    
}  