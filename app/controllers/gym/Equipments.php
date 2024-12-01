<?php
class Equipments extends Controller {
    public function index() {
        $gymequipments = new Gymequipments();
    
        // Fetch data
        $this->data['gymequimentview'] = $gymequipments->gymequipmentstable();
        
    




        // Handle DELETE request for gym equipment
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_gymequipmentid'])) {
    $gymequipmentid = $_POST['delete_gymequipmentid'];
    $success = $gymequipments->deletegymequipment($gymequipmentid);

    // Redirect to the same page to reload the table, regardless of success
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit; // Make sure to stop further execution
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['equipmentname']) && isset($_POST['quantity']) && isset($_POST['description'])){
    $gymequipmentModel = new Gymequipments;
    $gymequipmentModel->addgymequipment(['gymequipmentid' => $_POST['gymequipmentid'], 'quantity' => $_POST['quantity'], 'description' => $_POST['description']]);
    exit;
}
        // Pass data to view
        $this->view('gym/equipments', $this->data);
    }

 
   
   

//add equipments
public function addEquipment(){
    $eqpmodel = new Gymequipments();
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $eqpmodel->saveEquipment($_POST);
        header('Location:' . ROOT . '/gym/equipments');
    }
}

//edit equipments
public function editEquipment(){
    $eqpmodel = new Gymequipments();

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        // $equipmentid = $_POST['equipmentid'];
        $eqpmodel->updateEquipment($_POST);
        header('Location:' . ROOT . '/gym/equipments');
    }
}

}

    

