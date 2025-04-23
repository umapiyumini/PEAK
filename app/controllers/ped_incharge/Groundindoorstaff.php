<?php
    class Groundindoorstaff extends Controller{
        public function index(){
            $staffModel = new Staff();
            $groundIndoorStaffList = $staffModel->findAllGroundIndoorStaff();

            $staffTodoModel = new StaffTodo();
            $staffTodoList = $staffTodoModel->findAllStaffTodo();

            $this->view('ped_incharge/groundindoorstaff',['groundIndoorStaffList'=>$groundIndoorStaffList, 'staffTodoList'=>$staffTodoList]);
        }

        public function addTask(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $staffTodoModel = new StaffTodo();
                $_POST['date']= date('Y-m-d');
                $staffTodoModel->addTask($_POST);
                header('Location: ped_incharge/groundindoorstaff');
            }else{
                header('Location: ped_incharge/groundindoorstaff');
            }
        }

        public function addStaffMember(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $staffModel = new Staff();
                $staffModel->addStaff($_POST);
                header('Location: '. ROOT .'/ped_incharge/groundindoorstaff');
            }else{
                header('Location: '. ROOT .'/ped_incharge/groundindoorstaff');
            }
        }
        
        public function getStaffData($id) {
            $staffModel = new Staff();
            $staff = $staffModel->getById($id);
            if ($staff) {
                echo json_encode($staff);
            } else {
                echo json_encode(['error' => 'Staff not found']);
            }
        }

        
        public function editStaffMember(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $staffModel = new Staff();
                $staffModel->editGroundIndoorStaff($_POST);
                header('Location: '. ROOT .'/ped_incharge/groundindoorstaff');
            }else{
                header('Location: '. ROOT .'/ped_incharge/groundindoorstaff');
            }
        }

        public function deleteStaff($id) {
            $staffModel = new Staff();
            $staffModel->deleteById($id);
        
            header('Location: '. ROOT .'/ped_incharge/groundindoorstaff');
        }

        public function updateStatus(){
            $now= new DateTime();
            $staffTodoModel = new StaffTodo();
            $staffTodoList = $staffTodoModel->findAllStaffTodo();

            foreach($staffTodoList as $task){
                $taskid = $task->taskid;
                $deadline = new DateTime($task->deadline);
                $status = $task->status;
                if($status !== 'Completed' && $now > $deadline){
                    $staffTodoModel->updateStatus($taskid);
                }
            }
            return true;
        }
        
    }