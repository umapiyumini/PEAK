<?php
class PoolSettings{
    use Model;
    protected $table = 'pool_settings';

    public function findAllSettings(){
        $query = "SELECT * FROM $this->table ORDER BY setting_id DESC LIMIT 1"; 
        return $this->query($query);
    }

    public function saveSettings($data){
        $query = "INSERT INTO $this->table (student_limit, start_time, end_time) VALUES (:student_limit, :start_time, :end_time)";
        $params = [
            ':student_limit' => $data['studentLimit'],
            ':start_time' => $data['startTime'],
            ':end_time' => $data['endTime']
        ];
        return $this->query($query, $params);
    }
}

?>