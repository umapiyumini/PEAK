<?php
class Staffdashboard extends Controller {
    public function index() {
        $unpackedinventory = new Unpackedinventory;
        $this->data['unpacked'] = $unpackedinventory->recreationaltable();
        $this->data['dropdown'] = $unpackedinventory->equipmentrequestdropdown();

        $inventoryrequest = new InventoryRequest;
        $this->data['request'] = $inventoryrequest->recquesttable();

        $this->view('staff/staffdashboard', $this->data);
    }

    public function updateEquipment() {
        // Get the POST data from the request
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['equipmentId']) && isset($data['quantity']) && isset($data['reason'])) {
            $equipmentId = $data['equipmentId'];
            $quantity = $data['quantity'];
            $reason = $data['reason'];

            // Update the database
            $unpackedinventory = new Unpackedinventory();
            $result = $unpackedinventory->updateQuantity($equipmentId, $quantity, $reason);

            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid data']);
        }
    


   $this->view('staff/staffdashboard', $this->data);
      
    }


    

   
    
}






       

   
