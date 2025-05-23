<?php

Trait Database {

    private function connect(){
        $string = "mysql:hostname=".DBHOST.";dbname=".DBNAME;
        $con = new \PDO($string,DBUSER,DBPASS);
        return $con;
    }

   
    
    // public function query($query, $data = []) {
    //     $con = $this->connect();
    //     $stm = $con->prepare($query);
    //     $check = $stm->execute($data);
    
    //     // Check if query is SELECT (or SHOW, DESCRIBE, etc.)
    //     if (preg_match('/^\s*(SELECT|SHOW|DESCRIBE|PRAGMA)/i', $query)) {
    //         $result = $stm->fetchAll(\PDO::FETCH_OBJ);
    //         return $result ?: []; // Always return array for SELECT
    //     }
    
       
    //     return $check;
    // }
    
 
    public function query($query, $data = []) {
        $con = $this->connect();
        $stm = $con->prepare($query);
        $check = $stm->execute($data);
    
        
        if (preg_match('/^\s*(SELECT|SHOW|DESCRIBE|PRAGMA)/i', $query)) {
            $result = $stm->fetchAll(\PDO::FETCH_OBJ);
            return $result ?: []; 
        }
        
    
        if (preg_match('/^\s*(UPDATE|DELETE)/i', $query)) {
            return $stm->rowCount() > 0;
        }
        
    
        return $check;
    }
    
    
     
     public function get_row($query, $data = []){
        $con = $this->connect();
        $stm = $con->prepare($query);

        $check = $stm->execute($data);
        if($check){
            $result = $stm->fetchAll(\PDO::FETCH_OBJ);
            if (is_array($result) && count($result)){
               return $result[0]; 
            }
        }
       return false;
    }


     
}
