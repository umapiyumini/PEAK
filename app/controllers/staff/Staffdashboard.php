<?php
class Staffdashboard extends Controller {
    public function index() {
        $unpackedinventory = new Unpackedinventory;
        $this->data['unpacked'] = $unpackedinventory->recreationaltable();
        $this->data['dropdown'] = $unpackedinventory->equipmentrequestdropdown();

    $inventoryrequest = new InventoryRequest;
    $this->data['request'] = $inventoryrequest->recquesttable();
    
    
   
   // Stop execution to see the output

    


   $this->view('staff/staffdashboard', $this->data);
      
    }


    

   
    
}






       

   
