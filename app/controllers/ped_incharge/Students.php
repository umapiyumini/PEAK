<?php
    class Students extends Controller{
        public function index(){
            $studentModel = new Student();
            $students = $studentModel->findAllStudents();
            $this->view('ped_incharge/students',['students'=>$students]);
        }
    }