<?php
    class All_reservations_ground extends Controller{
        public function index(){
            $reservationsModel = new Reservations();
            $allReservations = $reservationsModel->getAllActiveReservationsGround();
            $this->view('ped_incharge/all_reservations_ground', ['allReservations' => $allReservations]);
        }
    }