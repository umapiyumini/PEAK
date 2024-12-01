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
}
