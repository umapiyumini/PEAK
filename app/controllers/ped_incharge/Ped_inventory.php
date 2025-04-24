<?php
    class Ped_inventory extends Controller{
        public function index(){
            $eqpmodel = new Equipments();
            $sportmodel= new Sport();

            $eqpdata = $eqpmodel->findAllEqpsTeam();
            $eqpdatarecreational = $eqpmodel->findAllEqpsRecreational();
            $sportdata = $sportmodel->findAllSports();


            $this->view('ped_incharge/ped_inventory',['eqpdata'=>$eqpdata, 'sportdata'=>$sportdata, 'eqpdatarecreational'=>$eqpdatarecreational]);
        }


        public function addEquipment(){
            $eqpmodel = new Equipments();
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $eqpmodel->saveEquipment($_POST);
                header('Location:' . ROOT . '/ped_incharge/ped_inventory');
            }
        }

        public function editEquipment(){
            $eqpmodel = new Equipments();

            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                // $equipmentid = $_POST['equipmentid'];
                $eqpmodel->updateEquipment($_POST);
                header('Location:' . ROOT . '/ped_incharge/ped_inventory');
            }
        }

        public function deleteEquipment($equipmentid) {
            $eqpmodel = new Equipments();
            $eqpmodel->removeEquipment($equipmentid);
            header('Location:' . ROOT . '/ped_incharge/ped_inventory');
        }
}
