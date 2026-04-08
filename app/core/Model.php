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

    

    // public function where($data,$data_not = []){
    //     $keys = array_keys($data);
    //     $keys_not = array_keys($data_not);
    //     $query = "SELECT * FROM $this->table WHERE ";
    //     foreach($keys as $key){
    //         $query .= $key . " = :".$key . "&&";

    // public function where($data,$data_not = []){
    //     $keys = array_keys($data);
    //     $keys_not = array_keys($data_not);
    //     $query = "SELECT * FROM $this->table WHERE ";
    //     foreach($keys as $key){
    //         $query .= "$key = :$key AND ";




    //      }


    //     foreach($keys_not as $key){
    //         $query .= $key . " != :".$key . "&&";

    //     }

    //     $query = trim($query," && ");

    //     $query .= "order by $this->order_column $this->order_type  limit $this->limit offset $this->offset"; 

    
        // foreach($keys_not as $key){
        //     $query .= "$key != :$key AND ";


    //     $data = array_merge($data,$data_not);
    //     return $this->query($query,$data);
    // }

    //new where function
    public function where($data, $options = []) {
        $conditions = [];
        $params = [];
        
        foreach ($data as $key => $value) {
            // Check if the key contains an operator
            if (preg_match('/(>=|<=|>|<|!=)/', $key, $matches)) {
                $operator = $matches[0];
                $cleanKey = str_replace($operator, '', $key);
                $paramKey = str_replace(['>', '<', '=', ' '], '', $key);
                $conditions[] = "$cleanKey $operator :$paramKey";
            } else {
                // Regular equality condition
                $conditions[] = "$key = :$key";
                $paramKey = $key;
            }
            $params[':' . str_replace(['>', '<', '=', ' '], '', $paramKey)] = $value;
        }


        $query = "SELECT * FROM $this->table";
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        // Only add ordering if specifically requested in options
        if (!empty($options['order_by'])) {
            $order_column = $options['order_by'];
            $order_type = $options['order_type'] ?? 'ASC';  // Default to ASC if not specified
            $query .= " ORDER BY " . $order_column . " " . $order_type;
        }
    
        // Only add limit if specifically requested in options
        if (!empty($options['limit'])) {
            $query .= " LIMIT " . (int)$options['limit'];
        
            // Only add offset if limit is present and offset is specified
            if (!empty($options['offset'])) {
                $query .= " OFFSET " . (int)$options['offset'];
            }
        }

        $query = rtrim($query, " AND ");


         $query .= " ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";


        return $this->query($query, $params);
    }

    
    public function findAll(){

        $query = "SELECT * FROM $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset"; 

        
        return $this->query($query);
    }


    
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

    
    public function insert($data){
    
        if(!empty($this->allowed_columns)){
            foreach($data as $key => $value){
                if(!in_array($key,$this->allowed_columns)){
                    unset($data[$key]);
                }
            }
        }
        
        $keys = array_keys($data);
    
        $query = "INSERT INTO $this->table (".implode(",",$keys).") VALUES (:".implode(",:",$keys).") ";
        return $this->query($query, $data);
    }
    

   
    
    public function update($id,$data,$id_column='userid'){

        
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


    
    public function executeQuery($query, $data = []) {
        $con = $this->connect();
        $stm = $con->prepare($query);
    
        if ($stm->execute($data)) {
            return true; 
        } else {
        
            echo "SQL Error: " . implode(", ", $stm->errorInfo());
            return false;
        }
    }

    public function lastInsertId() {
        $result = $this->query("SELECT LAST_INSERT_ID()");
        return $result[0]->{"LAST_INSERT_ID()"};
    }
    

}



        