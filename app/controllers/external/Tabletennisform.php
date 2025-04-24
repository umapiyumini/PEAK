<?php

class Tabletennisform extends Controller {

    public function index() {
        $this->view('external/tabletennisform');
    }

    public function getPrice() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $event = $_POST['bookingFor'];
            $duration = $_POST['duration'];
            
            $courtid = 19; 
            $indoorcourt = new Indoorcourts();
            $price = $indoorcourt->getPriceByDetails($event, $duration, $courtid);
            echo json_encode(['price' => $price]);
        }
    }

  
    public function checkAvailability() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $date = $_POST['date'];
            $courtid = 19; // Use the correct court ID for badminton
    
            $courtsModel = new Courts();
            $section = $courtsModel->getSectionByCourtid($courtid);
    
            $reservationsModel = new Reservations();
            $bookings = $reservationsModel->getBookingsForDateSection($date, $section);
            if (!is_array($bookings)) $bookings = [];
    
            $occupiedDurations = array_map(function($b) { return $b->duration; }, $bookings);
            $bookedHalfSlots = [];
            $bookedOneHourSlots = [];
            foreach ($bookings as $booking) {
                if ($booking->duration === 'half') {
                    $bookedHalfSlots[] = $booking->time;
                }
                if ($booking->duration === '1 hour') {
                    $bookedOneHourSlots[] = $booking->time;
                }
            }
    
            // Map half-day slots to their corresponding 1-hour slots
            $halfDayToOneHour = [
                '08:00:00' => ['08:00:00', '09:00:00', '10:00:00', '11:00:00', '12:00:00'],
                '13:00:00' => ['13:00:00', '14:00:00', '15:00:00', '16:00:00', '17:00:00']
            ];
    
            // Map 1-hour slots to their corresponding half-day slot
            $oneHourToHalfDay = [];
            foreach ($halfDayToOneHour as $half => $hours) {
                foreach ($hours as $hour) {
                    $oneHourToHalfDay[$hour] = $half;
                }
            }
    
            // Disable 1-hour slots that are already booked OR overlap with booked half-day slots
            $disableOneHourSlots = $bookedOneHourSlots;
            foreach ($bookedHalfSlots as $halfSlot) {
                if (isset($halfDayToOneHour[$halfSlot])) {
                    $disableOneHourSlots = array_merge($disableOneHourSlots, $halfDayToOneHour[$halfSlot]);
                }
            }
            $disableOneHourSlots = array_unique($disableOneHourSlots);
    
            // Disable half-day slots that overlap with booked 1-hour slots
            $disableHalfDaySlots = [];
            foreach ($bookedOneHourSlots as $slot) {
                if (isset($oneHourToHalfDay[$slot])) {
                    $disableHalfDaySlots[] = $oneHourToHalfDay[$slot];
                }
            }
            $disableHalfDaySlots = array_unique($disableHalfDaySlots);
    
            // Default: all durations enabled unless booked
            $response = [
                'full' => !(
                    in_array('full', $occupiedDurations) ||
                    count($bookedHalfSlots) > 0 ||
                    count($bookedOneHourSlots) > 0
                ),
                'half' => true,
                '1hour' => true,
                'bookedHalfSlots' => $bookedHalfSlots,
                'bookedOneHourSlots' => $bookedOneHourSlots,
                'disableOneHourSlots' => $disableOneHourSlots,
                'disableHalfDaySlots' => $disableHalfDaySlots,
                'message' => ''
            ];
    
            // If full day is booked, disable everything
            if (in_array('full', $occupiedDurations)) {
                $response['full'] = false;
                $response['half'] = false;
                $response['1hour'] = false;
                $response['message'] = "Fully booked - no slots available on $date";
            }
    
            // Check if both halves are covered (by half-day or all 1-hour slots in that half)
            $morningCovered = in_array('08:00:00', $bookedHalfSlots) ||
                              (count(array_intersect($disableOneHourSlots, $halfDayToOneHour['08:00:00'])) === count($halfDayToOneHour['08:00:00']));
            $afternoonCovered = in_array('13:00:00', $bookedHalfSlots) ||
                                (count(array_intersect($disableOneHourSlots, $halfDayToOneHour['13:00:00'])) === count($halfDayToOneHour['13:00:00']));
            $bothHalfDaysBooked = $morningCovered && $afternoonCovered;
    
            if ($bothHalfDaysBooked) {
                $response['full'] = false;
                $response['half'] = false;
                if (empty($response['message'])) {
                    $response['message'] = "Full day is not available as all time slots are booked on $date.";
                }
            }
    
            if (in_array('08:00:00', $bookedHalfSlots) && in_array('13:00:00', $bookedHalfSlots) && empty($response['message'])) {
                $response['half'] = false;
                $response['message'] = "All half-day slots are booked on $date.";
            }
            elseif (count($bookedHalfSlots) === 1 && empty($response['message'])) {
                $slot = $bookedHalfSlots[0] === "08:00:00" ? "08:00 - 13:00" : "13:00 - 18:00";
                $response['message'] = "The $slot half-day slot is already booked on $date.";
            }
            elseif (count($disableOneHourSlots) > 0 && empty($response['message'])) {
                $response['message'] = "Some 1-hour slots are already booked on $date.";
            }
    
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }
    
    public function reserve() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userid = $_SESSION['userid'];
            $courtid = 19;
            $courtsModel = new Courts();
            $section = $courtsModel->getSectionByCourtid($courtid);

            $event = $_POST['bookingFor'];
            $duration = $_POST['duration'];
            $date = $_POST['date'];
            $time = ($duration === 'full') ? '08:00:00' : $_POST['time_slot'];
            $usertype = $_POST['userType'];
            $userdescription = $_POST['userdetail'];
            $numberof_participants = $_POST['participants'];
            $extradetails = $_POST['extraDetails'];
            $price = $_POST['price'];
            $discountedprice = $_POST['discountedPrice'];
            $status = 'pending';
            $occupied = 1;
            $created_at = date('Y-m-d H:i:s');

            $userproof = '';
            if (isset($_FILES['proof']) && $_FILES['proof']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'C:/xampp1/htdocs/PEAK/uploads/user_proofs/';
                $filename = uniqid() . '_' . basename($_FILES['proof']['name']);
                $targetFile = $uploadDir . $filename;
                if (move_uploaded_file($_FILES['proof']['tmp_name'], $targetFile)) {
                    $userproof = $targetFile;
                }
            }

            $data = [
                'userid' => $userid,
                'courtid' => $courtid,
                'section' => $section,
                'event' => $event,
                'duration' => $duration,
                'date' => $date,
                'time' => $time,
                'status' => $status,
                'usertype' => $usertype,
                'userdescription' => $userdescription,
                'userproof' => $userproof,
                'numberof_participants' => $numberof_participants,
                'extradetails' => $extradetails,
                'price' => $price,
                'discountedprice' => $discountedprice,
                'occupied' => $occupied,
                'created_at' => $created_at,
            ];

            $reservationsModel = new Reservations();
            $result = $reservationsModel->insert($data);

            if ($result) {
                $_SESSION['reservation_success'] = true;
                header("Location: " . ROOT . "/external/tabletennisform");
                exit;
            } else {
                echo "<script>alert('Reservation failed. Please try again.');</script>";
            }
        }
    }
}
