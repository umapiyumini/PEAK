<?php
class Editrecruitement extends Controller{
    public function index(){
        $Recruitmentid = $_GET['recruitmentid'];
        
        // show($id);
        $data = [
            'recruitmentid' => $Recruitmentid,
        ];
        $this->view('student/editrecruitement', $data);
    }
}   

