<?php
class Removenotice extends Controller{
   public function index($noticeid){
    $model = new Noticeboard;
    $data = $model->delete($noticeid,'noticeid');
        if(!$data){
                redirect('amalgamated/home');
            }else{
                echo "Notice not found";
            }
    }
}
