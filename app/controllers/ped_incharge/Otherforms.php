<?php
    class Otherforms extends Controller{
        public function index(){
            $certificatemodel= new Certificates();
            $medicalmodel= new MedicalRequest();
            $transportrequestmodel = new TransportRequests();
            // $coloursnightmodel = new ColoursNight();
            // $hostalfacilitiesmodel = new HostalFacilities();
            $allmedical= $medicalmodel->viewAllMedicalRequests();
            $allcertificates= $certificatemodel->viewAllCertificateRequests();
            $alltransport = $transportrequestmodel-> viewAllTransportRequests();
            $this->view('ped_incharge/otherforms', ['allcertificates'=> $allcertificates, 'allmedical'=> $allmedical, 'alltransport'=>$alltransport]);
        }

        public function handleAction($type, $action, $id) {
            if($type == 'certificates') {
                $model = new Certificates();
            } 
            else if($type == 'medical') {
                $model = new MedicalRequest();
            }
            else if($type == 'transport') {
                $model = new TransportRequests();
            } 

            $result = $model->handleAction($id, $action);

            if($result['success']) {
                $_SESSION['success'] = ucfirst($action) . "ed Successfully!";
            }
            else{
                $_SESSION['error'] = "Error: ".ucfirst($action)." unsuccessful!";
            }
            header(header('Location: '. ROOT .'/ped_incharge/otherforms'));
        }


    
        public function markCertificateReady($id){

            $model = new Certificates();

            $result = $model->markCertificateReady($id);

            if ($result['success']) {
                $_SESSION['success'] = $result['message'];
            } else {
                $_SESSION['error'] = $result['message'];
            }

            header('Location: ' . ROOT . '/ped_incharge/otherforms');
            exit;
        }

    }