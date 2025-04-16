<?php
class Players {
    use Model;

    protected $table = 'players';

    public function playerByRegno($regno) {
        $query = "SELECT * FROM $this->table WHERE regno = :regno";
        $params = [':regno' => $regno];
        return $this->query($query, $params);
    }
}
?>