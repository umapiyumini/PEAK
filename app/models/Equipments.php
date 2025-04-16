<?php
class Equipments{
    use Model;
    protected $table ='equipments';
    protected $allowed_columns = ['equipmentid','sport','name','type','issued_amount','description'];

    public function findAllEqpsTeam(){

        // $query = "SELECT * FROM $this->table"; 
        $query = "
        SELECT 
            equipments.*, 
            sport.sport_name AS sport_name, 
            COALESCE(SUM(stock.quantity * stock.unit), 0) AS available,
            COALESCE(SUM(stock.issued_quantity * stock.unit), 0) AS issued
        FROM 
            $this->table 
        LEFT JOIN 
            sport ON equipments.sport_id = sport.sport_id
        LEFT JOIN 
            stock ON equipments.equipmentid = stock.equipmentid
        WHERE 
            equipments.type = 'Team'
        GROUP BY 
            equipments.equipmentid, sport.sport_name
    ";
        
        return $this->query($query);
    }   
    public function findAllEqpsRecreational(){

        // $query = "SELECT * FROM $this->table"; 
        $query = "
        SELECT 
            equipments.*, 
            sport.sport_name AS sport_name, 
            COALESCE(SUM(stock.quantity * stock.unit), 0) AS available,
            COALESCE(SUM(stock.issued_quantity * stock.unit), 0) AS issued
        FROM 
            $this->table 
        LEFT JOIN 
            sport ON equipments.sport_id = sport.sport_id
        LEFT JOIN 
            stock ON equipments.equipmentid = stock.equipmentid
        WHERE 
            equipments.type = 'Recreational'
        GROUP BY 
            equipments.equipmentid, sport.sport_name
    ";
        
        return $this->query($query);
    } 

    public function saveEquipment($details){
        $query="INSERT INTO $this->table(name,sport_id,type,description) values(:name,:sport_id,:type,:description)";
        return $this->query($query,['name' =>$details['name'], 'sport_id' =>$details['sport_id'], 'type' =>$details['type'], 'description' =>$details['description']]);
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
        $query = "UPDATE equipments SET name = :name, sport_id = :sport_id, type = :type, description = :description 
                  WHERE equipmentid = :equipmentid";
        
        return $this->query($query, [
            'equipmentid' => $postdata['equipmentid'],
            'name' => $postdata['editname'], 
            'sport_id' => $postdata['editsport_id'],
            'type' => $postdata['edittype'],
            'description' => $postdata['editdescription']
        ]);
    }

    public function removeEquipment($equipmentid) {
        $query = "DELETE FROM $this->table WHERE equipmentid = :equipmentid";
        return $this->query($query, ['equipmentid' => $equipmentid]);
    }


    public function teamtable(){
        $query = "SELECT e.*, 
                         (SELECT COALESCE(SUM(stock.issued_quantity * stock.unit), 0) 
                          FROM stock
                          WHERE stock.equipmentid = e.equipmentid) as issued_quantity, 
                         s.sport_name, 
                         COALESCE(ined.quantity, 0) as damaged_quantity, 
                         COALESCE(
                             ( 
                                 (SELECT COALESCE(SUM(stock.issued_quantity * stock.unit), 0) 
                                  FROM stock
                                  WHERE stock.equipmentid = e.equipmentid) 
                                 - COALESCE(ined.quantity, 0)
                             ), 0) as remaining_quantity
                  FROM $this->table e 
                  JOIN sport s ON e.sport_id = s.sport_id
                  LEFT JOIN inventoryedit ined ON ined.equipmentid = e.equipmentid
                  WHERE e.type = 'team'";
    
        return $this->query($query);
    }
    

    public function rectable(){
        $query = "SELECT e.*, 
                         (SELECT COALESCE(SUM(stock.issued_quantity * stock.unit), 0) 
                          FROM stock
                          WHERE stock.equipmentid = e.equipmentid) as issued_quantity, 
                         s.sport_name, 
                         COALESCE(ined.quantity, 0) as damaged_quantity, 
                         COALESCE(
                             ( 
                                 (SELECT COALESCE(SUM(stock.issued_quantity * stock.unit), 0) 
                                  FROM stock
                                  WHERE stock.equipmentid = e.equipmentid) 
                                 - COALESCE(ined.quantity, 0)
                             ), 0) as remaining_quantity
                  FROM $this->table e 
                  JOIN sport s ON e.sport_id = s.sport_id
                  LEFT JOIN inventoryedit ined ON ined.equipmentid = e.equipmentid
                  WHERE e.type = 'recreational'";
    
        return $this->query($query);
    }
 
}
