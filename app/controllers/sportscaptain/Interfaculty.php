<?php

class Interfaculty extends Controller
{
    public function index()
    {
        // Get tournament records
        $tournamentModel = new TournamentRecord();
        $tournaments = $tournamentModel->getInterfacultyRecords();

        // Get tournament places
        $placeModel = new TournamentPlaces();
        foreach ($tournaments as $tournament) {
            $places = $placeModel->getTournamentPlaces($tournament->recordid);

            // Default values
            $tournament->first_place_faculty = 'N/A';
            $tournament->second_place_faculty = 'N/A';
            $tournament->third_place_faculty = 'N/A';

            // Assign faculties based on place
            if (!empty($places)) {
                foreach ($places as $place) {
                    if ($place->place == '1') {
                        $tournament->first_place_faculty = $place->faculty_name;
                    } elseif ($place->place == '2') {
                        $tournament->second_place_faculty = $place->faculty_name;
                    } elseif ($place->place == '3') {
                        $tournament->third_place_faculty = $place->faculty_name;
                    }
                }
            }
        }

        // Get all faculties
        $facultyModel = new Faculties();
        $faculties = $facultyModel->getAllFaculties();

        // Pass tournaments and faculties to the view
        $this->view('sportscaptain/interfaculty', ['tournaments' => $tournaments, 'faculties' => $faculties]);
    }

    public function addrecord()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Retrieve POST data
            $year = $_POST['year'];
            $sportID = $_POST['sport-id'];
            $tournament_name = $_POST['tournament_name'];
            $category = $_POST['category'];

                // Add tournament record
                $recordModel = new TournamentRecord();
                $tournament = $recordModel->addTournament($year, $sportID, $tournament_name, $category);
    
                if ($tournament) {
                    // Get the last inserted tournament ID
                    $tournamentId = $recordModel->getLastId();
                    
                    // Add places for the tournament
                    $facultyModel = new Faculties();
                    $faculties = $facultyModel->getAllFaculties();
                    
                    // Initialize TournamentPlaces model
                    $placeModel = new TournamentPlaces();
                    
                    // Check if place data is submitted
                    if (isset($_POST['place']) && is_array($_POST['place'])) {
                        foreach ($_POST['place'] as $place => $faculty_id) {
                            if (!empty($faculty_id)) {
                                $placeModel->addTournamentPlaces($tournamentId, $place,$faculty_id);
                            }
                        }
                    }
                }
               
            $_SESSION['success'] = 'Tournament record and places added successfully.';
            
            header('Location: ' . ROOT . '/sportscaptain/interfaculty');
            exit();
        }
    }

    public function addplayers()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Retrieve POST data
            $tournament_id = $_POST['tournament_id'];
            $faculty_id = $_POST['faculty_id'];

            // Fetch temp players
            $tempModel = new Tempplayers();
            $tempPlayers = $tempModel->getPlayers($tournament_id, $faculty_id);

            // Get place ID
            $placeModel = new TournamentPlaces();
            $place_id = $placeModel->getTournamentPlaces($tournament_id);

            // Add players
            $playersModel = new TournamentPlayers();
            foreach ($tempPlayers as $player) {
                $playersModel->addPlayer($place_id, $player->reg_no);
            }

            $_SESSION['success'] = 'Players added successfully.';
            header('Location: ' . ROOT . '/sportscaptain/interfaculty');
            exit();
        }
    }

    public function deleterecord(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Retrieve POST data
            $tournament_id = $_POST['tournament_id'];

            // Delete tournament record
            $recordModel = new TournamentRecord();
            $recordModel->deleteRecord($tournament_id);

            $_SESSION['success'] = 'Tournament record deleted successfully.';
            header('Location: ' . ROOT . '/sportscaptain/interfaculty');
            exit();
        }
    }
}
