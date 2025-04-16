<?php
class Sports_captain{
    use Model;

    protected $table = 'sports_captain';
    protected $allowed_columns = [
        'regno',
        'sport_id',
        'startdate',
        'enddate',
        'position',
    ];

   public function captainReg($data){
        $query = "INSERT INTO sports_captain (regno, userid, sport_id, startdate, enddate, position) VALUES (:regno, :userid, :sport_id, :startdate, :enddate, :position)";
        $params = [
            ':regno' => $data['regno'],
            ':userid' => $data['userid'],
            ':sport_id' => $data['sport'],
            ':startdate' => $data['assignedDate'],
            ':enddate' => $data['endDate'],
            ':position' => $data['position']
        ];
        return $this->query($query, $params);
    }

    public function captainByRegno($regno){
        $query = "SELECT * FROM $this->table WHERE regno = :regno";
        $params = [':regno' => $regno];
        return $this->query($query, $params);
    }
    public function getuserID($regno){
        $query = "SELECT userid FROM $this->table WHERE regno = :regno";
        $params = [':regno' => $regno];
        return $this->query($query, $params);
    }
}

?>
