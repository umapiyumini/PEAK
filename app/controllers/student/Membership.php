<?php
class Membership extends Controller{
   public function index(){

    //Insert Function 
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        //Get Data 

        $data= [
            'full_name' => $_POST['full_name'],
            'student_id' => $_POST['student_id'],
            'faculty' => $_POST['faculty'],
            'year_of_study' => $_POST['year_of_study'], 
            'contact_number' => $_POST['contact_number'], 
            'university_email' => $_POST['university_email'],  
            'userid' => $_SESSION['userid'],
        ];

        $teammembership = new Teammembership();

        if($teammembership->validate($data))
            {
                $isInserted = $teammembership->insert($data);

                if (!$isInserted){
                    redirect('student/membership');
                }
                
            }else {
                $errors = $teammembership->errors;
                // show($errors);
                $data  = [
                    'errors' => $errors,

                ];
                
                $this->view('student/Editmedical',['errors' => $errors]);

            }
        } else {
            $teammembership = new Teammembership();
            $teamData = $teammembership->where(['userid' => $_SESSION['userid']]);
            // show($result);
            $data = [
                'teamdata' => $teamData, 
            ];
            
            $this->view('student/membership', $data); 
        }
        
    }
    

    //Delete Function
    public function delete()
    {
        if (isset($_GET['request_id'])) {
            $RequestId = $_GET['request_id'];
            $teammembership = new Teammembership();
            $isDeleted = $teammembership->delete($RequestId, 'request_id');
            //DELETE FUNCTION RETURN TRUE IF THE DATA IS NOT DELETED
            if (!$isDeleted) {
                redirect('student/membership');
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