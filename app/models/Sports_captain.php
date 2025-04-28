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

            // PLAYER 
        if (empty($data['regno'])) {
            $this->errors['regno'] = 'Registration number is required';
        } elseif (!$this->isPlayer($data['regno'])) {
            $this->errors['regno'] = 'This registration number does not belong to a registered player';
        }

        // SPORT_PLAYER 
        if (empty($data['sport'])) {
            $this->errors['sport'] = 'Sport selection is required';
        } elseif (!$this->isSportPlayer($data['regno'], $data['sport'])) {
            $this->errors['sport'] = 'This player is not registered for the selected sport';
        }

        // DATE validation
        if (empty($data['assignedDate']) || empty($data['endDate'])) {
            $this->errors['date'] = 'Both assigned date and end date are required';
        } else {
            $start = new DateTime($data['assignedDate']);
            $end = new DateTime($data['endDate']);
            $interval = $start->diff($end);
            if ($interval->y < 1) {
                $this->errors['date'] = 'End date must be at least 1 year after assigned date';
            }
        }

        if (!empty($this->errors)) {
            return false;
        }

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

    public function validate($data){

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

    public function getAllBySport($sportid) {
        $query = "SELECT * FROM $this->table JOIN user ON user.userid = $this->table.userid WHERE sport_id = $sportid";
        return $this->query($query);
    }
}

?>
