<?php

class  Inventoryedit {
    use Model;
    protected $table = 'inventoryedit';
    protected $fillable = ['editid','equipmentid', 'date','quantity','reason'];


    public function editQuantity($name,$date,$quantity,$reason){

        $query = "INSERT INTO inventoryedit (equipmentid, date, quantity, reason)
                VALUES (
                        (SELECT equipmentid FROM equipments WHERE name =:name),:date,:quantity,:reason)";
        
        return $this->query($query,['name' => $name, 'date' =>$date, 'quantity' => $quantity, 'reason' => $reason]);
}
    }
    
    
    
