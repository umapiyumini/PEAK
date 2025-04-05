<?php
class Tournaments extends Controller{
   public function index(){

        $this->view('sportscaptain/tournaments');

    private $tournamentdetailsModel;
    
    public function __construct(){
        $this->tournamentdetailsModel = $this->model('Tournamentdetails'); 
    }

    public function index(){

        $freshersrecords = $this->tournamentdetailsModel->getfreshersrecords();
        $interfacultyrecords = $this->tournamentdetailsModel->getinterfacultyrecords();
        $interunirecords = $this->tournamentdetailsModel->getinterunirecords();

        $this->view('sportscaptain/tournaments', ['freshersrecords' => $freshersrecords, 'interfacultyrecords' => $interfacultyrecords, 'interunirecords' => $interunirecords]);
    }

   

}