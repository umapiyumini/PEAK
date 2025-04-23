<?php
    class Home extends Controller{
        
        private $errors = array();
        
        public function index(){
            $noticeModel = new Noticeboard();
            $notices = $noticeModel->findall();

            require_once __DIR__ . '\Groundindoorstaff.php';
            $stafftodoController = new Groundindoorstaff();
            $stafftodoController->updateStatus();

            $this->view('ped_incharge/home',['notices'=>$notices, 'errors'=>$this->errors]);

        }

        public function addNotice(){
            $noticeModel = new Noticeboard();
            $data = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'publishdate' => date('Y-m-d'),
                'publishtime' => date('H:i:s'),
                'visibility' => $_POST['visibility'],
                'userid' => $_SESSION['userid']
            ];
            
            if($noticeModel->validate($data)){
                $noticeModel->addNotice($data);
                header('Location: '.ROOT.'/ped_incharge/home');
            }
        }

        public function editnotice(){
            $noticeModel = new Noticeboard();
        
            $publishedAt = strtotime($_POST['publishdate'] . ' ' . $_POST['publishtime']);
            $now = time();
        
            if ($now - $publishedAt > 3600) {
                $this->errors['publishdate'] = 'Edit time expired.';
            } else {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $noticeModel->updateNotice($_POST);
                } else {
                    $this->errors['notice'] = 'Invalid request.';
                }
            }

            header('Location: ' . ROOT . '/ped_incharge/home');
        }

        public function deleteNotice($noticeid) {
            $noticeModel = new Noticeboard();
            $noticeModel->deleteNotice($noticeid);
            header('Location: ' . ROOT . '/ped_incharge/home');
        }
        
    }