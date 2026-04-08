<?php

class Reservations {
    use Model;
    
    protected $table = 'reservations';
    protected $fillable = ['reservationid','userid','courtid','event','duration','date','time','status','usertype','userdescription','userproof','numberof_participants','extradetails','price','discountedprice','created_at'];


  
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
    
    
    public function getDuePayments($userid) {
        $query = 
        "SELECT r.*,c.name AS courtname
        FROM {$this->table} r
        JOIN courts c ON r.courtid = c.courtid
        WHERE r.userid = :userid
        AND r.status = 'To pay'";
        return $this->query($query, ['userid' => $userid]); 
    }



public function isFullDayBooked($date, $section) {
    $query = "SELECT COUNT(*) as count FROM {$this->table} r
              JOIN courts c ON r.courtid = c.courtid
              WHERE r.date = :date AND c.section = :section AND r.duration = 'full' AND (UPPER(r.status) = 'CONFIRMED' OR UPPER(r.status) = 'PAID' OR UPPER(r.status) = 'TO PAY')";
    
    $result = $this->query($query, ['date' => $date, 'section' => $section]);
    return $result[0]->count > 0;
}

public function getBookedHalfDaySlots($date, $section) {
    $query = "SELECT r.time FROM {$this->table} r
              JOIN courts c ON r.courtid = c.courtid
              WHERE r.date = :date AND c.section = :section 
              AND r.duration = 'half'
              AND (UPPER(r.status) = 'CONFIRMED' OR UPPER(r.status) = 'PAID' OR UPPER(r.status) = 'TO PAY')";
    
    $result = $this->query($query, ['date' => $date, 'section' => $section]);
    
    $bookedSlots = [];
    if ($result) {
        foreach ($result as $row) {
            $bookedSlots[] = $row->time;
        }
    }
    
    return $bookedSlots;
}



public function getBookedTwoHourSlots($date, $section) {
    $query = "SELECT r.time FROM {$this->table} r
              JOIN courts c ON r.courtid = c.courtid
              WHERE r.date = :date AND c.section = :section 
              AND r.duration = '2 hour'
              AND (UPPER(r.status) = 'CONFIRMED' OR UPPER(r.status) = 'PAID' OR UPPER(r.status) = 'TO PAY')";
    
    $result = $this->query($query, ['date' => $date, 'section' => $section]);
    
    $bookedSlots = [];
    if ($result) {
        foreach ($result as $row) {
            $bookedSlots[] = $row->time;
        }
    }
    
    return $bookedSlots;
}


public function getBookedOneHourSlots($date, $section) {
    $query = "SELECT r.time FROM {$this->table} r
              JOIN courts c ON r.courtid = c.courtid
              WHERE r.date = :date AND c.section = :section 
              AND r.duration = '1 hour'
              AND (UPPER(r.status) = 'CONFIRMED' OR UPPER(r.status) = 'PAID' OR UPPER(r.status) = 'TO PAY')";
    
    $result = $this->query($query, ['date' => $date, 'section' => $section]);
    
    $bookedSlots = [];
    if ($result) {
        foreach ($result as $row) {
            $bookedSlots[] = $row->time;
        }
    }
    
    return $bookedSlots;
}


public function getBookingsForDateSection($date, $section) {
    $query = "SELECT r.*, c.section 
              FROM {$this->table} r
              JOIN courts c ON r.courtid = c.courtid
              WHERE r.date = :date 
              AND c.section = :section
              AND (UPPER(r.status) = 'CONFIRMED' OR UPPER(r.status) = 'PAID' OR UPPER(r.status) = 'TO PAY')";
    
    return $this->query($query, ['date' => $date, 'section' => $section]);
}

    
    
