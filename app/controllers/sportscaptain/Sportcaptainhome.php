<?php
class Sportcaptainhome extends Controller{
   public function index(){

        $NoticeModel = new Noticeboard();
        $notices = $NoticeModel->findall();

        $upcomingModel = new Upcomingevent();
        $events = $upcomingModel->getAllUpcomingEvents();

        $data = [
            'notices' => $notices,
            'events' => $events,
        ];

        $this->view('sportscaptain/sportcaptainhome', $data);
    }

}