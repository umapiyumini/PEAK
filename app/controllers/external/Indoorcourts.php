<?php
class Indoorcourts extends Controller{


    public function index() {
        // Fetch courts where the location is 'ground'
        $courts = (new Courts)->getCourtsByLocation('indoor');
        
        // Pass the courts data to the view
        $this->view('external/indoorcourts', ['courts' => $courts]);
    }
    }

   




