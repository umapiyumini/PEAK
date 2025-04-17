<?php
    class Ped_sports extends Controller{
        public function index(){
            $sportModel = new Sport();
            $sportsList = $sportModel->findAllSports();

            $this->view('ped_incharge/ped_sports', ['sportsList' => $sportsList]);
        }
    }
    ?>