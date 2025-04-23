<?php

class Reservations {
    use Model;
    
    protected $table = 'reservations';
    protected $fillable = ['reservationid','userid','courtid','section','event','duration','date','time','status','usertype','userdescription','userproof','numberof_participants','extradetails','price','discountedprice','occupied','created_at'];


    //used
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




    //not yet
    
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


    public function addReservation(){

        $userId = $this->getUserId();
    
        if (!$userId) {
            die("User ID not found in session.");
        }
    
        try{
            $query = "INSERT INTO {$this->table}(userid, courtid, event, duration, date, time, status, numberof_participants)
                    VALUES (
                        :userid,
                        :courtid,
                        :event,
                        :duration,
                        :date,
                        :time,
                        :status,
                        :numberof_participants
                    )";
    
            $result = $this->query($query, [
                'userid' => $userId,
                'courtid' => $_POST['courtid'],
                'event' => $_POST['event'],
                'duration' => $_POST['duration'],
                'date' => $_POST['date'],
                'time' => $_POST['time'],
                'status' => $_POST['status'],
                'numberof_participants' => $_POST['numberof_participants']
            ]);
    
            return $result;
    
        } catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
            return false;
        }
    }

    public function getTimeSlots($date, $courtId) {
        $query = "SELECT time FROM {$this->table} WHERE date = :date AND courtid = :courtId";
        $result = $this->query($query, ['date' => $date, 'courtId' => $courtId]);
    
        if (!$result || !is_array($result)) {
            return []; // Return empty array if query fails
        }
    
        $reservedTimes = array_column($result, 'time');
        return $reservedTimes;
    }
    

    public function getAllReservedTimeSlots($courtId) {
        // Get all reservations for this court in the future
        $query = "SELECT date, time FROM {$this->table} 
                 WHERE courtid = :courtId 
                 AND date >= CURDATE() 
                 AND status != 'cancelled'";
        
        $results = $this->query($query, ['courtId' => $courtId]);
        
        // Format the results as a structured array for JavaScript
        $reservedSlots = [];
        
        // Check if results is valid before looping
        if ($results && is_array($results)) {
            foreach ($results as $result) {
                if (!isset($reservedSlots[$result->date])) {
                    $reservedSlots[$result->date] = [];
                }
                // Store the start time
                $reservedSlots[$result->date][] = $result->time;
            }
        }
        
        
        return $reservedSlots;
    }

    public function getReservations(){

        $userId = $this->getUserId();

        if (!$userId) {
            die("User ID not found in session.");
        }

        $query = "SELECT reservations.*,courts.name FROM reservations
                    JOIN courts ON reservations.courtid = courts.courtid 
                    WHERE reservations.userid = :userid";
        $result = $this->query($query, ['userid' => $userId]);
        return $result;
    }

    public function editReservation($reservationId, $data) {
        $userId = $this->getUserId();
    
        if (!$userId) {
            die("User ID not found in session.");
        }
    
        $query = "UPDATE reservations SET 
                    event = :event, 
                    date = :date,
                    duration = :duration, 
                    time = :time, 
                    numberof_participants = :numberof_participants 
                  WHERE reservationid = :reservationId";
    
        return $this->query($query, [
            'event' => $data['event'],
            'date' => $data['date'],
            'duration' => $data['duration'],
            'time' => $data['time'],
            'numberof_participants' => $data['numberof_participants'],
            'reservationId' => $reservationId
        ]);
    }

    public function deleteReservation($reservationId) {

        $userId = $this->getUserId();
    
        if (!$userId) {
            return false;
        }
        
        // Add user ID to ensure users can only delete their own reservations
        $query = "DELETE FROM {$this->table} WHERE reservationid = :reservationid AND userid = :userid";
        
        return $this->query($query, [
            'reservationid' => $reservationId,
            'userid' => $userId
        ]);
    }

    public function getReservationsByCourtLocation($location) {
        $query = "SELECT reservations.*, courts.name, courts.location
                  FROM reservations
                  JOIN courts  ON reservations.courtid = courts.courtid
                  WHERE courts.location = :location";
    
        return $this->query($query, ['location' => $location]);
    }

    
       
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

    public function acceptReservation($reservation) {

        if($reservation->status == 'pending'){
            $query = "UPDATE {$this->table} SET status = 'To pay' WHERE reservationid = :reservationid";
        }
        elseif($reservation->status == 'paid'){
            $query = "UPDATE {$this->table} SET status = 'confirmed' WHERE reservationid = :reservationid";
        }

        $params = [
            'reservationid' => $reservation->reservationid
        ];
        return $this->query($query, $params);
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

    public function getAllReservationsGround(){
        $query = "SELECT * ,courts.name AS courtname, user.name AS username FROM {$this->table} 
        JOIN user ON user.userid= $this->table.userid
        JOIN courts ON courts.courtid= $this->table.courtid
        JOIN payments ON payments.reservationid = $this->table.reservationid
        WHERE location='ground'
        ORDER BY $this->table.created_at DESC";
        return $this->query($query);
    }

    public function getReservations() {
        $query = "SELECT * FROM {$this->table} JOIN courts ON courts.courtid = {$this->table}.courtid WHERE location='ground'";
        return $this->query($query);
    }

    
}

  
public function getFutureReservationsByUser($userid) {
    $query = "
        SELECT r.*, c.name AS courtname, c.location
        FROM {$this->table} r
        JOIN courts c ON r.courtid = c.courtid
        WHERE r.userid = :userid
          AND r.courtid != '38'
          AND STR_TO_DATE(CONCAT(r.date, ' ', r.time), '%Y-%m-%d %H:%i:%s') > NOW()
          AND r.status IN ('To pay', 'Confirmed', 'Paid', 'pending') -- Add other active statuses if needed
        ORDER BY r.date, r.time
    ";
    return $this->query($query, ['userid' => $userid]);
}

// All reservations for this user
public function getAllReservationsByUser($userid) {
    $query = "
        SELECT r.*, c.name AS courtname, c.location
        FROM {$this->table} r
        JOIN courts c ON r.courtid = c.courtid
        WHERE r.userid = :userid
          AND r.courtid != '38'
        ORDER BY r.date DESC, r.time DESC
    ";
    return $this->query($query, ['userid' => $userid]);
}



public function update($reservationid, $data) {
    $set = [];
    foreach ($data as $key => $value) {
        $set[] = "$key = :$key";
    }
    $setStr = implode(', ', $set);
    $query = "UPDATE {$this->table} SET $setStr WHERE reservationid = :reservationid";
    $data['reservationid'] = $reservationid;
    return $this->query($query, $data);
}

}  

