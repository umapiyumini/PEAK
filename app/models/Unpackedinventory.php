<?php

class Unpackedinventory  {
    use Model;
    protected $table = 'unpackedinventory';
    protected $fillable = ['equipmentid','quantity'];

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


        //if (!isset($_SESSION['userid'])) {
            //die("User not logged in.");
        //}
    
        //$userId = $_SESSION['userid']; // Get the logged-in user's ID
    
        $query = "SELECT sport.sport_name, equipments.name,unpackedinventory.*
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

        $query = "SELECT equipments.name,inventoryrequest.* 
                  FROM sports_captain
                  JOIN sport ON sports_captain.sport_id = sport.sport_id
                  JOIN equipments ON equipments.sport_id = sport.sport_id
                  JOIN inventoryrequest ON inventoryrequest.requested_by = sports_captain.userid
                  WHERE sports_captain.userid = :userid";

        return $this->query($query, ['userid' => $userId]);

    }

    public function updateQuantity($name,$quantity,$reason){

        $query = "INSERT INTO inventoryedit (equipmentid,name, quantity, reason)
                VALUES (
                        (SELECT equipmentid FROM equipments WHERE name =:name),:name,:quantity,:reason)";
        
        return $this->query($query,['name' => $name, 'quantity' => $quantity, 'reason' => $reason]);
}   

    public function addRequest($timeframe,$name,$quantity,$addnotes){
        
        $userId = $this->getUserId();

        $query = "INSERT INTO inventoryrequest (equipmentid,name,quantityrequested,date,Timeframe,requested_by,additionalnotes)
                  VALUES (
                      (SELECT equipmentid FROM equipments WHERE name = :name),
                      :name,
                      :quantityrequested,
                      NOW(),
                      :Timeframe,
                      (SELECT userid FROM user WHERE userid = :userid),
                      :addnotes)";
        return $this->query($query,['name'=>$name, 'quantityrequested'=>$quantity,  'Timeframe'=>$timeframe, 'addnotes'=>$addnotes, 
        'userid'=>$userId]);
    }

}


