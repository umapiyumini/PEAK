<?php
class Requests extends Controller {
    public function index() {
        $reservationsModel = new Reservations();
        $newPendingReservations = $reservationsModel->getAllPendingReservations('new');
        $oldPendingReservations = $reservationsModel->getAllPendingReservations('old');
        $topayReservations = $reservationsModel->getAllTopayReservations();
        $paidReservations = $reservationsModel->getAllPaidReservations();
        $this->view('ped_incharge/requests', ['newPendingReservations' => $newPendingReservations, 'oldPendingReservations' => $oldPendingReservations, 'topayReservations' => $topayReservations, 'paidReservations' => $paidReservations]);
    }

    public function accept($reservationid){
        $acceptreservationmodel = new Reservations();
        $acceptreservationmodel->acceptReservation($reservationid);
        header('location: ' . ROOT . '/ped_incharge/requests');
        exit;

    }
}