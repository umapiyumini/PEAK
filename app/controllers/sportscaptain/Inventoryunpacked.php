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

            $equipmentid = $_POST['equipmentid'];
            $newQuantity = $_POST['quantity'];

    
            $stockItem = $inventoryModel->get_by_id($equipmentid);
            if ($newQuantity > $stockItem->quantity) {
        
                    $_SESSION['error'] = "New quantity cannot exceed current stock!";
                    header('Location: ' . ROOT . '/sportscaptain/inventoryunpacked');
                    exit();
                    
    }
            
            $result = $inventoryEditModel->editQuantity(
                $_POST['equipmentid'],
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

    public function addrequestnew() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $quantityrequested = $_POST['quantityrequested'];
            $timeframe = $_POST['timeframe'];
            $userId = $_SESSION['user_id'];
            $addnotes = $_POST['addnotes'];
    
            try {
                $requests = [];
    
                for ($i = 0; $i < count($name); $i++) {
                    $requests[] = [
                        'name' => $name[$i],
                        'quantityrequested' => $quantityrequested[$i],
                        'timeframe' => $timeframe,
                        'userId' => $userId,
                        'addnotes' => $addnotes
                    ];
                }
            
                $requestModel = new Inventoryrequest();
                $result = $requestModel->addRequest($requests);
    
                if ($result) {
                    $_SESSION['success'] = "Request successfully submitted!";
                } else {
                    $_SESSION['error'] = "Error: Request could not be processed!";
                }
            } catch(Exception $e) {
                $_SESSION['error'] = "Error: " . $e->getMessage();
            }
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

    public function deleterequest(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $requestModel = new Inventoryrequest();
            $requestId = $_POST['requestid'];
            
            $result = $requestModel->deleteRequest($requestId);
            
            if ($result) {
                echo "Success: Request deleted!";
            } else {
                echo "Error: Request not deleted!";
            }
        } else {
            echo "Error: Invalid request method!";
        }
        header('location: ' .ROOT . '/sportscaptain/inventoryunpacked');
        exit();
    }
}

    



