<?php

class  Inventoryedit {
    use Model;
    protected $table = 'inventoryedit';
    protected $fillable = ['editid','equipmentid', 'date','quantity','reason'];


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
    
    }
    
    
    
