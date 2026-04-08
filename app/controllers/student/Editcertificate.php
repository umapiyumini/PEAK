<?php
class Editcertificate extends Controller{
    public function index(){
        $RequestId = $_GET['RequestID'];
        // show($id);
        $data = [
            'RequestId' => $RequestId,
        ];

        $this->view('student/editcertificate',$data);
    }
}