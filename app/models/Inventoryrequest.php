<?php

class Inventoryrequest {
    use Model;

    protected $table = 'inventoryrequest';
    protected $fillable = ['requestid','equipmentid','quantityrequested','timeframe','date','requested_by','status','addnotes'];
    private $errorMsg = '';

    public function requesttable() {
        $query = "SELECT i.requestid, e.type, s.sport_name, e.name, i.quantityrequested, i.date, i.status
                  FROM inventoryrequest i
                  JOIN equipments e ON i.equipmentid = e.equipmentid
                  JOIN sport s ON i.sport_id = s.sport_id
                WHERE e.type = 'recreational'
                  ";

        return $this->query($query);
    }

    public function requesttable2() {
        $query = "SELECT i.requestid, e.type, s.sport_name, e.name, i.quantityrequested, i.date, i.status
                  FROM inventoryrequest i
                  JOIN equipments e ON i.equipmentid = e.equipmentid
                  JOIN sport s ON i.sport_id = s.sport_id
                WHERE i.timeframe = 'mid year'
                  ";

        return $this->query($query);
    }
    
    public function yearEndrequesttable() {
        $query = "SELECT i.requestid, s.sport_name, e.name, i.quantityrequested, i.date, i.status, i.addnotes
                  FROM inventoryrequest i
                  JOIN equipments e ON i.equipmentid = e.equipmentid
                  JOIN sport s ON i.sport_id = s.sport_id
                  WHERE i.timeframe = 'end year' AND i.status NOT IN ('Approved', 'Rejected')";
    
        return $this->query($query);
    }

    public function allYearEndRequests() {
        $query = "SELECT i.requestid, s.sport_name, e.name, i.quantityrequested, i.date, i.status, i.addnotes
                  FROM inventoryrequest i
                  JOIN equipments e ON i.equipmentid = e.equipmentid
                  JOIN sport s ON i.sport_id = s.sport_id
                  WHERE i.timeframe = 'end year' AND i.status IN ('Approved', 'Rejected')";
    
        return $this->query($query);
    }

    public function getCountYearMid() {
        $query = "SELECT COUNT(*) AS count FROM inventoryrequest WHERE timeframe = 'mid year'";
        $result = $this->query($query);
        return $result[0]->count ?? 0; // Return the count or 0 if not found
    }

    public function getCountYearEnd() {
        $query = "SELECT COUNT(*) AS count FROM inventoryrequest WHERE timeframe = 'end year' AND inventoryrequest.status NOT IN ('Approved', 'Rejected')";
        $result = $this->query($query);
        return $result[0]->count ?? 0; // Return the count or 0 if not found
    }

    // Function to save a request (approve it)
    public function saveRequest($sport) {
        // Update the status of the request to 'Approved'
        $query = "UPDATE inventoryrequest SET status = 'Approved' WHERE requestid in (SELECT requestid FROM inventoryrequest join sport on sport.sport_id = inventoryrequest.sport_id WHERE sport_name = :sport)";
        $result = $this->query($query, ['sport' => $sport]);
        
        return true;
    }

    // Function to reject a request
    public function rejectRequest($sport) {
        // Update the status of the request to 'Rejected'
        $query = "UPDATE inventoryrequest SET status = 'Rejected' WHERE requestid in (SELECT requestid FROM inventoryrequest join sport on sport.sport_id = inventoryrequest.sport_id WHERE sport_name = :sport)";
        $result = $this->query($query, ['sport' => $sport]);
        
        return true;
    }

    

    // Function to change the status of a request to either approved or rejected
    public function updateStatus($requestid, $status) {
        // First, check the available stock for the requested equipment
        $checkquery = "SELECT COALESCE(SUM(st.quantity), 0) AS available, i.quantityrequested, i.equipmentid
                    FROM inventoryrequest i
                    LEFT JOIN stock st ON st.equipmentid = i.equipmentid 
                    WHERE i.requestid = :requestid
                    GROUP BY i.quantityrequested, i.equipmentid";
        
        $checkresult = $this->query($checkquery, ['requestid' => $requestid]);

        // If no stock data found, return false
        if (!$checkresult || empty($checkresult)) {
            $this->errorMsg = "Stock check failed for requestid: $requestid";
            return false;
        }

        // Extract values from the query result
        $availableStock = (int) $checkresult[0]->available;  // Ensure it's treated as an integer
        $requestedQuantity = (int) $checkresult[0]->quantityrequested;
        $equipmentId = (int) $checkresult[0]->equipmentid;

        // If approving, ensure enough stock is available
        if ($requestedQuantity > $availableStock) {
            $this->errorMsg = "Not enough stock for requestid: $requestid. Requested: $requestedQuantity, Available: $availableStock";
            return false; // Prevent approval if stock is insufficient
        }

        // If approval is valid or status is rejected, update the request status
        $query = "UPDATE inventoryrequest SET status = :status WHERE requestid = :requestid";
        $result = $this->query($query, ['status' => $status, 'requestid' => $requestid]);
        return true;
    }

