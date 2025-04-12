<?php

class Unpackedinventory  {
    use Model;
    protected $table = 'unpackedinventory';
    protected $fillable = ['equipmentid','quantity','incharge', 'availability'];

    private function getUserId() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['userid'])) {
            die("User not logged in.");
        }
        return $_SESSION['userid'];
    }

    public function recreationaltable(){
        $query = "SELECT e.name, u.quantity ,u.equipmentid
                  FROM unpackedinventory u 
                  JOIN equipments e ON u.equipmentid = e.equipmentid
                  WHERE e.type = 'recreational' ";

        return $this->query($query);
    }

    public function equipmentrequestdropdown(){
        $query = "SELECT e.name 
                  FROM unpackedinventory u 
                  JOIN equipments e ON u.equipmentid = e.equipmentid
                  WHERE e.type = 'recreational' ";

        return $this->query($query);
    }
    

    public function updateEquipment($postdata) {
        $query = "UPDATE unpackedinventory SET quantity=:quantity
                  WHERE equipmentid = :equipmentid";
        
        return $this->query($query, [
            'equipmentid' => $postdata['equipmentid'],
            'quantity' => $postdata['editquantity'], 
       
        ]);

    }
    
    public function getunpackedItemsBySport() {
       
        
        
        $userId = $this->getUserId();

        if (!$userId) {
            die("User ID not found in session.");
        }

    
        $query = "SELECT sport.sport_id, equipments.name,unpackedinventory.*
                  FROM sports_captain 
                  JOIN sport ON sports_captain.sport_id = sport.sport_id
                  JOIN equipments ON equipments.sport_id = sport.sport_id
                  JOIN unpackedinventory on unpackedinventory.equipmentid = equipments.equipmentid
                  WHERE sports_captain.userid = :userid";
    
        // Execute query and bind the userId parameter
        return $this->query($query, ['userid' => $userId]);
    }

    public function getPreviousRequests(){

        $userId = $this->getUserId();
        if (!$userId) {
            die("User ID not found in session.");
        }

        $query = "SELECT equipments.name,inventoryrequest.* 
                  FROM sports_captain
                  JOIN sport ON sports_captain.sport_id = sport.sport_id
                  JOIN equipments ON equipments.sport_id = sport.sport_id
                  JOIN inventoryrequest ON inventoryrequest.requested_by = sports_captain.userid
                  WHERE sports_captain.userid = :userid";

        return $this->query($query, ['userid' => $userId]);

    }

    public function updateQuantity($name,$quantity,$reason){

        $query = "INSERT INTO inventoryedit (equipmentid, quantity, reason)
                VALUES (
                        (SELECT equipmentid FROM equipments WHERE name =:name),:quantity,:reason)";
        
        return $this->query($query,['name' => $name, 'quantity' => $quantity, 'reason' => $reason]);
}   

    public function addRequest(){
        
        $userId = $this->getUserId();

        $query = "INSERT INTO inventoryrequest (equipmentid,sport_id,quantityrequested,date,timeframe,requested_by,addnotes)
                  VALUES (
                      (SELECT equipmentid FROM equipments WHERE name = :name),
                      (SELECT sport_id FROM sports_captain WHERE sport_id = :sport_id),
                      :quantityrequested,
                      NOW(),
                      :Timeframe,
                      (SELECT userid FROM user WHERE userid = :userid),
                      :addnotes)";
        return $this->query($query);
    }

}


