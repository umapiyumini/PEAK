<?php

class Inventoryrequest {
    use Model;

    protected $table = 'inventoryrequest';
    protected $fillable = ['requestid','equipmentid','quantityrequested','date','bywhom'];

    public function recquesttable(){
        $query = "SELECT e.name,i.quantityrequested,i.date FROM inventoryrequest i
                    JOIN equipments e ON i.equipmentid = e.equipmentid
                    WHERE e.type = 'recreational' ";

        // $data = ['equipmentid' => $equipmentid];
        return $this->query($query);
    }



     

    
}