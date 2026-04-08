<?php
    class Rates extends Controller{
        public function index(){
            
     

            $groundcourtsModel = new Groundcourts();
            $courtsModel = new Courts();
            $prices = $groundcourtsModel->getAllGroundRates();
            

           
            foreach ($prices as &$price) {
                $court = $courtsModel->getCourtById($price->courtid);
                $price->court_name = $court ? $court->name : '';
                
            }

            
            $this->view('ped_incharge/rates', ['prices' => $prices]);

        }


        public function update_ground_price() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $courtid = $_POST['courtid'] ?? null;
                $event = $_POST['event'] ?? null;
                $duration = $_POST['duration'] ?? null;
                $description = $_POST['description'] ?? null;
                $price = $_POST['price'] ?? null;
        
            
        
                $groundcourtsModel = new Groundcourts();
                $groundcourtsModel->updatePrice($courtid, $event, $duration, $description, $price);
        
               
                header("Location: " . ROOT . "/ped_incharge/rates");
                exit;
            }
       
            header("Location: " . ROOT . "/ped_incharge/rates");
            exit;
        }
        


    
       
    }

    