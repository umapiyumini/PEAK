<?php
class Groundcourts extends Controller{


    public function index() {
        // Fetch courts where the location is 'ground'
        $courts = (new Courts)->getCourtsByLocation('ground');
        
        // Pass the courts data to the view
        $this->view('external/groundcourts', ['courts' => $courts]);
    }
    }

   




