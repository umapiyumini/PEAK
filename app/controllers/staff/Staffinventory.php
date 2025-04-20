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

            $equipmentid = $_POST['editid'];
            $newQuantity = $_POST['quantity'];

    
            $stockItem = $inventoryModel->get_by_id($equipmentid);
            if ($newQuantity > $stockItem->quantity) {
        
                    $_SESSION['error'] = "New quantity cannot exceed current stock!";
                    header('Location: ' . ROOT . '/staff/staffinventory');
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
        

            header('Location:' . ROOT . '/staff/staffinventory');
        }
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

}