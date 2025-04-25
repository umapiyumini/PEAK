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
              AND r.status = 'confirmed' 
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
        AND r.status = 'To pay'";
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

    

public function delete($reservationid) {
    $query = "DELETE FROM {$this->table} WHERE reservationid = :reservationid";
    return $this->query($query, ['reservationid' => $reservationid]);
}

public function findById($reservationid) {
    $query = "SELECT * FROM {$this->table} WHERE reservationid = :reservationid LIMIT 1";
    $result = $this->query($query, ['reservationid' => $reservationid]);
    return $result ? $result[0] : null;
}



    public function getAllPendingReservations($type = 'all') {
        $now = new DateTime();
        $oneweekago = clone $now;
        $oneweekago->modify('-7 days');
        $oneweekago = $oneweekago->format('Y-m-d H:i:s');
        
        if ($type == 'new') {
            $query = "SELECT *,courts.name AS courtname, user.name AS username FROM {$this->table} 
            JOIN user ON user.userid= $this->table.userid
            JOIN courts ON courts.courtid= $this->table.courtid
            WHERE status = 'pending' AND created_at <= :oneweekago AND location='ground'";
            return $this->query($query, ['oneweekago' => $oneweekago]);
        }
        elseif ($type == 'old') {
            $query = "SELECT * ,courts.name AS courtname, user.name AS username FROM {$this->table} 
            JOIN user ON user.userid= $this->table.userid
            JOIN courts ON courts.courtid= $this->table.courtid
            WHERE status = 'pending' AND created_at > :oneweekago AND location='ground'";
            return $this->query($query, ['oneweekago' => $oneweekago]);
        }
        else {
            $query = "SELECT * FROM {$this->table} WHERE status = 'pending'";
            return $this->query($query);
        }
    }

    public function getAllIndoorPendingReservations($type = 'all') {
        $now = new DateTime();
        $oneweekago = clone $now;
        $oneweekago->modify('-7 days');
        $oneweekago = $oneweekago->format('Y-m-d H:i:s');
        
        if ($type == 'new') {
            $query = "SELECT *,courts.name AS courtname, user.name AS username FROM {$this->table} 
            JOIN user ON user.userid= $this->table.userid
            JOIN courts ON courts.courtid= $this->table.courtid
            WHERE status = 'pending' AND created_at <= :oneweekago AND location='indoor'";
            return $this->query($query, ['oneweekago' => $oneweekago]);
        }
        elseif ($type == 'old') {
            $query = "SELECT * ,courts.name AS courtname, user.name AS username FROM {$this->table} 
            JOIN user ON user.userid= $this->table.userid
            JOIN courts ON courts.courtid= $this->table.courtid
            WHERE status = 'pending' AND created_at > :oneweekago AND location='indoor'";
            return $this->query($query, ['oneweekago' => $oneweekago]);
        }
        else {
            $query = "SELECT * FROM {$this->table} WHERE status = 'pending'";
            return $this->query($query);
        }
    }

    public function acceptReservation($reservation) {

        $query = "";
        
        if($reservation->status == 'pending'){
            $query = "UPDATE {$this->table} SET status = 'To pay' WHERE reservationid = :reservationid";
        }
        elseif($reservation->status == 'paid'){
            $query = "UPDATE {$this->table} SET status = 'confirmed' WHERE reservationid = :reservationid";
        }
        else {
            return false; 
        }
        
        if (!empty($query)) {
            $params = [
                'reservationid' => $reservation->reservationid
            ];
            return $this->query($query, $params);
        }
        
        return false; 
    }
    
    public function rejectReservation($reservation) {
        $query = "UPDATE {$this->table} SET status = 'rejected' WHERE reservationid = :reservationid";
        $params = [
            'reservationid' => $reservation->reservationid
        ];
        return $this->query($query, $params);
    }

    public function getAllTopayReservations(){
        $query = "SELECT * ,courts.name AS courtname, user.name AS username FROM {$this->table} 
        JOIN user ON user.userid= $this->table.userid
        JOIN courts ON courts.courtid= $this->table.courtid
        WHERE status = 'To pay' AND location='ground'";
        return $this->query($query);
    }

    public function getAllPaidReservations(){
        $query = "SELECT * ,courts.name AS courtname, user.name AS username FROM {$this->table} 
        JOIN user ON user.userid= $this->table.userid
        JOIN courts ON courts.courtid= $this->table.courtid
        JOIN payments ON payments.reservationid = $this->table.reservationid
        WHERE status = 'paid' AND location='ground'";
        return $this->query($query);
    }

    public function getAllConfirmedReservations(){
        $query = "SELECT * ,courts.name AS courtname, user.name AS username FROM {$this->table} 
        JOIN user ON user.userid= $this->table.userid
        JOIN courts ON courts.courtid= $this->table.courtid
        WHERE status = 'confirmed' AND location='ground'";
        return $this->query($query);
    }

    public function getAllRejectedReservations(){
        $query = "SELECT * ,courts.name AS courtname, user.name AS username FROM {$this->table} 
        JOIN user ON user.userid= $this->table.userid
        JOIN courts ON courts.courtid= $this->table.courtid
        WHERE status = 'rejected' AND location='ground'";
        return $this->query($query);
    }

    public function getAllIndoorTopayReservations(){
        $query = "SELECT * ,courts.name AS courtname, user.name AS username FROM {$this->table} 
        JOIN user ON user.userid= $this->table.userid
        JOIN courts ON courts.courtid= $this->table.courtid
        WHERE status = 'To pay' AND location='indoor'";
        return $this->query($query);
    }

    public function getAllIndoorPaidReservations(){
        $query = "SELECT * ,courts.name AS courtname, user.name AS username FROM {$this->table} 
        JOIN user ON user.userid= $this->table.userid
        JOIN courts ON courts.courtid= $this->table.courtid
        JOIN payments ON payments.reservationid = $this->table.reservationid
        WHERE status = 'paid' AND location='indoor'";
        return $this->query($query);
    }

    public function getAllIndoorConfirmedReservations(){
        $query = "SELECT * ,courts.name AS courtname, user.name AS username FROM {$this->table} 
        JOIN user ON user.userid= $this->table.userid
        JOIN courts ON courts.courtid= $this->table.courtid
        WHERE status = 'confirmed' AND location='indoor'";
        return $this->query($query);
    }

    public function getAllInddorRejectedReservations(){
        $query = "SELECT * ,courts.name AS courtname, user.name AS username FROM {$this->table} 
        JOIN user ON user.userid= $this->table.userid
        JOIN courts ON courts.courtid= $this->table.courtid
        WHERE status = 'rejected' AND location='indoor'";
        return $this->query($query);
    }

    public function getAllActiveReservationsGround(){
        $query = "SELECT * ,courts.name AS courtname, user.name AS username FROM {$this->table} 
        JOIN user ON user.userid= $this->table.userid
        JOIN courts ON courts.courtid= $this->table.courtid
        LEFT JOIN payments ON payments.reservationid = $this->table.reservationid
        WHERE location='ground' AND status IN ('confirmed', 'To pay', 'paid')
        ORDER BY $this->table.created_at DESC";
        return $this->query($query);
    }

    public function getAllActiveReservationsIndoor(){
        $query = "SELECT * ,courts.name AS courtname, user.name AS username FROM {$this->table} 
        JOIN user ON user.userid= $this->table.userid
        JOIN courts ON courts.courtid= $this->table.courtid
        LEFT JOIN payments ON payments.reservationid = $this->table.reservationid
        WHERE location='indoor' AND status IN ('confirmed', 'To pay', 'paid')
        ORDER BY $this->table.created_at DESC";
        return $this->query($query);
    }

    public function getReservations() {
        $query = "SELECT * ,courts.name AS courtname, user.name AS username FROM {$this->table} 
        JOIN user ON user.userid= $this->table.userid
        JOIN courts ON courts.courtid= $this->table.courtid
        WHERE location='ground'";
        return $this->query($query);
    }

    public function getActiveReservations() {
        $query = "SELECT * ,courts.name AS courtname, user.name AS username FROM {$this->table} 
        JOIN user ON user.userid= $this->table.userid
        JOIN courts ON courts.courtid= $this->table.courtid
        WHERE location='ground' AND status IN ('confirmed', 'To pay', 'paid')";
        return $this->query($query);
    }

    public function getActiveReservationsIndoor() {
        $query = "SELECT * ,courts.name AS courtname, user.name AS username FROM {$this->table} 
        JOIN user ON user.userid= $this->table.userid
        JOIN courts ON courts.courtid= $this->table.courtid
        WHERE location='indoor' AND status IN ('confirmed', 'To pay', 'paid')";
        return $this->query($query);
    }

    public function getAllPaidTopayConfirmedReservations(){
        $query = "SELECT * ,courts.name AS courtname, user.name AS username, reservations.time AS startTime FROM {$this->table} 
        JOIN user ON user.userid= $this->table.userid
        JOIN courts ON courts.courtid= $this->table.courtid
        WHERE status IN ('confirmed', 'To pay', 'paid')";
        return $this ->query($query);
    }

    
    public function rejectConflictingReservations() {
        // Get all pending reservations
        $query = "SELECT * FROM {$this->table} WHERE status = 'pending'";
        $pendingReservations = $this->query($query);
        
        if (empty($pendingReservations)) {
            return 0; // No pending reservations to check
        }
        

        $activeQuery = "SELECT * FROM {$this->table} WHERE status IN ('confirmed', 'To pay', 'paid')";
        $activeReservations = $this->query($activeQuery);
        
        $rejectedCount = 0;
        
        foreach ($pendingReservations as $pending) {
            foreach ($activeReservations as $active) {

                if ($pending->date == $active->date && 
                    $pending->courtid == $active->courtid && 
                    $this->isTimeOverlapping($pending, $active)) {
                    
                    // Reject the pending reservation
                    $rejectQuery = "UPDATE {$this->table} SET status = 'rejected' WHERE reservationid = :reservationid";
                    $this->query($rejectQuery, ['reservationid' => $pending->reservationid]);
                    
                    $rejectedCount++;
                    break; // No need to check other active reservations for this pending one
                }
            }
        }
        
        return $rejectedCount;
    }


    public function isTimeOverlapping($res1, $res2) {

        $res1Start = strtotime($res1->time);
        $res1End = strtotime($this->calculateEndTime($res1->time, $res1->duration));
        
        $res2Start = strtotime($res2->time);
        $res2End = strtotime($this->calculateEndTime($res2->time, $res2->duration));
        

        return ($res1Start < $res2End && $res1End > $res2Start);
    }

    public function calculateEndTime($startTime, $duration) {
        $start = strtotime($startTime);
        switch ($duration) {
            case '1 hour':
                return date('H:i:s', $start + 1 * 3600);
            case '2 hour':
                return date('H:i:s', $start + 2 * 3600);
            case 'half':
                return date('H:i:s', $start + 4 * 3600);
            case 'full':
                return date('H:i:s', $start + 9 * 3600); 
            default:
                return date('H:i:s', $start + 2 * 3600); 
        }
    }

    public function checkForConflicts($reservation) {
        $activeReservations = $this->query("SELECT * FROM {$this->table} 
            WHERE status IN ('confirmed', 'To pay', 'paid')
            AND courtid = :courtid
            AND date = :date", [
            'courtid' => $reservation->court,
            'date' => $reservation->date
        ]);

        foreach ($activeReservations as $active) {
            if ($this->isTimeOverlapping($reservation, $active)) {
                return true;
            }
        }

        return false;
    }

    public function addSpecialReservation($data){
        $reservation = (object) $_POST; 
        if ($this->checkForConflicts($reservation)) {
            return false;
        }

        $query = "INSERT INTO $this->table (userid, courtid, event, duration, date, time, status, numberof_participants, extradetails) VALUES (:userid, :courtid, :event, :duration, :date, :time, :status, :numberof_participants, :extradetails)";
        $params = [
            ':userid' => $_SESSION['userid'],
            ':courtid' => $data['court'],
            ':event' => $data['event'],
            ':duration' => $data['duration'],
            ':date' => $data['date'],
            ':time' => $data['time'],
            ':status' => "confirmed",
            ':numberof_participants' => $data['participants'],
            ':extradetails' => $data['notes'],
        ];
        return $this->query($query, $params);
    }

    public function cancelSpecialReservations($id){
        $query = "DELETE r
                  FROM $this->table r
                  JOIN user u ON u.userid = r.userid
                  WHERE r.reservationid = :id AND u.role = 'Admin'";
    
        return $this->query($query, ['id' => $id]);
    }

    
   
    
}
