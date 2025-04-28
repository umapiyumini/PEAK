
<?php
class Recruitement extends Controller{
   public function index(){

    //Insert Function
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        //Get Data

        $data = [
            'regno' => $_POST['regno'],
            'faculty' => $_POST['faculty'],
            'reason' => $_POST['reason'],  
            'sport_id' => $_POST['sport_id'],
            'status' => $_POST['status']
        ];

        //show($data);
        

        $recruitment = new Recruit();

        //$r = $recruitment->validate($data);
        //show($r);

        if($recruitment->validate($data))
        {   
            show($data);
            $isInserted = $recruitment->insert($data);

            if ($isInserted){
                header('Location: ' . ROOT . '/student/Recruitement');
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
        // show( $_SESSION['recruitmentid']);
        $recruitmentData = $recruitment->getAll();
        //show($recruitmentData);
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
            'faculty' => $_POST['faculty'],
            'reason' => $_POST['reason'], 
            'sport_id' => $_POST['sport_id'], 
            'status' => $_POST['status']
        ];

        $recruitment = new Recruit();

        if($recruitment->validate($data))
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
    if (isset($_GET['recruitmentid'])) {
        $Recruitmentid = $_GET['recruitmentid'];
        $recruitment = new Recruit();
        $isDeleted = $recruitment->delete($Recruitmentid, 'recruitmentid');
        //DELETE FUNCTION RETURN TRUE IF THE DATA IS NOT DELETED
        if (!$isDeleted) {
            redirect('student/Recruitement');
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

   
    

       
    
   


    
   

