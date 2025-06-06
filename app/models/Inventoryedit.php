<?php

class  Inventoryedit {
    use Model;
    protected $table = 'inventoryedit';

    protected $fillable = ['editid','equipmentid','quantity','reason','date'];



    public function editQuantity($equipmentid, $date, $quantity, $reason) {
        $query = "INSERT INTO inventoryedit (equipmentid, date, quantity, reason)
                  VALUES (:equipmentid, :date, :quantity, :reason)";
        
        return $this->query($query, [
            'equipmentid' => $equipmentid, 
            'date' => $date, 
            'quantity' => $quantity, 
            'reason' => $reason
        ]);
    }
    
   


    public function getAllTeam() {
        $query = "SELECT $this->table.date, e.name, s.sport_name, $this->table.quantity, $this->table.reason FROM $this->table JOIN equipments e ON $this->table.equipmentid = e.equipmentid JOIN sport s ON s.sport_id = e.sport_id WHERE e.type = 'team'";
        return $this->query($query);
    }

    public function getAllRec() {
        $query = "SELECT $this->table.date, e.name, s.sport_name, $this->table.quantity, $this->table.reason FROM $this->table JOIN equipments e ON $this->table.equipmentid = e.equipmentid JOIN sport s ON s.sport_id = e.sport_id WHERE e.type = 'recreational'";
        return $this->query($query);
    }
    

    }
    
    
    
