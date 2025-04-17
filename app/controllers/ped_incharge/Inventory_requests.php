<?php
    class Inventory_requests extends Controller{
        public function index(){
            $reqmodel = new Inventoryrequest();
            $reqdata = $reqmodel->requesttable2();
            $endreqdata = $reqmodel->yearEndrequesttable();

            $counts = array();
            $counts['midcount'] = $reqmodel->getCountYearMid();
            $counts['endcount'] = $reqmodel->getCountYearEnd();

            $allrequests = $reqmodel->allYearEndRequests();

            $this->view('ped_incharge/inventory_requests', ['reqdata'=>$reqdata, 'endreqdata'=>$endreqdata, 'counts'=>$counts, 'allrequests'=>$allrequests]);
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

        public function  processRequest($sport, $action) {
            $reqmodel = new Inventoryrequest();
            if($action == 'approved') {
                $reqmodel->saveRequest($sport);
                header("Location: ".ROOT."/ped_incharge/inventory_requests");
                exit();
            } elseif ($action == 'rejected') {
                $reqmodel->rejectRequest($sport);
                header("Location: ".ROOT."/ped_incharge/inventory_requests");
                exit();
            }
        }
    }
