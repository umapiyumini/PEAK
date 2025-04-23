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
            $location = $_POST['location'] ?? '';
            $section = $_POST['section'] ?? '';
    
            $updateData = [
                'name' => $name,
                'description' => $description,
                'location' => $location,
                'section' => $section
            ];
    
            // Handle image upload if a new file is provided
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'C:/xampp1/htdocs/PEAK/public/assets/images/uma/';
                $filename = uniqid() . '_' . basename($_FILES['image']['name']);
                $targetFile = $uploadDir . $filename;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $imagePath = '/assets/images/uma/' . $filename;
                    $updateData['image'] = $imagePath;
                }
            }
    
            if ($courtid) {
                $courtsModel = new Courts();
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
    

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $location = $_POST['location'] ?? '';
            $section = $_POST['section'] ?? '';
    
            $imagePath = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                    echo 'file_upload_error: ' . $_FILES['image']['error'];
                    return;
                }
                $uploadDir = 'C:/xampp1/htdocs/PEAK/public/assets/images/uma/';
                $filename = uniqid() . '_' . basename($_FILES['image']['name']);
                $targetFile = $uploadDir . $filename;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $imagePath =  ROOT . '/assets/images/uma/' . $filename;
                    
                } else {
                    echo 'file_move_failed';
                    return;
                }
            }
    
            $courtsModel = new Courts();
            $data = [
                'name' => $name,
                'description' => $description,
                'image' => $imagePath,
                'location' => $location,
                'section' => $section
            ];
            $result = $courtsModel->insert($data);
    
            // ADD THIS:
            if ($result) {
                echo 'success';
            } else {
                echo 'error';
            }
        }
    }
    
    
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $courtid = $_POST['courtid'] ?? null;
            if ($courtid) {
                $courtsModel = new Courts();
                $result = $courtsModel->delete($courtid);
                echo $result ? 'success' : 'error';
            } else {
                echo 'missing_id';
            }
        }
    }
    
    
}
