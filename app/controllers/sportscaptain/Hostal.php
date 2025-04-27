<?php
class Hostal extends Controller{
   public function index(){ 

        
            $hostalModel = new HostalFacilities();
            $hostal_request = $hostalModel->getHostalData();
            
            $this->view('sportscaptain/hostal', ['hostal' => $hostal_request]);
          
    }

    public function insertrequest(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){


            $reg_no = $_POST['reg_no'];
            $startdate = $_POST['start_date'];
            $enddate = $_POST['end_date']; 
            $priority = $_POST['priority'];

           /*validations*/
            if(empty($reg_no) || empty($startdate) || empty($enddate) || empty($priority)){
                $_SESSION['error'] = 'All fields are required';
                header('Location: ' . ROOT . '/sportscaptain/hostal');
                exit();
            }
            
            $playerModel = new Players();
            $player = $playerModel->getPlayers();
            $playerRegNos = array_column($player, 'regno');
            $invalidRegNos = array_diff($reg_no, $playerRegNos);
            if (!empty($invalidRegNos)) {
                $_SESSION['error'] = 'Invalid registration numbers: ' . implode(', ', $invalidRegNos);
                header('Location: ' . ROOT . '/sportscaptain/hostal');
                exit();
            }

            try{
                $facilities = [];

                for ($i = 0; $i < count($reg_no); $i++) {
                    $facilities[] = [
                        'reg_no' => $reg_no[$i],
                        'priority' => $priority[$i],
                        'start_date' => $startdate,
                        'end_date' => $enddate,
                        
                    ];
                }

                $hostalModel = new HostalFacilities();
                $hostal = $hostalModel->insertRequesthostal($facilities);
                if($hostal){
                    $_SESSION['success'] = 'Hostal request added successfully';
                    
                }else{
                    $_SESSION['error'] = 'Failed to add hostal request';
                    
                }
            }catch(Exception $e){
                $_SESSION['error'] = $e->getMessage();
            }
        }

        header('Location: ' . ROOT . '/sportscaptain/hostal');
        exit();
    }

   

}