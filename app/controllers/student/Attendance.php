<?php
class Adducsc extends Controller{
    public function index(){

        $this->view('student/attendance');
    }

    public function submit() {
        $reg_no = $_POST['reg_no'] ?? null;
        $date = $_POST['date'] ?? null;
        $sport_id = $_POST['sport_id'] ?? null;
        $attendance = $_POST['attendance'] ?? 'Present';
    
        if ($reg_no && $date && $sport_id) {
            $attendanceModel = new AttendanceModel();
            $attendanceModel->markAttendance($reg_no, $date, $sport_id, $status);
    
            echo "<script>alert('Attendance recorded!'); window.location.href='sportattendance';</script>";
        } else {
            echo "<script>alert('Missing data.'); window.location.href='sportattendance';</script>";
        }
    }
    
    
}