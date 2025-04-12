<?php

class Inventoryrequest {
    use Model;

    protected $table = 'inventoryrequest';
    protected $fillable = ['requestid','equipmentid','quantityrequested','date','bywhom'];
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
       
}

