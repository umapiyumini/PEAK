<?php
    class SportProfile extends Controller{
        public function index($sportid){
            $sportmodel = new Sport();
            $sportdetails = $sportmodel->getSportDetails($sportid);

            if(empty($sportdetails)) {
                $_SESSION['error'] = "Sport profile not found!";
                header('Location: ../Ped_Sports');
                exit;
            }

            $sportcaptainmodel = new Sports_captain();
            $sportcapdetails = $sportcaptainmodel->getAllBySport($sportid);

            $sportnewsmodel = new News();
            $sportnews = $sportnewsmodel->getBySportID($sportid);

            $coachModel = new CoachesInstructors();
            $coaches = $coachModel->getCoachesBySport($sportid);

            $this->view('ped_incharge/sportProfile', ['sportdetails' => $sportdetails, 'sportnews' => $sportnews, 'sportcapdetails' => $sportcapdetails, 'coaches' => $coaches]);
        }

        public function addcoach() {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $model = new CoachesInstructors();

                $model->addNewCoach($_POST);

                header('Location: ' . ROOT . '/ped_incharge/sportProfile/'. $_POST['sportid']); 
            }
        }

        public function getCoach($coachid) {
            $model = new CoachesInstructors();
            $result = $model->getCoachDetails($coachid);
            echo json_encode($result);
        }

        public function editcoach($coachid) {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $model = new CoachesInstructors();
                $_POST['empid'] = $coachid;
                show($_POST);
                $model->editCoach($_POST);

                header('Location: ' . ROOT . '/ped_incharge/sportProfile/' . $_POST['sportid']);
            }
        }

        public function deletecoach($coachid, $sportid) {
            $model = new CoachesInstructors();
            $model->deleteCoach($coachid);

            header('Location: ' . ROOT . '/ped_incharge/sportProfile/' . $sportid); 
        }
    }