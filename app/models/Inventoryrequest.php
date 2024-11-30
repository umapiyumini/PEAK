<?php

class Inventoryrequest {
    use Model;

    protected $table = 'inventoryrequest';
    protected $fillable = ['requestid','equipmentid','quantityrequested','date','bywhom'];

    public function recquesttable() {
        $query = "SELECT i.requestid, e.name, i.quantityrequested, i.date 
                  FROM inventoryrequest i
                  JOIN equipments e ON i.equipmentid = e.equipmentid
                  WHERE e.type = 'recreational'";
    
        return $this->query($query);
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
    
// ====================== DELETE FUNCTION =========================
public function deleteRequest($requestid) {
    $query = "DELETE FROM inventoryrequest WHERE requestid = :requestid";
    $result = $this->query($query, ['requestid' => $requestid]);

    if ($result) {
        return true;
    } else {
        error_log("Delete failed for requestid: $requestid"); // Log error
        return false;
    }
}

     

    
}

