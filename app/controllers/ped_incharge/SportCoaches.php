<?php
    class SportCoaches extends Controller{
        public function index($sportid){
            

            $this->view('ped_incharge/sport_coaches');
        }
    }