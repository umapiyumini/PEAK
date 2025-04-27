<?php
class Indoor_requests extends Controller {
    public function index() {
        $reservationsModel = new Reservations();
        $newPendingReservations = $reservationsModel->getAllIndoorPendingReservations('new');
        $oldPendingReservations = $reservationsModel->getAllIndoorPendingReservations('old');        
        $topayReservations = $reservationsModel->getAllIndoorTopayReservations();
        $paidReservations = $reservationsModel->getAllIndoorPaidReservations();
        $confirmedReservations = $reservationsModel->getAllIndoorConfirmedReservations();
        $rejectedReservations = $reservationsModel->getAllInddorRejectedReservations();
        
        $cancelledReservation = $reservationsModel->getAllIndoorCancelledReservations();
        $activeReservations = $reservationsModel->getActiveReservationsIndoor();

        //flag for conflicting reservations
        $flagConflicts = function (&$pendingList) use ($activeReservations, $reservationsModel) {
            if (!is_array($pendingList)) return;
    
            foreach ($pendingList as &$pending) {
                $pending->has_conflict = false;
                foreach ($activeReservations as $active) {
                    if (
                        $pending->date == $active->date &&
                        $pending->courtid == $active->courtid &&
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

        $this->view('ped_incharge/indoor_requests', ['newPendingReservations' => $newPendingReservations, 'oldPendingReservations' => $oldPendingReservations, 'topayReservations' => $topayReservations, 'paidReservations' => $paidReservations, 'confirmedReservations' => $confirmedReservations, 'rejectedReservations' => $rejectedReservations, 'cancelledReservation'=> $cancelledReservation]);
    }


    public function accept($reservationid){
        $acceptreservationmodel = new Reservations();
        $reservation = $acceptreservationmodel->findById($reservationid);

        $acceptreservationmodel->acceptReservation($reservation);

        header('location: ' . ROOT . '/ped_incharge/indoor_requests');
        exit;
    }

    public function reject($reservationid){
        $rejectreservationmodel = new Reservations();
        $reservation = $rejectreservationmodel->findById($reservationid);
        $rejectreservationmodel->rejectReservation($reservation);
        header('location: ' . ROOT . '/ped_incharge/indoor_requests');
        exit;
    }


}