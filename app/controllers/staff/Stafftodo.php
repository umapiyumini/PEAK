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

            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Updated']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Cannot update']);
            }

        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }

    }

     exit;  
   }

}