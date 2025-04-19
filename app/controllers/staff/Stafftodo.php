<?php
class Stafftodo extends Controller{
   public function index(){

        $todoModal = new Todo();
        $task = $todoModal->findAllStaffTodo();

        $this->view('staff/stafftodo',['task'=>$task]);
    }

   public function updatestatus(){

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $taskid = $_POST['taskid'];
        $status = $_POST['status'];

        try{

            $todoModal = new Todo();
            $result = $todoModal->updateStatus($taskid, $status);

            if($result){
                $_SESSION['success'] = 'Updated';
            }else{
                $_SESSION['error'] = 'Can not update';
            }

        }catch(Exception $e){
            $_SESSION['error'] = getMessage->$e;
        }

    }

     header('location: ' .ROOT. '/staff/stafftodo');   
        



   }

}