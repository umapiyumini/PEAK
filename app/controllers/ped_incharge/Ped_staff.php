<?php
    class Ped_staff extends Controller{
        public function index(){
            $pedstaffModel = new Staff();
            $pedstaffList = $pedstaffModel->findAllPedStaff();
            $this->view('ped_incharge/ped_staff',['pedstaffList'=>$pedstaffList]);
        }

        public function addStaffMember(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $pedstaffModel = new Staff();
                $pedstaffModel->addStaff($_POST);
                header('Location: ped_incharge/ped_staff');
            }else{
                header('Location: ped_incharge/ped_staff');
            }
        }

        public function editStaffMember(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $staffModel = new Staff();
                $staffModel->editPedStaff($_POST);
                header('Location: '. ROOT .'/ped_incharge/ped_staff');
            }else{
                header('Location: '. ROOT .'/ped_incharge/ped_staff');
            }
        }

        public function deleteStaff($id) {
            $staffModel = new Staff();
            $staffModel->deleteById($id);
        
            header('Location: '. ROOT .'/ped_incharge/ped_staff');
        }
    }