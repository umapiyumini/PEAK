<?php
class Staffdashboard extends Controller {

    public function index() {
        // Create an instance of the Unpackedinventory model
        $unpackedinventory = new Unpackedinventory();
        
        // Fetch data for the unpacked inventory and dropdown for equipment request
        $this->data['unpacked'] = $unpackedinventory->recreationaltable();
        $this->data['dropdown'] = $unpackedinventory->equipmentrequestdropdown();

        // Create an instance of the InventoryRequest model
        $inventoryrequest = new InventoryRequest();
        $this->data['request'] = $inventoryrequest->recquesttable();

        // Handle form submission for a new stock request
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'], $_POST['quantityrequested'])) {
            $equipmentName = $_POST['name'];
            $quantityRequested = $_POST['quantityrequested'];

            // Call the createRequest method to insert the data
            $success = $inventoryrequest->createRequest($equipmentName, $quantityRequested);

            if ($success) {
                // Reload the page if the request is successful
                echo "<script type='text/javascript'>window.location.href = window.location.href;</script>";
            } else {
                echo "Failed to create stock request.";
            }
        }

        // Handle DELETE request for inventory request
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_requestid'])) {
            $requestid = $_POST['delete_requestid'];
            $success = $inventoryrequest->deleteRequest($requestid);

            if ($success) {
                echo "<script type='text/javascript'>window.location.href = window.location.href;</script>";
            } else {
                echo "Failed to delete the request.";
            }
        }

        // Load the staffdashboard view with the data
        $this->view('staff/staffdashboard', $this->data);
       
    }


    public function editEquipment(){
        $eqpmodel = new Unpackedinventory();

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            // $equipmentid = $_POST['equipmentid'];
            $eqpmodel->updateEquipment($_POST);
            header('Location:' . ROOT . '/staff/staffdashboard');
        }
    }

    


            
           
        


}
    


