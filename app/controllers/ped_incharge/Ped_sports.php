<?php
    class Ped_sports extends Controller{
        public function index(){
            $sportModel = new Sport();
            $sportsList = $sportModel->findAllSports();

            $this->view('ped_incharge/ped_sports', ['sportsList' => $sportsList]);
        }

        public function addSport(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $addsportmodel= new Sport();

                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $fileTmpPath = $_FILES['image']['tmp_name'];
                    $fileName = $_FILES['image']['name'];
                    $fileSize = $_FILES['image']['size'];
                    $fileType = $_FILES['image']['type'];
                    $fileNameCmps = explode(".", $fileName);
                    $fileExtension = strtolower(end($fileNameCmps));
        
                    $allowedfileExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
        
                    if (in_array($fileExtension, $allowedfileExtensions)) {
                        $newFileName = uniqid() . '.' . $fileExtension;
                        $uploadFileDir = 'assets/images/ped_incharge/';
                        $dest_path = $uploadFileDir . $newFileName;
        
                        if (!is_dir($uploadFileDir)) {
                            mkdir($uploadFileDir, 0777, true);
                        }
        
                        if (move_uploaded_file($fileTmpPath, $dest_path)) {
                            $_POST['image'] = $dest_path;
                            $addsportmodel->addNewSport($_POST);
                        } else {
                            $_SESSION['error'] = 'Error moving the uploaded file.';
                        }
                    } else {
                        $_SESSION['error'] = 'Unsupported file type. Allowed types: jpg, jpeg, png, pdf.';

                    }
                }
                

                header('Location:' .ROOT. '/ped_incharge/ped_sports');
            }
        }
    }
    ?>