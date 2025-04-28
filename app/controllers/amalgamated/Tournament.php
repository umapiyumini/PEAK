<?php
class Tournament extends Controller{
   public function index(){

  

        
        //  Insert function
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            //Get DATA

            //show($_POST);

            
            $data = [
                'tournament' => $_POST['tournament'],
                'faculty' => $_POST['faculty'],
                'category' => $_POST['category'], 
                'registration_number' => $_POST['registration_number'],
                'year' => $_POST['year'],
                'Sport' => $_POST['Sport'], 
                'userid' => $_SESSION['userid']
            ];

            //show($data);

            $tournamentreq = new Tournaments();

            if($tournamentreq->validate($data))
            {
                
                $isInserted = $tournamentreq->insert($data);

                if ($isInserted){
                    redirect('amalgamated/Tournament');
                }
                
            }else {
                $errors = $tournamentreq->errors;
                // show($errors);
                $data  = [
                    'errors' => $errors,

                ];
                
                $this->view('amalgamated/addtournament',['errors' => $errors]);

            }
        } else {
            $tournamentreq = new Tournaments();
            $tournamentData = $tournamentreq->where(['userid' => $_SESSION['userid']]);
            // show($result);
            $data = [
                'tournamentdata' => $tournamentData, 
            ];
            
            $this->view('amalgamated/tournament', $data); 
        }
    }

    // edit function
    public function edit()
    { 
      show($_GET['Tournamentid']);
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            //Get DATA

            
            $data = [
                'tournament' => $_POST['tournament'],
                'faculty' => $_POST['faculty'],
                'category' => $_POST['category'], 
                'registration_number' => $_POST['registration_number'],
                'year' => $_POST['year'], 
                'Sport' => $_POST['Sport'],
                'userid' => $_SESSION['userid'],
            ];

            //show($data);

            $tournamentreq = new Tournaments();

            if($tournamentreq->validate($data))
            {
               
                $Tournamentid = $_POST['Tournamentid'];
                $isUpdated = $tournamentreq->update($Tournamentid, $data, 'tourid');

                if (!$isUpdated){
                    redirect('amalgamated/Tournament');
                }
                
            }else {
                $errors = $tournamentreq->errors;
                // show($errors);
                $data  = [
                    'Tournamentid' => $_POST['Tournamentid'],
                    'errors' => $errors,
                ];
                
                $this->view('amalgamated/edittournament', $data);

            }
        } else {
            $tournamentreq = new Tournaments();
            $tournamentData = $tournamentreq->where(['userid' => $_SESSION['userid']]);
            // show($result);
            $data = [
                'tournamentdata' => $tournamentData, 
            ];
            
            $this->view('amalgamated/tournament', $data); 
        }
    
    }

    //Delete Function
    public function delete()
    {
        if (isset($_GET['Tournamentid'])) {
            $Tournamentid = $_GET['Tournamentid'];
            $tournamentreq = new Tournaments();
            $isDeleted = $tournamentreq->delete($Tournamentid, 'tourid');
            //DELETE FUNCTION RETURN TRUE IF THE DATA IS NOT DELETED
            if (!$isDeleted) {
                redirect('amalgamated/Tournament');
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