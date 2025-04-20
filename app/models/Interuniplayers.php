<?php
class Interuniplayers{
    use Model;
    protected $table ='interuni_player';

    public function getParticipantsByTournamentId($tournamentId){
        $query = "SELECT regno FROM $this->table WHERE interrecordid = :tournamentId";
        $params = [':tournamentId' => $tournamentId];
        return $this->query($query, $params);
    }
}