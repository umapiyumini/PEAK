<?php
    class Inventory_requests extends Controller{
        public function index(){
            $reqmodel = new Inventoryrequest();
            $reqdata = $reqmodel->requesttable();

            $this->view('ped_incharge/inventory_requests', ['reqdata'=>$reqdata]);
        }

        //function to update status to accepted or rejected
        public function updateStatus($id, $status) {
            $reqmodel = new Inventoryrequest();

            if($reqmodel->updateStatus($id, $status)) {
                header("Location: ".ROOT."/ped_incharge/inventory_requests");
                exit();
            } else {
                echo "<script>alert('Error: " . $reqmodel->getErrorMsg() . "'); window.location.href='" . ROOT . "/ped_incharge/inventory_requests';</script>";
            }
        }

        public function deleteRequest($id) {
            $reqmodel = new Inventoryrequest();
            if($reqmodel->deleteRequest($id)) {
                header("Location: ".ROOT."/ped_incharge/inventory_requests");
                exit();
            } else {
                echo "<script>alert('Error: ". $reqmodel->getErrorMsg(). "'); window.location.href='" . ROOT. "/ped_incharge/inventory_requests';</script>";
            }
        }
    }