    public function deleteRequest($request) {
        $query = "DELETE FROM inventoryrequest WHERE requestid = :requestid";
        $result = $this->query($query, ['requestid' => $request]);
        
        return true;
    }

    public function getErrorMsg() {
        return $this->errorMsg;
    }



    public function createRequest($equipmentName, $quantity)
    {
        // First, find the equipment by name
        $equipment = $this->query("SELECT equipmentid FROM equipments WHERE name = :name", ['name' => $equipmentName]);

        if ($equipment) {
            // Get the equipmentid from the query result
            $equipmentid = $equipment[0]->equipmentid;

            // Prepare data to insert into the inventoryrequest table
            $data = [
                'equipmentid' => $equipmentid,
                'quantityrequested' => $quantity,
                'date' => date('Y-m-d H:i:s'),  // Current timestamp
                'bywhom' => 'abc'  // Default 'abc' for who made the request
            ];

            // Insert the request into the inventoryrequest table
            $this->insert($data);
            return true;
        }

        return false;
    }

    public function getPreviousRequests(){

        $userId = $this->getUserId();
        if (!$userId) {
            die("User ID not found in session.");
        }

        $query = "SELECT equipments.name, inventoryrequest.* 
                FROM inventoryrequest
                JOIN equipments ON inventoryrequest.equipmentid = equipments.equipmentid
                WHERE inventoryrequest.requested_by = :userid";

        return $this->query($query, ['userid' => $userId]);

    }


    public function addRequestnew($requests) {
        $userId = $this->getUserId();
        
        if (!$userId) {
            return false;
        }
        
        $query = "INSERT INTO inventoryrequest (
                    equipmentid, 
                    quantityrequested, 
                    timeframe, 
                    date, 
                    requested_by,
                    status, 
                    addnotes)
                  VALUES (
                    (SELECT equipmentid FROM equipments WHERE name = :name),
                    :quantityrequested,
                    :timeframe,
                    CURRENT_DATE,
                    :userid,
                    'pending',
                    :addnotes)";
        
        foreach ($requests as $req) {
            $this->query($query, [
                'name' => $req['name'],
                'quantityrequested' => $req['quantityrequested'],
                'timeframe' => $req['timeframe'],
                'userid' => $req['userId'],
                'addnotes' => $req['addnotes'],
            ]);
        }
    
        return true;
    }
    
    

    public function editRequest($requestid, $equipmentid, $quantityrequested, $timeframe, $date){

        $query = "UPDATE inventoryrequest SET 
                equipmentid = (SELECT equipmentid FROM equipments WHERE name = :equipmentid),
                quantityrequested = :quantityrequested,
                timeframe = :timeframe,
                date = :date
                WHERE requestid = :requestid";

        return $this->query($query, [
            'equipmentid' => $equipmentid,
            'quantityrequested' => $quantityrequested,
            'timeframe' => $timeframe,
            'date' => $date,
            'requestid' => $requestid
        ]);
                
    }

    public function getAllRequests(){

        $query = "SELECT inventoryrequest.*, equipments.name FROM inventoryrequest
                JOIN equipments ON inventoryrequest.equipmentid = equipments.equipmentid
                WHERE inventoryrequest.status = 'pending'";

        $result = $this->query($query);
        
        return $result;
    }

    public function addRequest() {

        $userId = $this->getUserId();
    
        if (!$userId) {
            die("User ID not found in session.");
        }

        $sportQuery = "SELECT sport_id FROM sports_captain WHERE userid = :userid";
        $sportResult = $this->query($sportQuery, ['userid' => $userId]);

        $sportId = $sportResult[0]->sport_id ?? null; 
    
        $query = "INSERT INTO inventoryrequest (
                    equipmentid,
                    sport_id, 
                    quantityrequested, 
                    timeframe, 
                    date, 
                    requested_by,
                    status, 
                    addnotes)
                  VALUES (
                    :equipmentid,
                    :sport_id,
                    :quantityrequested,
                    :timeframe,
                    CURRENT_DATE,
                    :userid,
                    :status,
                    :addnotes)";
    
        return $this->query($query, [
            'equipmentid' => $_POST['equipmentid'],
            'sport_id' => $sportId,
            'quantityrequested' => $_POST['quantityrequested'],
            'timeframe' => $_POST['timeframe'],
            'userid' => $userId,
            'addnotes' => $_POST['addnotes'],
            'status' => $_POST['status'] ?? 'pending', // Default to 'pending' if not provided
        ]);
    }


}

