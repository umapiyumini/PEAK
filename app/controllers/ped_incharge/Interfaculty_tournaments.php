<?php
class Interfaculty_tournaments extends Controller {
    public function index() {   
        $interfacultymodel = new TournamentRecord();
        $tournamentplaceModel = new TournamentPlaces();
        $tournamentPlayerModel = new TournamentPlayers(); 
        
        $tournaments = $interfacultymodel->findInterfacultyRecords();
        $freshers = $interfacultymodel-> findFreshersRecords();
        $interfacultyrecords = array(); 
        $freshersrecords = array(); 

        foreach($tournaments as $tournament) {
            // Get places for this tournament
            $places = $tournamentplaceModel->finddd($tournament);
            
            if ($places) {
                // Create an array to store tournament data with places
                $tournamentData = [
                    'tournament_info' => $tournament,
                    'places' => []
                ];
                
                // Add each place to the tournament data
                foreach($places as $place) {
                    $tournamentData['places'][$place->place] = $place;
                    
                    // Get players for this place (you'll need to implement this method)
                    $players = $tournamentPlayerModel->findPlayersByPlaceId($place->placeid);
                    $tournamentData['places'][$place->place]->players = $players;
                }
                
                $interfacultyrecords[] = $tournamentData;
            }
        }

        foreach($freshers as $tournament) {
            // Get places for this tournament
            $places = $tournamentplaceModel->finddd($tournament);
            
            if ($places) {
                // Create an array to store tournament data with places
                $tournamentData = [
                    'tournament_info' => $tournament,
                    'places' => []
                ];
                
                // Add each place to the tournament data
                foreach($places as $place) {
                    $tournamentData['places'][$place->place] = $place;
                    
                    // Get players for this place (you'll need to implement this method)
                    $players = $tournamentPlayerModel->findPlayersByPlaceId($place->placeid);
                    $tournamentData['places'][$place->place]->players = $players;
                }
                
                $freshersrecords[] = $tournamentData;
            }
        }
        
        $this->view('ped_incharge/interfaculty_tournaments', ['interfacultyrecords' => $interfacultyrecords, 'freshersrecords' => $freshersrecords]);
    }
}