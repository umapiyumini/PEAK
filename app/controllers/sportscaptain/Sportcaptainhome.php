<?php
class Sportcaptainhome extends Controller{
   public function index(){

        $NoticeModel = new Noticeboard();
        $notices = $NoticeModel->findall();

        $data = [
            'notices' => $notices,
        ];

        $this->view('sportscaptain/sportcaptainhome', $data);
    }

}