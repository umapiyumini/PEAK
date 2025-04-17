<?php
class Tournaments extends Controller {
    
    private function getUserId() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['userid'])) {
            die("User not logged in.");
        }
        return $_SESSION['userid'];
    }

    private $freshersrecords;
    private $interfacultyrecords;
    private $interunirecords;

    public function __construct() {
        $this->freshersrecords = new Freshersrecords();
        $this->interfacultyrecords = new Interfacultyrecords();
        $this->interunirecords = new Interunirecords();
    }

    public function index() {
        $data = [
            'freshersrecords' => $this->freshersrecords->getFreshersrecords(),
            'interfacultyrecords' => $this->interfacultyrecords->getInterfacultyrecords(),
            'interunirecords' => $this->interunirecords->getIntrunirecords(),
        ];

        $this->view('sportscaptain/tournaments', $data);
    }

    public function addinterunirecords(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            try{

                $result = $this->interunirecords->addInterunirecords();
                if($result){
                    $_SESSION['success'] = 'Interuniversity record added successfully';
                }else{
                    $_SESSION['error'] = 'Faild to add interuniversity record';
                }
                }catch(Exception $e){
                    $_SESSION['error'] = $e->getMessage();
                }
            }
            header('Location: ' . ROOT . '/sportscaptain/tournaments');
            exit();
        }
    
    public function deleteinterunirecords() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['interunirecordid'] ?? null;
            if(!$id) {
                $_SESSION['error'] = 'Interuniversity record ID is required';
                header('Location:' . ROOT . '/sportscaptain/tournaments');
                exit();
            } else {
                try {
                    $result = $this->interunirecords->deleteInterunirecords($_POST['interunirecordid']);
                    if($result) {
                        $_SESSION['success'] = 'Interuniversity record deleted successfully';   
                    } else {
                        $_SESSION['error'] = 'Failed to delete interuniversity record';   
                    }
                } catch(Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                }   
            }
            header('Location:' . ROOT . '/sportscaptain/tournaments');
            exit();
        }
    }

    public function editinterunirecords() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['interunirecordid'] ?? null;
            if(!$id) {
                $_SESSION['error'] = 'Interuniversity record ID is required';
                header('Location: ' . ROOT . '/sportscaptain/tournaments');
                exit();
            } else {
                try {
                    $result = $this->interunirecords->editInterunirecords($id);
                    if($result) {
                        $_SESSION['success'] = 'Interuniversity record update successfully';
                    } else {
                        $_SESSION['error'] = 'Failed to update interuniversity record';
                    }
                } catch(Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                }
            }
            header('Location: ' . ROOT . '/sportscaptain/tournaments');
            exit();
        }
    }

    public function addinterfacultyrecords(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            try{
                $result = $this->interfacultyrecords->addInterfacultyrecords();
                if($result){
                    $_SESSION['success'] = 'Interfaculty record added successfully';
                }else{
                    $_SESSION['error'] = 'Fail to add interfaculty record';
                }
            }catch(Exception $e){
                $_SESSION['error'] = $e->getMessage();
            }

            header('Location: ' . ROOT . '/sportscaptain/tournaments');
            exit();
        }
    }

    public function editinterfacrecords() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {


            $id = $_POST['interfacrecid'] ?? null;
            if(!$id) {
                $_SESSION['error'] = 'Interfaculty record ID is required';
                header('Location: ' . ROOT . '/sportscaptain/tournaments');
                exit();
            } else {
                try {
                    
                    
                    $result = $this->interfacultyrecords->editInterfacultyrecords($id);
                    
                    if($result) {
                        $_SESSION['success'] = 'Interfaculty record updated successfully';
                    } else {
                        $_SESSION['error'] = 'Failed to update interfaculty record - no rows affected';
                    }
                } catch(Exception $e) {
                    error_log("Exception in editinterfacrecords: " . $e->getMessage());
                    $_SESSION['error'] = $e->getMessage();
                }
            }
            header('Location: ' . ROOT . '/sportscaptain/tournaments');
            exit();
        }
    }

    public function deleteinterfacrecords(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $id = $_POST['interfacrecid'] ?? null;
            if(!$id){

                $_SESSION['error'] = 'Interfaculty record ID is required';
                header('Location: ' . ROOT . '/sportscaptain/tournaments');
                exit();
            } else {
                try{

                    $result = $this->interfacultyrecords->deleteInterfacultyrecords($id);
                    if($result){
                        $_SESSION['success'] = 'Interfaculty record deleted successfully'; 
                    } else {
                        $_SESSION['error'] = 'Failed to delete interfaculty record - no rows affected'; 
                    }
                }catch(Exception $e){
                        $_SESSION['error'] = $e->getMessage();
                    }
                }
            }

            header('Location: ' . ROOT . '/sportscaptain/tournaments');
            exit();
     }

     public function addfreshersrecords(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            try{
                $result = $this->freshersrecords->addfreshersrecords();
                if($result){
                    $_SESSION['success'] = 'Freshers record added successfully';
                }else{
                    $_SESSION['error'] = 'Failed to add freshers record';
                }
            }catch(Exception $e){
                $_SESSION['error'] = $e->getMessage();
            }
            header('Location: ' . ROOT . '/sportscaptain/tournaments');
            exit();
        }
     }

     public function editfreshersrecords(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $id = $_POST['freshersid'] ?? null;
            if(!$id){
                $_SESSION['error'] = 'Freshers ID is required';
                header('Location: ' .ROOT . '/sportscaptain/tournaments');
                exit();
            }else{

                try{
                    $result = $this->freshersrecords->editFreshersrecords($id);
                    if($result){
                        $_SESSION['succeess'] = 'Freshers record update successfully';
                    }else{
                        $_SESSION['error'] = 'Failed to update freshers record';
                    }
                }catch(Exception $e){
                    $_SESSION['error'] = $e->getMessage();
                }
            }
            header('Location: ' . ROOT . '/sportscaptain/tournaments');
            exit();
        }
     }

     public function deletefreshersrecords(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $id = $_POST['freshersid'] ?? null;
            if(!$id){

                $_SESSION['error'] = 'Freshers record ID is required';
                header('Location: ' . ROOT . '/sportscaptain/tournaments');
                exit();
            }else{

                try{

                    $result = $this->freshersrecords->deleteFreshersrecords($id);
                    if($result){
                        $_SESSION['success'] = 'Freshers record delete successfully';
                    }else{
                        $_SESSION['error'] = 'Faild to delete freshers record'; 
                    }
                }catch(Exception $e){
                    $_SESSION['error'] = $e->getMessage();
                }
            }
            header('Location: ' . ROOT . '/sportscaptain/tournaments');
            exit();
        }
     }
}
    
