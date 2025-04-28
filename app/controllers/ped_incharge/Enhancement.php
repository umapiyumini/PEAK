<?php
    class Enhancement extends Controller{
        public function index(){

            $enhandementmodel= new Enhancementreq();
            $enhreqs= $enhandementmodel-> getAllRequests();
            
            $this->view('ped_incharge/enhancement',['enhreqs'=>$enhreqs]);
        }

        public function approve($id) {
            $enhancementModel = new Enhancementreq();
            $enhancementModel->approve($id);
    
            header('Location: '.ROOT.'/ped_incharge/enhancement');
        }
        public function rejectDocument($id) {
            $enhancementModel = new Enhancementreq();
            $enhancementModel->reject($id);
    
            header('Location: '.ROOT.'/ped_incharge/enhancement');
        }
    }