    public function insert($data) {
        error_log("Insert method is called.");
        error_log("Data to insert: " . print_r($data, true));
    
        
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $query = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";
        error_log("Query to execute: " . $query);
    
        try {
           
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

    
    public function getAllReservedTimeSlots($courtId) {
      
        $query = "SELECT date, time FROM {$this->table} 
                 WHERE courtid = :courtId 
                 AND date >= CURDATE() 
                 AND status != 'cancelled'";
        
        $results = $this->query($query, ['courtId' => $courtId]);
        
        
        $reservedSlots = [];
        
     
        if ($results && is_array($results)) {
            foreach ($results as $result) {
                if (!isset($reservedSlots[$result->date])) {
                    $reservedSlots[$result->date] = [];
                }
               
                $reservedSlots[$result->date][] = $result->time;
            }
        }
        
        
        return $reservedSlots;
    }


    public function getReservations() {
        $query = "SELECT * FROM {$this->table} JOIN courts ON courts.courtid = {$this->table}.courtid WHERE location='ground'";
        return $this->query($query);
    }


    public function getReservationDetailsById($reservationid) {
        $query = "
            SELECT r.*, c.name AS courtname, c.location, c.section
            FROM {$this->table} r
            JOIN courts c ON r.courtid = c.courtid
            WHERE r.reservationid = :reservationid
            LIMIT 1
        ";
        
        $result = $this->query($query, ['reservationid' => $reservationid]);
        return $result ? $result[0] : null;
    }
    
    

    public function getReservationbyUser(){

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
        
        
        $query = "DELETE FROM {$this->table} WHERE reservationid = :reservationid AND userid = :userid";
        
        return $this->query($query, [
            'reservationid' => $reservationId,
            'userid' => $userId
        ]);
    }


    
    public function getReservationsByCourtSection($userId) {

        $userId = $this->getUserId();
        
        $query = "
            SELECT r.date, r.time, r.duration, c.name AS courtname, c.section
            FROM {$this->table} r
            JOIN courts c ON r.courtid = c.courtid
            WHERE c.section IN (
                SELECT DISTINCT c2.section
                FROM courts c2
                JOIN {$this->table} r2 ON c2.courtid = r2.courtid
                WHERE r2.userid = :userId
            )
            AND UPPER(r.status) IN ('CONFIRMED', 'PAID', 'TO PAY')
            AND r.date >= CURDATE()
        ";
    
        
        $result = $this->query($query, ['userId' => $userId]);
        
       
    
    $reservedTimeSlots = [];
    foreach ($result as $row) {
        if (!isset($reservedTimeSlots[$row->date])) {
            $reservedTimeSlots[$row->date] = [];
        }
        if (!isset($reservedTimeSlots[$row->date][$row->section])) {
            $reservedTimeSlots[$row->date][$row->section] = [];
        }
        $reservedTimeSlots[$row->date][$row->section][] = [
            'time' => $row->time,
            'duration' => $row->duration,
            'courtname' => $row->courtname
        ];
    }
    
    
    // var_dump($reservedTimeSlots);
    show($reservedTimeSlots);
    return $reservedTimeSlots;

    }


    public function cancelReservations($reservationId) {
        $userId = $this->getUserId();
    
        if (!$userId) {
            return false;
        }
        
        
        $query = "SELECT * FROM {$this->table} WHERE reservationid = :reservationid AND userid = :userid";
        $reservation = $this->query($query, [
            'reservationid' => $reservationId,
            'userid' => $userId
        ], true); 
        
        if (!$reservation) {
            return false; 
        }
        
       
        if (in_array($reservation->status, ['pending', 'To pay', 'rejected'])) {
            
            $query = "DELETE FROM {$this->table} WHERE reservationid = :reservationid AND userid = :userid";
            return $this->query($query, [
                'reservationid' => $reservationId,
                'userid' => $userId
            ]);
        } else if (in_array($reservation->status, ['paid', 'confirmed'])) {
            
            $query = "UPDATE {$this->table} SET status = 'cancelled' WHERE reservationid = :reservationid AND userid = :userid";
            return $this->query($query, [
                'reservationid' => $reservationId,
                'userid' => $userId
            ]);
        }
        
        return false; 
    }
    

    public function getReservationsByCourtLocation($location) {
        $query = "SELECT reservations.*, courts.name, courts.location
                  FROM reservations
                  JOIN courts  ON reservations.courtid = courts.courtid
                  WHERE courts.location = :location";
    
        return $this->query($query, ['location' => $location]);
    }

    public function isDateAvailableForFullDay($date, $section, $currentReservationId = null) {
      
        $query = "SELECT COUNT(*) as count 
                  FROM {$this->table} r
                  JOIN courts c ON r.courtid = c.courtid
                  WHERE r.date = :date 
                  AND c.section = :section
                  AND (UPPER(r.status) = 'CONFIRMED' OR UPPER(r.status) = 'PAID' OR UPPER(r.status) = 'TO PAY')";
        
       
        if ($currentReservationId) {
            $query .= " AND r.reservationid != :reservationId";
            $params = [
                'date' => $date, 
                'section' => $section,
                'reservationId' => $currentReservationId
            ];
        } else {
            $params = ['date' => $date, 'section' => $section];
        }
        
        $result = $this->query($query, $params);
        
        
        return ($result[0]->count == 0);
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


    public function updates($reservationId, $data) {
        $userId = $this->getUserId();
        
        if (!$userId) {
            return false;
        }
        
        
        $setClause = "";
        $params = ['reservationid' => $reservationId, 'userid' => $userId];
        
        foreach ($data as $key => $value) {
            if ($setClause !== "") {
                $setClause .= ", ";
            }
            $setClause .= "$key = :$key";
            $params[$key] = $value;
        }
        
        $query = "UPDATE {$this->table} SET $setClause WHERE reservationid = :reservationid AND userid = :userid";
        
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

    public function getAllCancelledReservations(){
        $query = "SELECT * ,courts.name AS courtname, user.name AS username FROM {$this->table} 
        JOIN user ON user.userid= $this->table.userid
        JOIN courts ON courts.courtid= $this->table.courtid
        LEFT JOIN payments ON payments.reservationid= $this->table.reservationid
        WHERE status = 'cancelled' AND location='ground'";
        return $this->query($query);
    }

    public function getAllIndoorTopayReservations(){
        $query = "SELECT * ,courts.name AS courtname, user.name AS username FROM {$this->table} 
        JOIN user ON user.userid= $this->table.userid
        JOIN courts ON courts.courtid= $this->table.courtid
        WHERE status = 'To pay' AND location='indoor'";
        return $this->query($query);
    }

    public function getAllIndoorCancelledReservations(){
        $query = "SELECT * ,courts.name AS courtname, user.name AS username FROM {$this->table} 
        JOIN user ON user.userid= $this->table.userid
        JOIN courts ON courts.courtid= $this->table.courtid
        LEFT JOIN payments ON payments.reservationid= $this->table.reservationid
        WHERE status = 'cancelled' AND location='indoor'";
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
        WHERE location='ground' AND status IN ('confirmed', 'To pay', 'paid', 'cancelled')
        ORDER BY $this->table.created_at DESC";
        return $this->query($query);
    }

    public function getAllActiveReservationsIndoor(){
        $query = "SELECT * ,courts.name AS courtname, user.name AS username FROM {$this->table} 
        JOIN user ON user.userid= $this->table.userid
        JOIN courts ON courts.courtid= $this->table.courtid
        LEFT JOIN payments ON payments.reservationid = $this->table.reservationid
        WHERE location='indoor' AND status IN ('confirmed', 'To pay', 'paid','cancelled')
        ORDER BY $this->table.created_at DESC";
        return $this->query($query);
    }


//     public function getReservations2() {
//         $query = "SELECT * ,courts.name AS courtname, user.name AS username FROM {$this->table} 
//         JOIN user ON user.userid= $this->table.userid
//         JOIN courts ON courts.courtid= $this->table.courtid
//         WHERE location='ground'";
//         return $this->query($query);
//     }

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
      
        $query = "SELECT * FROM {$this->table} WHERE status = 'pending'";
        $pendingReservations = $this->query($query);
        
        if (empty($pendingReservations)) {
            return 0; 
        }
        

        $activeQuery = "SELECT * FROM {$this->table} r
        JOIN courts c ON c.courtid= r.courtid
        WHERE status IN ('confirmed', 'To pay', 'paid')";
        $activeReservations = $this->query($activeQuery);
        
        $rejectedCount = 0;
        
        foreach ($pendingReservations as $pending) {
            foreach ($activeReservations as $active) {

                if ($pending->date == $active->date && 
                    $pending->section == $active->section && 
                    $this->isTimeOverlapping($pending, $active)) {
                    
                    
                    $rejectQuery = "UPDATE {$this->table} SET status = 'rejected' WHERE reservationid = :reservationid";
                    $this->query($rejectQuery, ['reservationid' => $pending->reservationid]);
                    
                    $rejectedCount++;
                    break;
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
        $activeReservations = $this->query("SELECT * FROM {$this->table} r
            JOIN courts c ON c.courtid= r.courtid
            WHERE status IN ('confirmed', 'To pay', 'paid')
            AND section = :section
            AND date = :date", [
            'section' => $reservation->section,
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

    
   
    


  
    public function getFutureReservationsByUser($userid) {
        $query = "
            SELECT r.*, c.name AS courtname, c.location, c.section
            FROM {$this->table} r
            JOIN courts c ON r.courtid = c.courtid
            WHERE r.userid = :userid
              AND r.courtid != '38'
              AND STR_TO_DATE(CONCAT(r.date, ' ', r.time), '%Y-%m-%d %H:%i:%s') > NOW()
              AND r.status IN ('To pay', 'Confirmed', 'Paid', 'pending','rejected','cancelled')
            ORDER BY r.date, r.time
        ";
        return $this->query($query, ['userid' => $userid]);
    }
    

public function getAllReservationsByUser($userid) {
    $query = "
        SELECT r.*, c.name AS courtname, c.location, c.section
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
