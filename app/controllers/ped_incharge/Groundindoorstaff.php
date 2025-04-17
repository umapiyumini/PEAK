<?php
    class Groundindoorstaff extends Controller{
        public function index(){
            $staffModel = new Staff();
            $groundIndoorStaffList = $staffModel->findAllGroundIndoorStaff();

            $staffTodoModel = new StaffTodo();
            $staffTodoList = $staffTodoModel->findAllStaffTodo();

            $this->view('ped_incharge/groundindoorstaff',['groundIndoorStaffList'=>$groundIndoorStaffList, 'staffTodoList'=>$staffTodoList]);
        }
    }