<?php
class Staffinventory extends Controller{
   public function index(){

    $stockModel = new Unpackedinventory();
    $stock = $stockModel->getStocks();

    $requestModel = new Inventoryrequest();
    $requests = $requestModel->getAllRequests();

    
    $this->view('staff/staffinventory', ['stock' => $stock, 'requests' => $requests]);
   
    }

    public function editEquipment(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $inventoryModel = new Unpackedinventory();
            $inventoryEditModel = new Inventoryedit();
    
            $equipmentid = $_POST['equipmentid'];
            $newQuantity = (int)$_POST['quantity'];
            $reason = $_POST['reason'];
            $date = $_POST['date'];
    
            // Validate input
            if(empty($equipmentid) || empty($reason) || $newQuantity <= 0){ {
                $_SESSION['error'] = "Invalid input data!";
                header('Location: ' . ROOT . '/staff/staffinventory');
                exit();
            }
    
            // Get current stock item
            $stockItem = $inventoryModel->get_by_id($equipmentid);
            if (!$stockItem) {
                $_SESSION['error'] = "Equipment not found!";
                header('Location: ' . ROOT . '/staff/staffinventory');
                exit();
            }
    
            // Check if quantity is valid
            if ($newQuantity > $stockItem->issued_quantity) {
                $_SESSION['error'] = "New quantity cannot exceed current stock!";
                header('Location: ' . ROOT . '/staff/staffinventory');
                exit();
            }
            
            // Record the edit
            $result = $inventoryEditModel->editQuantity(
                $equipmentid,
                $date,
                $newQuantity,
                $reason
            );
    
            // Update the stock quantity
            if ($result) {
                // Calculate the new quantity
                $updatedQuantity = $stockItem->issued_quantity - $newQuantity;
                
                // Update the stock table
                $updateResult = $inventoryModel->updateEquipment($equipmentid, $updatedQuantity);
                
                if ($updateResult) {
                    $_SESSION['message'] = "Equipment quantity updated successfully!";
                } else {
                    $_SESSION['error'] = "Failed to update stock quantity!";
                }
            } else {
                $_SESSION['error'] = "Failed to record inventory edit!";
            }
    
            
            }

            
        }
        header('Location:' . ROOT . '/staff/staffinventory');
                exit();
    }
        
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
            header('Location:' . ROOT . '/staff/staffinventory');
        
            exit;
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
        header('Location:' . ROOT . '/staff/staffinventory');
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
        header('Location:' . ROOT . '/staff/staffinventory');
        exit();
    }


}