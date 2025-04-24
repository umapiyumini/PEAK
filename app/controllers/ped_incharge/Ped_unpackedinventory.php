<?php
    class Ped_unpackedinventory extends Controller{
        public function index(){
            $reqmodel = new Equipments();
            $listteam = $reqmodel->teamtable();
            $listrec = $reqmodel->rectable();

            $updatemodel = new Inventoryedit();
            $updatesteam = $updatemodel->getAllTeam();
            $updatesrec = $updatemodel->getAllRec();

            $this->view('ped_incharge/ped_unpackedinventory', ['listteam'=>$listteam, 'listrec'=>$listrec, 'updatesteam'=>$updatesteam, 'updatesrec'=>$updatesrec]);
        }
}