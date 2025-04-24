<?php
class Ped_events{
    use Model;

    protected $table = 'ped_events';
    protected $allowed_columns = [
        'eventID',
        'title',
        'date',
        'time',
        'venue',
    ];



    public function findallEvents(){
        $query = "SELECT * FROM $this->table";
        $result = $this->query($query);
        return $result;
    }

    public function addEvent($data){
        $query = "INSERT INTO $this->table (title, date, time, venue) VALUES (:title, :date, :time, :venue)";
        $params = [
            ':title' => $_POST['title'],
            ':date' => $_POST['eventDate'],
            ':time' => $_POST['time'],
            ':venue' => $_POST['venue']
        ];
        return $this->query($query, $params);
    }

    public function deleteEvent($id){
        $query = "DELETE FROM $this->table WHERE eventID = :eventID";
        $params = [
            ':eventID' => $id
        ];
        return $this->query($query, $params);
    }
}
?>