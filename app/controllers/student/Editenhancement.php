<?php
class Editenhancement extends Controller{
   public function index(){
    $RequestId = $_GET['RequestId'];
        
        // show($id);
        $data = [
            'RequestId' => $RequestId,
        ];

        $this->view('student/editenhancement',$data);
    }

   

}