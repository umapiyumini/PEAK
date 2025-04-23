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