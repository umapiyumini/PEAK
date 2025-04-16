<?php
class Facilities extends Controller {
    
    public function index() {
        // Create an instance of the Courts model and fetch all records
        $courts = (new Courts)->getAllCourts();  // Call the custom method we just defined
        
        // Pass the courts data to the view
        $this->view('external/facilities', ['courts' => $courts]);
    }
}

