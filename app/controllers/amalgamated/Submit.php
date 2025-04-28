<?php
class Submit extends Controller{
    public function index(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new Noticeboard;
            $data = [
                'title' => $_POST['title'] ?? '',
                'content' => $_POST['content'] ?? '',
                'publishdate' => $_POST['publishdate'] ?? '',
                'publishtime' => $_POST['publishtime'] ?? '',
                'visibility' => $_POST['visibility'] ?? '',
            ];

            //show($data);

            $result = $model->validate($data);
            show($result);

            if($model->validate($data)){
                $model->insert($data);
                redirect('amalgamated/Home');
            }
            else{
                echo "Error";
            }
        }
    }
}