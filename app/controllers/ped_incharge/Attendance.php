<?php
class Attendance extends Controller {
    public function index() {
        $excuseModel = new AttendenceExcuse();
        $excuseRequests = $excuseModel->getAllRequests();
        $excusePlayerModel = new AttendenceExcusePlayers();

        foreach ($excuseRequests as $excuse) { 
            $excuse->players = $excusePlayerModel->getPlayersByExcuse($excuse->request_id); 
        }

        $this->view('ped_incharge/attendance', [
            'excuserequests' => $excuseRequests
        ]);
    }

    public function approve($id) {
        $attendanceModel = new AttendenceExcuse();
        $attendanceModel->approve($id);

        header('Location: '.ROOT.'/ped_incharge/attendance');
    }
    public function rejectDocument($id) {
        $attendanceModel = new AttendenceExcuse();
        $attendanceModel->reject($id);

        header('Location: '.ROOT.'/ped_incharge/attendance');
    }
}
?>
