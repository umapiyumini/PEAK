<?php
class Staffdashboard extends Controller {

    public function index() {

        $stockModel = new Unpackedinventory();
        $stock = $stockModel->getStocks();

        $requestModel = new Inventoryrequest();
        $requests = $requestModel->getAllRequests();

        
        $this->view('staff/staffdashboard', ['stock' => $stock, 'requests' => $requests]);
       
    }


    public function editEquipment(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $stockModel = new Unpackedinventory();
            $result = $stockModel->updateEquipment(
                $_POST['equipmentid'],
                $_POST['quantity']
            );
            

            header('Location:' . ROOT . '/staff/staffdashboard');
        }
    }

    


            
           
        


}
    


