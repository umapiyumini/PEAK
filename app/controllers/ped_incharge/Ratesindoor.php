<?php
    class Ratesindoor extends Controller{
        public function index(){
         
            $courtsModel = new Courts();
            $indoorcourtsModel= new Indoorcourts();
            $rates = $indoorcourtsModel->getAllIndoorRates();

            foreach($rates as &$rate){
                $court = $courtsModel->getCourtById($rate->courtid);
                $rate->court_name = $court ? $court->name : '';
            }
            $this->view('ped_incharge/ratesindoor', ['rates'=>$rates]);

        }

        public function update_ground_price() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $courtid = $_POST['courtid'] ?? null;
                $event = $_POST['event'] ?? null;
                $duration = $_POST['duration'] ?? null;
                $price = $_POST['price'] ?? null;
        
                // Validate input as needed
        
                $indoorcourtsModel = new Indoorcourts();
                $indoorcourtsModel->updatePrice($courtid, $event, $duration, $price);
        
                // Redirect back to rates page (PRG pattern)
                header("Location: " . ROOT . "/ped_incharge/ratesindoor");
                exit;
            }
            // Optionally, handle GET or invalid requests
            header("Location: " . ROOT . "/ped_incharge/ratesindoor");
            exit;
        }
        
        
    
        
    }

    