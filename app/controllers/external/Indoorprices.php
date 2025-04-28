<?php
class Indoorprices extends Controller {
    public function index() {
        $indoorcourtModel = new Indoorcourts();
        $courtModel = new Courts();

        $prices = $indoorcourtModel->query("SELECT * FROM indoorcourts");

        foreach ($prices as &$price) {
            $court = $courtModel->getCourtById($price->courtid);
            $price->court_name = $court ? $court->name : '';
            $price->court_image = $court ? $court->image : '';
        }

       
        $this->view('external/indoorprices', ['prices' => $prices]);
    }
}

   

