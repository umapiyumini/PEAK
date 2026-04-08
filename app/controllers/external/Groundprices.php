<?php
class Groundprices extends Controller {
    public function index() {
        $groundModel = new Groundcourts();
        $courtModel = new Courts();

        $rates = $groundModel->getAllGroundRates(); // All rates
        $courts = $courtModel->getAllCourts();      // All courts

        
        $courtMap = [];
        foreach ($courts as $court) {
            $courtMap[$court->courtid] = $court;
        }

        
        $ratesWithCourt = [];
        foreach ($rates as $rate) {
            $court = $courtMap[$rate->courtid] ?? null;
            if ($court) {
                $rate->courtname = $court->name;
                $rate->courtimage = $court->image;
            } else {
                $rate->courtname = 'Unknown';
                $rate->courtimage = null;
            }
            $ratesWithCourt[] = $rate;
        }

        $this->view('external/groundprices', ['rates' => $ratesWithCourt]);
    }
}

