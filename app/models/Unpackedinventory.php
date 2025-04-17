<?php

class Unpackedinventory  {
    use Model;
    protected $table = 'stock';
    protected $fillable = ['stockid', 'equipmentid', 'indent_no', 'dscription', 'unit', 'quantity', 'issued_quantity', 'date'];

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
    

    public function updateEquipment($equipmentid, $quantity) {
        $query = "UPDATE stock SET quantity=:quantity
                  WHERE equipmentid = :equipmentid";
        
        return $this->query($query, [
            'equipmentid' => $equipmentid,
            'quantity' => $quantity 
       
        ]);

    }
    
    public function getunpackedItemsBySport() {
       
        $userId = $this->getUserId();

        if (!$userId) {
            die("User ID not found in session.");
        }

    
        $query = "SELECT sport.sport_id, equipments.name,stock.*
                  FROM sports_captain 
                  JOIN sport ON sports_captain.sport_id = sport.sport_id
                  JOIN equipments ON equipments.sport_id = sport.sport_id
                  JOIN stock on stock.equipmentid = equipments.equipmentid
                  WHERE sports_captain.userid = :userid";
    
        // Execute query and bind the userId parameter
        return $this->query($query, ['userid' => $userId]);
    }

    
    public function getStocks(){

        $query = "SELECT stock.*,equipments.name FROM stock 
                JOIN equipments ON stock.equipmentid = equipments.equipmentid";

        $result = $this->query($query);

        return $result;
    }

    public function get_by_id($id) {
        $query = "SELECT * FROM stock WHERE stockid = :id";

        $result = $this->query($query, ['id' => $id]);

        return $result;



    }

}


