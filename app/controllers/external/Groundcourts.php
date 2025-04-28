<?php
class Groundcourts extends Controller{


    public function index() {
       
        $courts = (new Courts)->getCourtsByLocation('ground');
        
      
        $this->view('external/groundcourts', ['courts' => $courts]);
    }
    }

   




