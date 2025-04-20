<?php
class Indoorprices extends Controller {
    public function index() {
        $indoorcourtModel = new Indoorcourts();
        $courtModel = new Courts();

        // Fetch all price entries
        $prices = $indoorcourtModel->query("SELECT * FROM indoorcourts");

        // Enrich each price entry with court details
        foreach ($prices as &$price) {
            $court = $courtModel->getCourtById($price->courtid);
            $price->court_name = $court ? $court->name : '';
            $price->court_image = $court ? $court->image : '';
        }

        // Pass the array to the view
        $this->view('external/indoorprices', ['prices' => $prices]);
    }
}

   

