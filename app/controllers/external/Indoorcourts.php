<?php
class Indoorcourts extends Controller{


    public function index() {
        
        $courts = (new Courts)->getCourtsByLocation('indoor');
        

        $this->view('external/indoorcourts', ['courts' => $courts]);
    }
    }

   




