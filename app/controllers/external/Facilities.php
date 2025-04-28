<?php
class Facilities extends Controller {
    
    public function index() {
       
        $courts = (new Courts)->getAllCourts();  
        
        
        $this->view('external/facilities', ['courts' => $courts]);
    }
}

