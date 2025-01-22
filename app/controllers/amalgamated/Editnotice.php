<?php
class Editnotice extends Controller{
    public function index($noticeid){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $model = new Noticeboard;

            $data = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'publishdate' => $_POST['publishdate'],
                'publishtime' => $_POST['publishtime'],
            ];

            if($model->validate($data)){
                $updateData = $model->update($noticeid,$data,'noticeid');

                //var_dump($updateData);

                if(!$updateData){
                    echo "Notice updated successfully";
                    redirect('amalgamated/home');
                }else{
                    echo "Notice not found";
                }
            }
            
        }
    }
}