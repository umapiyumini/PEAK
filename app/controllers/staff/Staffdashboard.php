<?php
class Staffdashboard extends Controller{
   public function index(){

    
    $unpackedinventory = new Unpackedinventory;
    $this->data['unpacked'] = $unpackedinventory->recreationaltable();
    $this->data['dropdown'] = $unpackedinventory->equipmentrequestdropdown();
   

    $inventoryrequest = new InventoryRequest;
    $this->data['request'] = $inventoryrequest->recquesttable();


    


    
    
   
   // Stop execution to see the output
 // Handle form submission for a new stock request
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $equipmentName = $_POST['name'];
    $quantityRequested = $_POST['quantityrequested'];

    // Call the createRequest method to insert the data
    $success = $inventoryrequest->createRequest($equipmentName, $quantityRequested);

    if ($success) {
        // Optionally, show a success message or redirect
        echo "<script type='text/javascript'>window.location.href = window.location.href;</script>";
    } else {
        // Show an error if something went wrong
        echo "Failed to create stock request.";
    }
}


  
    // Handle DELETE request
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_requestid'])) {
        $requestid = $_POST['delete_requestid'];
        $success = $inventoryrequest->deleteRequest($requestid);

        if ($success) {
            // Redirect or show success message
            echo "<script type='text/javascript'>window.location.href = window.location.href;</script>";
        } else {
            // Show an error if something went wrong
            echo "Failed to delete the request.";
        }
    }






   $this->view('staff/staffdashboard', $this->data);
      
    }


}