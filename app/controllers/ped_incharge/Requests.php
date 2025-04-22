<?php
class Requests extends Controller {
    public function index() {
        $reservationsModel = new Reservations();
        $newPendingReservations = $reservationsModel->getAllPendingReservations('new');
        $oldPendingReservations = $reservationsModel->getAllPendingReservations('old');
        $topayReservations = $reservationsModel->getAllTopayReservations();
        $paidReservations = $reservationsModel->getAllPaidReservations();
        $confirmedReservations = $reservationsModel->getAllConfirmedReservations();
        $rejectedReservations = $reservationsModel->getAllRejectedReservations();
        $this->view('ped_incharge/requests', ['newPendingReservations' => $newPendingReservations, 
                    'oldPendingReservations' => $oldPendingReservations, 
                    'topayReservations' => $topayReservations, 
                    'paidReservations' => $paidReservations, 
                    'confirmedReservations' => $confirmedReservations, 
                    'rejectedReservations' => $rejectedReservations]);
    }

    public function accept($reservationid){
        $acceptreservationmodel = new Reservations();
        $reservation = $acceptreservationmodel->findById($reservationid);
        $acceptreservationmodel->acceptReservation($reservation);
        header('location: ' . ROOT . '/ped_incharge/requests');
        exit;
    }

    public function reject($reservationid){
        $rejectreservationmodel = new Reservations();
        $reservation = $rejectreservationmodel->findById($reservationid);
        $rejectreservationmodel->rejectReservation($reservation);
        header('location: ' . ROOT . '/ped_incharge/requests');
        exit;
    }
}