<?php

class Equipments {
    use Model;

    protected $table = 'equipments';
    protected $allowed_columns = ['equipmentid','sport','name','type','issued_amount','description'];

    public function findAllEqpsTeam(){

        // $query = "SELECT * FROM $this->table"; 
        $query = "
        SELECT equipments.*, sport.sport_name AS sport_name 
        FROM $this->table 
        LEFT JOIN sport ON equipments.sport_id = sport.sport_id
        WHERE equipments.type='Team'
    ";
        
        return $this->query($query);
    }   
    public function findAllEqpsRecreational(){

        // $query = "SELECT * FROM $this->table"; 
        $query = "
        SELECT equipments.*, sport.sport_name AS sport_name 
        FROM $this->table 
        LEFT JOIN sport ON equipments.sport_id = sport.sport_id
        WHERE equipments.type='Recreational'
    ";
        
        return $this->query($query);
    } 

    public function saveEquipment($details){
        $query="INSERT INTO $this->table(name,sport_id,type) values(:name,:sport_id,:type)";
        return $this->query($query,['name' =>$details['name'], 'sport_id' =>$details['sport_id'], 'type' =>$details['type']]);
    }
   

    public function findOne($equipmentid) {
        $query = "SELECT equipments.*, sport.sport_name AS sport_name 
                FROM $this->table 
                LEFT JOIN sport ON equipments.sport_id = sport.sport_id
                WHERE equipments.equipmentid = :equipmentid";
        
        $data = $this->query($query, ['equipmentid' => $equipmentid]);
        return !empty($data) ? $data[0] : false;
    }

    public function updateEquipment($postdata) {
        $query = "UPDATE equipments SET name = :name, sport_id = :sport_id, type = :type 
                  WHERE equipmentid = :equipmentid";
        
        return $this->query($query, [
            'equipmentid' => $postdata['equipmentid'],
            'name' => $postdata['editname'], 
            'sport_id' => $postdata['editsport_id'],
            'type' => $postdata['edittype']
        ]);
    }

    public function removeEquipment($equipmentid) {
        $query = "DELETE FROM $this->table WHERE equipmentid = :equipmentid";
        return $this->query($query, ['equipmentid' => $equipmentid]);
    }
    
    
   

    
}