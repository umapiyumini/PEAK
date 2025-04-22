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
            'user_id' => $_SESSION['user_id'],
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
            $teamData = $teammembership->where(['user_id' => $_SESSION['user_id']]);
            // show($result);
            $data = [
                'teamdata' => $teamData, 
            ];
            
            $this->view('student/membership', $data); 
        }
    }

  

}