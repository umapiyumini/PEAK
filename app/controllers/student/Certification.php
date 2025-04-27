<?php
class Certification extends Controller{
   public function index(){

    
   

        //  Insert function
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            //Get DATA

            $data = [
                'tournament' => $_POST['tournament'],
                'Year' => $_POST['Year'],
                'Sport' => $_POST['Sport'],  
                'UserID' => $_SESSION['userid'],
            ];
           

            $certificaterequest = new Certificaterequest();

            if($certificaterequest->validate($data))
            {
               
                $isInserted = $certificaterequest->insert($data);

                if ($isInserted){
                    redirect('student/Certification');
                }
                
            }else {
                
                $errors = $certificaterequest->errors;
                
                // show($errors);
                $data  = [
                    'errors' => $errors,

                ];
                
                $this->view('student/Addcertificate',['errors' => $errors]);

            }
        } else {
            $certificaterequest = new Certificaterequest();
            $certificateData = $certificaterequest->where(['UserID' => $_SESSION['userid']]);
            // show($result);
            $data = [
                'certificatedata' => $certificateData, 
            ];
            
            $this->view('student/certification', $data); 
        }
    }

    //edit Function

    public function edit()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            //Get DATA

            $data = [
                'tournament' => $_POST['tournament'],
                'Year' => $_POST['Year'],
                'Sport' => $_POST['Sport'],  
                'UserID' => $_SESSION['userid']
            ];

            $certificaterequest = new Certificaterequest();

            if($certificaterequest->validate($data))
            {
                $RequestId = $_POST['RequestId'];
                $isUpdated = $certificaterequest->update($RequestId, $data, 'RequestID');

                if (!$isUpdated){
                    redirect('student/certification');
                }
                
            }else {
                $errors = $certificaterequest->errors;
                // show($errors);
                $data  = [
                    'RequestId' => $_POST['RequestId'],
                    'errors' => $errors,
                ];
                
                $this->view('student/Editcertificate', $data);

            }
        } else {
            $certificaterequest = new Certificaterequest();
            $certificateData = $certificaterequest->where(['UserID' => $_SESSION['userid']]);
            // show($result);
            $data = [
                'certificatedata' => $certificateData, 
            ];
            
            $this->view('student/certification', $data); 
        }
    
    }

    //Delete Function
    public function delete()
    {
        if (isset($_GET['RequestId'])) {
            $RequestId = $_GET['RequestId'];
            $certificaterequest = new Certificaterequest();
            $isDeleted = $certificaterequest->delete($RequestId, 'RequestID');
            //DELETE FUNCTION RETURN TRUE IF THE DATA IS NOT DELETED
            if (!$isDeleted) {
                redirect('student/certification');
            } else {
                // Handle deletion failure (optional)
                echo "Failed to delete the certificate request.";
            }
        } else {
            // Handle missing RequestId (optional)
            echo "Invalid Request.";
        }
    }


}