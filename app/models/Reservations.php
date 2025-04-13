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
    


    public function checkExistingReservations($date, $section) {
        // Log the values received for debugging purposes
        error_log("Checking availability for section: $section, date: $date");
    
        // Query to check existing reservations for the section and date
        $query = "SELECT * FROM reservations WHERE section = :section AND date = :date AND status IN ('to pay', 'paid', 'confirmed')";
    
        // Ensure we're using 'section' instead of 'courtid'
        $data = ['section' => $section, 'date' => $date];
    
        // Execute the query
        $results = $this->query($query, $data);
    
        $fullDayCount = 0;
        $halfDayCount = 0;
        $bookedHalfSlot = '';
    
        if ($results) {
            // Loop through the results to count full and half-day reservations
            foreach ($results as $reservation) {
                if ($reservation->duration === 'full') {
                    $fullDayCount++;
                } elseif ($reservation->duration === 'half') {
                    $halfDayCount++;
                    $bookedHalfSlot = $reservation->time;  // Assuming 'time' field represents the booked half-slot
                }
            }
        }
    
        // Return the count of reservations for full day, half day, and any booked half slot
        return [
            'fullDayCount' => $fullDayCount,
            'halfDayCount' => $halfDayCount,
            'bookedHalfSlot' => $bookedHalfSlot
        ];
    }
    
} 