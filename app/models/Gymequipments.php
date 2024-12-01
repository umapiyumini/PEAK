<?php

class Gymequipments {
    use Model;

    protected $table = 'gymequipments';
    protected $fillable = ['gymequipmentid ','equipmentname','quantity','description'];
    

    

   
    public function gymequipmentstable(){
        $query = "SELECT gymequipmentid, equipmentname, quantity, description
                  FROM gymequipments ";

        return $this->query($query);
    }



    public function deletegymequipment($gymequipmentid) {
        $query = "DELETE FROM gymequipments WHERE gymequipmentid = :gymequipmentid"; // Correct table name
        $result = $this->query($query, ['gymequipmentid' => $gymequipmentid]);
    
        if ($result) {
            return true;
        } else {
            error_log("Delete failed for gym equipmentid: $gymequipmentid"); // Log error
            return false;
        }
    }
    
    public function addgymequipment($data){
        $sql = "INSERT INTO gymequipments (gymequipmentname,quantity,description) VALUES (:gymequipmentname, :quantity, :description)";
        return $this->query($sql, $data);
    }


    public function updateEquipment($postdata) {
        $query = "UPDATE gymequipments SET equipmentname=:equipmentname, quantity=:quantity, description=:description
                  WHERE gymequipmentid = :gymequipmentid";
        
        return $this->query($query, [
            'gymequipmentid' => $postdata['gymequipmentid'],
            'equipmentname' => $postdata['editname'],
            'quantity' => $postdata['editquantity'],
            'description' => $postdata['editdescription'], 
       
        ]);

    }

    //add
    public function saveEquipment($details){
        $query="INSERT INTO $this->table(equipmentname,quantity,description) values(:equipmentname,:quantity,:description)";
        return $this->query($query,['equipmentname' =>$details['equipmentname'], 'quantity' =>$details['quantity'], 'description' =>$details['description']]);
    }

  

   
    
}