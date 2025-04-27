<?php
    class SportProfile extends Controller{
        public function index($sportid){
            $sportmodel = new Sport();
            $sportdetails = $sportmodel->getSportDetails($sportid);
            $this->view('ped_incharge/sportProfile', ['sportdetails' => $sportdetails]);
        }
    }