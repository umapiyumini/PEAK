<?php
class Sport_Player{
    use Model;

    protected $table = 'sport_players';
    protected $allowed_columns = [
        'regno',
        'sport_id',
    ];

    public function findSportsByReg($regno){
        $query = "SELECT s.sport_id, s.sport_name, sp.regno FROM sport_players sp 
                  JOIN sport s ON sp.sport_id = s.sport_id 
                  WHERE sp.regno = :regno";
        $params = [':regno' => $regno];
        return $this->query($query, $params);
    }
}
?>