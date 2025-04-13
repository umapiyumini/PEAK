<?php
class Ped_facilities extends Controller {
    public function index() {
        $courtsModel = new Courts();
        $courts = $courtsModel->getAllCourts();
        $this->view('ped_incharge/ped_facilities', ['courts' => $courts]);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $courtid = $_POST['courtid'] ?? null;
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $image = $_POST['image'] ?? '';

            if ($courtid) {
                $courtsModel = new Courts();
                $updateData = [
                    'name' => $name,
                    'description' => $description,
                    'image' => $image
                ];

                $result = $courtsModel->update($courtid, $updateData);
                echo $result ? 'success' : 'error';
            } else {
                echo 'missing_id';
            }
        }
    }


    public function getFacility() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $courtid = $_POST['courtid'] ?? null;
            if ($courtid) {
                $courtsModel = new Courts();
                $facility = $courtsModel->getCourtById($courtid);
                echo json_encode($facility);
            } else {
                echo json_encode(['error' => 'Missing ID']);
            }
        }
    }
    
}
