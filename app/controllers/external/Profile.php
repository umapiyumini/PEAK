<?php
class Profile extends Controller {
   
        public function index() {
            if (isset($_SESSION['userid'])) {
                $userid = $_SESSION['userid'];
    
                $userModel = new User();
                $externalUserModel = new External_User();
    
                $user_data = $userModel->getUser($userid);
                $company_data = $externalUserModel->where(['userid' => $userid]);
    
                $user = (!empty($user_data)) ? $user_data[0] : null;
                $company_name = (!empty($company_data)) ? $company_data[0]->company_name : '';
    
                $this->view('external/profile', [
                    'user' => $user,
                    'company_name' => $company_name
                ]);
            } else {
                header('Location: /login');
                exit;
            }
        }

        public function update()
{
    // Only allow POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get user id from session
        if (!isset($_SESSION['userid'])) {
            echo json_encode(['success' => false, 'message' => 'Not logged in']);
            exit;
        }
        $userid = $_SESSION['userid'];

        // Get JSON input
        $data = json_decode(file_get_contents('php://input'), true);

        // Validate input (add more validation as needed)
        if (empty($data['name']) || empty($data['email']) || empty($data['phone']) || empty($data['address'])) {
            echo json_encode(['success' => false, 'message' => 'All fields are required']);
            exit;
        }

        // Update user in database
        $userModel = new User();
        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'contact_number' => $data['phone'],
            'address' => $data['address']
        ];
        $result = $userModel->update($userid, $updateData);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database update failed']);
        }
        exit;
    }
}


public function upload_image()
{
    // Only allow POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_SESSION['userid'])) {
            echo json_encode(['success' => false, 'message' => 'Not logged in']);
            exit;
        }
        $userid = $_SESSION['userid'];

        // Check if file is uploaded
        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['success' => false, 'message' => 'No file uploaded or upload error']);
            exit;
        }

        $uploadDir = __DIR__ . '/../../../uploads/profile_pictures/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
        }

        $file = $_FILES['image'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        if (!in_array($ext, $allowed)) {
            echo json_encode(['success' => false, 'message' => 'Invalid file type']);
            exit;
        }

        // Generate a unique file name (e.g., userid_timestamp.ext)
        $newName = $userid . '_' . time() . '.' . $ext;
        $destination = $uploadDir . $newName;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            // Optionally: Save the image path/filename in the user's DB record
            $userModel = new User();
            $userModel->update($userid, ['image' => $newName]);

            echo json_encode([
                'success' => true,
                'image_url' => '/PEAK/uploads/profile_pictures/' . $newName
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to move uploaded file']);
        }
        exit;
    }
}


public function remove_image()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_SESSION['userid'])) {
            echo json_encode(['success' => false, 'message' => 'Not logged in']);
            exit;
        }
        $userid = $_SESSION['userid'];

        $userModel = new User();
        $userData = $userModel->getUser($userid);
        $user = (!empty($userData)) ? $userData[0] : null;

        if ($user && !empty($user->image)) {
            $filePath = __DIR__ . '/../../../uploads/profile_pictures/' . $user->image;
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file
            }
            // Remove image reference from DB
            $userModel->update($userid, ['image' => null]);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No profile picture to remove']);
        }
        exit;
    }
}

    }
    


