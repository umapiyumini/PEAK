<?php 

class AttendenceExcusePlayers{

    use Model;
    protected $table = 'attendance_excuse_players';
    protected $allowcolumns = [
        'id',
        'excuse_id',
        'reg_no',
    ];

    public function getPlayersByExcuse($excuse_id){

        $query = "SELECT * FROM $this->table WHERE excuse_id = $excuse_id ";
        return $this->query($query);
    }




}