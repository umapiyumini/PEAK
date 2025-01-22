<?php
class Home extends Controller{
   public function index(){

        $model = new Noticeboard;
        $noticeData = $model->findall();

        $this->view('amalgamated/home' , ['noticeData' => $noticeData]);
    }
}