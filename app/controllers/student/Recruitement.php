<?php
class Recruitement extends Controller{
   public function index(){

    //Insert Function
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        //Get Data

        $data = [
            'regno' => $_POST['regno'],
            'name' => $_POST['name'],
            'faculty' => $_POST['faculty'],
            'reason' => $_POST['reason'],  
            'accept' => $_SESSION['accept']
        ];

        $recruitment = new Recruit();

        if($recruitment->validate($data))
        {
            $isInserted = $recruitment->insert($data);

            if (!$isInserted){
                redirect('student/recruitement');
            }
            
        }else {
            $errors = $recruitment->errors;
            // show($errors);
            $data  = [
                'errors' => $errors,

            ];
            
            $this->view('student/Addrecruitement',['errors' => $errors]);

        }
    } else {
        $recruitment = new Recruit();
        $recruitmentData = $recruitment->where(['sport_id' => $_SESSION['sport_id']]);
        // show($result);
        $data = [
            'recuruitmentdata' => $recruitmentData, 
        ];
        
        $this->view('student/recruitement', $data); 
    }
}

// edit function
public function edit()
{
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        //Get DATA

        $data = [
            'regno' => $_POST['regno'],
            'name' => $_POST['name'],
            'faculty' => $_POST['faculty'],
            'reason' => $_POST['reason'],  
            'accept' => $_SESSION['accept']
        ];

        $recruitment = new Recruit();

        if($medicalrequest->validate($data))
        {
            $RecruitmentId = $_POST['recruitmentid'];
            $isUpdated = $recruitment->update($RecruitmentId, $data, 'recruitmentid');

            if (!$isUpdated){
                redirect('student/recruitement');
            }
            
        }else {
            $errors = $recruitment->errors;
            // show($errors);
            $data  = [
                'recruitmentid' => $_POST['recruitmentid'],
                'errors' => $errors,
            ];
            
            $this->view('student/Editrecruitement', $data);

        }
    } else {
        $recruitment = new Recruit();
        $medicalData = $RecruitmentId->where(['sport_id' => $_SESSION['sport_id']]);
        // show($result);
        $data = [
            'medicaldata' => $medicalData, 
        ];
        
        $this->view('student/recruitement', $data); 
    }

}

//Delete Function
public function delete()
{
    if (isset($_GET['RequestId'])) {
        $RequestId = $_GET['RequestId'];
        $medicalrequest = new Recruit();
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

   
    

       
    
   


    
   

