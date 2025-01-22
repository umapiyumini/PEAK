<?php
class Viewnotice extends Controller{
   public function index($noticeId){
        $model = new Noticeboard;
        $data = $model->find($noticeId);

        //var_dump($data);
        
        if($data){
            $this->view('amalgamated/viewnotice', ['notice' => $data]);
        }else{
            echo "Notice not found";
        }
   }
}