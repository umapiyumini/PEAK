<?php
class Enhancement extends Controller{
   public function index(){

  

        //  Insert function
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            //Get DATA

            $data = [
                'name' => $_POST['name'],
                'registration_number' => $_POST['registration_number'],
                'sport' => $_POST['sport'],
                'achievement' => $_POST['achievement'],  
                'userid' => $_SESSION['userid']
            ];

            $enhancereq = new Enhancementreq();

            if($enhancereq->validate($data))
            {
                $isInserted = $enhancereq->insert($data);

                if ($isInserted){
                    redirect('student/enhancement');
                }
                
            }else {
                $errors = $enhancereq->errors;
                // show($errors);
                $data  = [
                    'errors' => $errors,

                ];
                
                $this->view('student/Addenhancement',['errors' => $errors]);

            }
        } else {
            $enhancereq = new Enhancementreq();
            $enhanceData = $enhancereq->where(['userid' => $_SESSION['userid']]);
            // show($result);
            $data = [
                'enhancedata' => $enhanceData, 
            ];
            
            $this->view('student/enhancement', $data); 
        }
    }

    // edit function
    public function edit()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            //Get DATA

            $data = [
                'name' => $_POST['name'],
                'registration_number' => $_POST['registration_number'],
                'sport' => $_POST['sport'],
                'achievement' => $_POST['achievement'],  
                'userid' => $_SESSION['userid'],
            ];

            $enhancereq = new Enhancementreq();

            if($enhancereq->validate($data))
            {
                $RequestId = $_POST['RequestId'];
                $isUpdated = $enhancereq->update($RequestId, $data, 'RequestID');

                if (!$isUpdated){
                    redirect('student/enhancement');
                }
                
            }else {
                $errors = $enhancereq->errors;
                // show($errors);
                $data  = [
                    'RequestId' => $_POST['RequestId'],
                    'errors' => $errors,
                ];
                
                $this->view('student/Editenhancement', $data);

            }
        } else {
            $enhancereq = new Enhancementreq();
            $enhanceData = $enhancereq->where(['userid' => $_SESSION['userid']]);
            // show($result);
            $data = [
                'enhancedata' => $enhanceData, 
            ];
            
            $this->view('student/enhancement', $data); 
        }
    
    }   

    //Delete Function
    public function delete()
    {
        if (isset($_GET['RequestId'])) {
            $RequestId = $_GET['RequestId'];
            $enhancereq = new Enhancementreq();
            $isDeleted = $enhancereq->delete($RequestId, 'RequestID');
            //DELETE FUNCTION RETURN TRUE IF THE DATA IS NOT DELETED
            if (!$isDeleted) {
                redirect('student/enhancement');
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