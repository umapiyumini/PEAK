<?php
    class All_reservations_indoor extends Controller{
        public function index(){
            $reservationsModel = new Reservations();
            $allReservations = $reservationsModel->getAllActiveReservationsIndoor();
            $this->view('ped_incharge/all_reservations_indoor', ['allReservations' => $allReservations]);
        }
    }