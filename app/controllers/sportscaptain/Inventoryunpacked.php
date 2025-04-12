<?php
class Inventoryunpacked extends Controller {
    public function index() {
        // Ensure the session is started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

      

        // Initialize the model and fetch unpacked items
        $inventoryModel = new Unpackedinventory();
        $unpackedItems = $inventoryModel->getunpackedItemsBySport();
        $inventoryrequests = $inventoryModel->getPreviousRequests();

        // Pass the data to the view
        $this->view('sportscaptain/inventoryunpacked', ['unpackedItems' => $unpackedItems, 
        'inventoryrequests' => $inventoryrequests]);
    } 

    //edit quantity
    public function editQuantity(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            // $equipmentid = $_POST['equipmentid'];
            $inventoryModel = new Unpackedinventory();
            
            $inventoryModel->updateQuantity(
                $_POST['name'],
                $_POST['quantity'],
                $_POST['reason']);
            header('Location:' . ROOT . '/sportscaptain/inventoryunpacked');
        }
    }

    //add request
    public function addrequest(){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            print_r($_POST);
            $inventoryModel = new Unpackedinventory();  
            $result=$inventoryModel->addRequest(
                $_POST['equipmentid'],
                $_POST['sport_id'],
                $_POST['date'],
                $_POST['timeframe'],
                $_POST['name'],
                $_POST['quantityrequested'],
                $_POST['requested_by'],
                $_POST['addnotes']
            );

            if ($result) {
                echo "Success: Data inserted!";
            } else {
                echo "Error: Data not inserted!";
            }

            header('Location:' . ROOT . '/sportscaptain/inventoryunpacked');
            exit;
    } else {
        echo "Error: Invalid request method!";
        }
        
    }
}


