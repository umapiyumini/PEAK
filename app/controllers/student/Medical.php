<?php
class Medical extends Controller{
   public function index(){

    if (!isset($_SESSION['userid'])) {
        header('Location:' . ROOT . '/Login');
        exit;
    }

        //  Insert function
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            //Get DATA

            $data = [
                'Name' => $_POST['Name'],
                'RegistrationID' => $_POST['RegistrationID'],
                'ReasonForMedical' => $_POST['ReasonForMedical'],
                'TimePeriod' => $_POST['TimePeriod'],  
                'userid' => $_SESSION['userid'],
            ];

            $medicalrequest = new MedicalRequest();

            if($medicalrequest->validate($data))
            {
                $isInserted = $medicalrequest->insert($data);

                if (!$isInserted){
                    redirect('student/medical');
                }
                
            }else {
                $errors = $medicalrequest->errors;
                // show($errors);
                $data  = [
                    'errors' => $errors,

                ];
                
                $this->view('student/Editmedical',['errors' => $errors]);

            }
        } else {
            $medicalrequest = new MedicalRequest();
            $medicalData = $medicalrequest->where(['userid' => $_SESSION['userid']]);
            // show($result);
            $data = [
                'medicaldata' => $medicalData, 
            ];
            
            $this->view('student/medical', $data); 
        }
    }

    // edit function
    public function edit()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            //Get DATA

            $data = [
                'Name' => $_POST['Name'],
                'RegistrationID' => $_POST['RegistrationID'],
                'ReasonForMedical' => $_POST['ReasonForMedical'],
                'TimePeriod' => $_POST['TimePeriod'],  
                'userid' => $_SESSION['userid'],
            ];

            $medicalrequest = new MedicalRequest();

            if($medicalrequest->validate($data))
            {
                $RequestId = $_POST['RequestId'];
                $isUpdated = $medicalrequest->update($RequestId, $data, 'RequestId');

                if (!$isUpdated){
                    redirect('student/medical');
                }
                
            }else {
                $errors = $medicalrequest->errors;
                // show($errors);
                $data  = [
                    'RequestId' => $_POST['RequestId'],
                    'errors' => $errors,
                ];
                
                $this->view('student/Editmedical', $data);

            }
        } else {
            $medicalrequest = new MedicalRequest();
            $medicalData = $medicalrequest->where(['userid' => $_SESSION['userid']]);
            // show($result);
            $data = [
                'medicaldata' => $medicalData, 
            ];
            
            $this->view('student/medical', $data); 
        }
    
    }

    //Delete Function
    public function delete()
    {
        if (isset($_GET['RequestId'])) {
            $RequestId = $_GET['RequestId'];
            $medicalrequest = new MedicalRequest();
            $isDeleted = $medicalrequest->delete($RequestId, 'RequestID');
            //DELETE FUNCTION RETURN TRUE IF THE DATA IS NOT DELETED
            if (!$isDeleted) {
                redirect('student/Medical');
            } else {
                // Handle deletion failure (optional)
                echo "Failed to delete the medical request.";
            }
        } else {
            // Handle missing RequestId (optional)
            echo "Invalid Request.";
        }
    }


}