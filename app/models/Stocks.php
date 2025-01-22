<?php
class Stocks{
    use Model;
    protected $table ='stock';

    public function findAllStocks() {
        $query = "
        SELECT stock.*, sport.sport_name AS sport_name, equipments.name AS eqpname
        FROM $this->table 
        LEFT JOIN equipments ON stock.equipmentid = equipments.equipmentid
        LEFT JOIN sport ON equipments.sport_id = sport.sport_id
        ";
        return $this->query($query);
    }

    //function to retriew records from equipmentid
    public function findStockByEquipmentId($equipmentId) {
        $query = "
        SELECT stock.*, sport.sport_name AS sport_name, equipments.name AS eqpname
        FROM $this->table 
        LEFT JOIN equipments ON stock.equipmentid = equipments.equipmentid
        LEFT JOIN sport ON equipments.sport_id = sport.sport_id
        WHERE stock.equipmentid = :equipmentid
        ";
        return $this->query($query, ['equipmentid' => $equipmentId]);
    }

    public function saveStockRecord($details){
        show("here2");
        $query="INSERT INTO $this->table(equipmentid,indent_no,description,unit,quantity,date) values(:equipmentid,:indent_no,:description,:unit,:quantity,:date)";
        return $this->query($query,['equipmentid' =>$details['equipmentid'], 'indent_no' =>$details['indentNo'], 'description' =>$details['description'], 'unit' =>$details['unit'], 'quantity' =>$details['quantity'], 'date' =>$details['date']]);
    }

    public function issueStockss($details) {
        $query = "UPDATE $this->table SET quantity = quantity - :issueQuantity WHERE stockid = :stockId";
        return $this->query($query, ['issueQuantity' => $details['issueQuantity'], 'stockId' => $details['stockId']]);
        
    }

    public function findEqpId($stockid) {
        $query = "SELECT equipmentid FROM $this->table WHERE stockid = :stockid";
        return $this->query($query, ['stockid' => $stockid])[0]['equipmentid'];
    }


}