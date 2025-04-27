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
        $cancelledReservation = $reservationsModel->getAllCancelledReservations();

        $activeReservations = $reservationsModel->getAllPaidTopayConfirmedReservations();

        //flag for conflicting reservations
        $flagConflicts = function (&$pendingList) use ($activeReservations, $reservationsModel) {
            if (!is_array($pendingList)) return;
    
            foreach ($pendingList as &$pending) {
                $pending->has_conflict = false;
                foreach ($activeReservations as $active) {
                    if (
                        $pending->date == $active->date &&
                        $pending->section == $active->section &&
                        $reservationsModel->isTimeOverlapping($pending, $active)
                    ) {
                        $pending->has_conflict = true;
                        break;
                    }
                }
            }
        };
    
        $flagConflicts($newPendingReservations);
        $flagConflicts($oldPendingReservations);

        $this->view('ped_incharge/requests', ['newPendingReservations' => $newPendingReservations, 'oldPendingReservations' => $oldPendingReservations, 'topayReservations' => $topayReservations, 'paidReservations' => $paidReservations, 'confirmedReservations' => $confirmedReservations, 'rejectedReservations' => $rejectedReservations, 'cancelledReservation'=>$cancelledReservation]);
    }


    public function accept($reservationid){
        $acceptreservationmodel = new Reservations();
        $reservation = $acceptreservationmodel->findById($reservationid);

        $acceptreservationmodel->acceptReservation($reservation);
        
        // After accepting, check and reject any conflicting pending reservations
        // $rejectedCount = $acceptreservationmodel->rejectConflictingReservations();
        
        // if ($rejectedCount > 0) {
        //     $_SESSION['message'] = "$rejectedCount conflicting reservation(s) were automatically rejected.";
        // }
        
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