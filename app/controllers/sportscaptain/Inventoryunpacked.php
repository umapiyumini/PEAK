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

        $requestModel = new Inventoryrequest();
        $requests = $requestModel->getPreviousRequests();

        // Pass the data to the view
        $this->view('sportscaptain/inventoryunpacked', ['unpackedItems' => $unpackedItems, 
        'requests' => $requests]);
    } 

    //edit quantity
    public function editquantity(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){


            $inventoryModel = new Unpackedinventory();
            $inventoryEditModel = new Inventoryedit();

            $equipmentid = $_POST['editid'];
            $newQuantity = $_POST['quantity'];

    
            $stockItem = $inventoryModel->get_by_id($equipmentid);
            if ($newQuantity > $stockItem->quantity) {
        
                    $_SESSION['error'] = "New quantity cannot exceed current stock!";
                    header('Location: ' . ROOT . '/sportscaptain/inventoryunpacked');
                    exit();
                    
    }
            
            $result = $inventoryEditModel->editQuantity(
                $_POST['name'],
                $_POST['date'],
                $_POST['quantity'],
                $_POST['reason']
            );

            if ($result) {
                echo "Success: Data updated!";
            } else {
                echo "Error: Data not updated!";
            }
        }
            header('Location:' . ROOT . '/sportscaptain/inventoryunpacked');
        }
    

    //add request
    public function addrequest(){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $requestModel = new Inventoryrequest();
            $result = $requestModel->addRequest();

            if ($result) {
                echo "Success: Data inserted!";
            } else {
                echo "Error: Data not inserted!";
            }
       
            } else {
                echo "Error: Invalid request method!";
            }
            header('Location:' . ROOT . '/sportscaptain/inventoryunpacked');
            exit;
    }

    public function editrequest(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $requestModel = new Inventoryrequest();
            $result = $requestModel->editRequest(
                $_POST['requestid'],
                $_POST['name'],
                $_POST['quantityrequested'],
                $_POST['timeframe'],
                $_POST['date']
            );

            if ($result) {
                echo "Success: Data updated!";
            } else {
                echo "Error: Data not updated!";
            }
        }
        header('location: ' .ROOT . '/sportscaptain/inventoryunpacked');
        exit();
    }

    
}


