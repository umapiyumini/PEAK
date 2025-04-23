<?php
class Ground_reservation extends Controller{
    public function index(){
        // Get the selected date from the request, default to today's date if not provided
        $selectedDate = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d'); 

        $reservationsModel = new Reservations();
        $allReservations = $reservationsModel->getReservations();

        $allTimeSlots = array("08:00:00 - 10:00:00", "10:00:00 - 12:00:00", "13:00:00 - 15:00:00", "15:00:00 - 17:00:00");
        $allSections = array("C", "D", "E", "F", "G");


        // Filter reservations by the selected date - IMPROVED VERSION
        $filteredReservations = array();
        foreach ($allReservations as $reservation) {
            // Format comparison to ensure consistent format
            $reservationDate = date('Y-m-d', strtotime($reservation->date));
                        
            if ($reservationDate === $selectedDate) {
                $filteredReservations[] = $reservation;
            }
        }
        
        $structured = array();

        // Build the structured array using filteredReservations
        foreach ($filteredReservations as $reservation) {
            $timeSlot = $reservation->time;
            $section = $reservation->section;
            $structured[$timeSlot][$section] = array(
                'status' => $reservation->status,
                'bookedBy' => $reservation->userid,
                'date' => $reservation->date
            );
        }

        $this->view('ped_incharge/ground_reservation', ['structured' => $structured, 'allTimeSlots' => $allTimeSlots, 'allSections' => $allSections,'selectedDate' => $selectedDate]);
    }
}