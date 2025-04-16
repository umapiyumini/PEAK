<?php
    class Ped_staff extends Controller{
        public function index(){
            $pedstaffModel = new Staff();
            $pedstaffList = $pedstaffModel->findAllPedStaff();
            $this->view('ped_incharge/ped_staff',['pedstaffList'=>$pedstaffList]);
        }
    }