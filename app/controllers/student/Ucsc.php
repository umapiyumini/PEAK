<?php
class Ucsc extends Controller{
   public function index(){

    if($_SERVER['REQUEST_METHOD']=='POST')
    {

        // Fet Date
        
        $data = [
            'Name' => $_POST['Name'],
            'IndexNumber' => $_POST['IndexNumber'],
            'RegistrationNumber' => $_POST['RegistrationNumber'],
            'SportName' => $_POST['SportName'],
            'YearOfAchievement' => $_POST['YearOfAchievement'],
            'AchievementLevel' => $_POST['AchievementLevel']

        ];

        $enhancementucsc=new Enhancementucsc();

            if($enhancementucsc->validate($data))
            {
                $isInserted=$enhancementucsc->insert($data);

                if (!$isInserted){
                    redirect('student/Adducsc');
                }
            }

    }

        $this->view('student/ucsc');
    }

   

}