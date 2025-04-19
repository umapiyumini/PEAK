<?php

Trait Model {

    use Database;

    
    protected $limit = 10;
    protected $offset = 0;
    protected $order_type = "desc";
    protected $order_column = "userid";
    // protected $errors = [];

    function test(){
        $query= "SELECT * FROM user";
        $result = $this->query($query);
        show($result);
    }

    
    // where
    public function where($data,$data_not = []){
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";
        foreach($keys as $key){
            $query .= $key . " = :".$key . "&&";

        }

        foreach($keys_not as $key){
            $query .= $key . " != :".$key . "&&";

        }

        $query = trim($query," && ");

        $query .= "order by $this->order_column $this->order_type  limit $this->limit offset $this->offset"; 

        $data = array_merge($data,$data_not);
        return $this->query($query,$data);
    }

    // findAll
    public function findAll(){

        $query = "SELECT * FROM $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset"; 

        
        return $this->query($query);
    }


    // first
    public function first($data, $data_not = []){
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";
        foreach($keys as $key){
            $query .= $key . " = :".$key . "&&";

        }

        foreach($keys_not as $key){
            $query .= $key . " != :".$key . "&&";

        }

        $query = trim($query," && ");

        $query .= " limit $this->limit offset $this->offset"; 

        $data = array_merge($data,$data_not);
        $result = $this->query($query,$data);
        if($result)
            return $result[0];

        return false;
    }

    // insert
    public function insert($data){

         //remove unwanted data
         if(!empty($this->allowed_columns)){
            foreach($data as $key => $value){
                if(!in_array($key,$this->allowed_columns)){
                    unset($data[$key]);
        
                }
            }
        }
        
        $keys = array_keys($data);

        $query = "INSERT INTO $this->table (".implode(",",$keys).") VALUES (:".implode(",:",$keys).") ";
        $this->query($query,$data);
        return false;
        

    }

    // update
    public function update($id,$data,$id_column='userid'){

        //remove unwanted data
        if(!empty($this->allowed_columns)){
            foreach($data as $key => $value){
                if(!in_array($key,$this->allowed_columns)){
                    unset($data[$key]);
        
                }
            }
        }
        $keys = array_keys($data);
        
        $query = "UPDATE $this->table SET    ";
        foreach($keys as $key){
            $query .= $key . " = :".$key . ",";

        }

       

        $query = trim($query,", ");

        $query .= " WHERE $id_column = :$id_column "; 

        $data[$id_column] = $id;
        
        // echo $query;
        $this->query($query,$data);
        return false;
    }

    // delete 
    public function delete($id, $id_column='userid'){
        $data[$id_column] = $id;
        $query = "DELETE  FROM $this->table WHERE $id_column = :$id_column ";
        
        $this->query($query,$data);
        return false;

    }

    public function getUserId(){
        if(!isset($_SESSION['userid'])){
            die("user not logged in");

        }
        return $_SESSION['userid'];
    }


    //FOR NOW
    public function executeQuery($query, $data = []) {
        $con = $this->connect();
        $stm = $con->prepare($query);
    
        if ($stm->execute($data)) {
            return true; // Query executed successfully
        } else {
            // Output detailed error message
            echo "SQL Error: " . implode(", ", $stm->errorInfo());
            return false;
        }
    }

    public function lastInsertId() {
        $result = $this->query("SELECT LAST_INSERT_ID()");
        return $result[0]->{"LAST_INSERT_ID()"};
    }
    

}

//for now

