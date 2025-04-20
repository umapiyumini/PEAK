<?php
class Baseballform extends Controller {

    // Display the baseball form
    public function index() {
        $this->view('external/baseballform');
    }

    public function getPrice() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $event = $_POST['bookingFor'];
            $duration = $_POST['duration'];
            $description = "no";
            $courtid = 24;
            $groundcourt = new Groundcourts();
            $price = $groundcourt->getPriceByDetails($event, $duration, $description, $courtid);
            echo json_encode(['price' => $price]);
        }
    }

    public function checkAvailability() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $date = $_POST['date'];
            $courtid = 24;

            $courtsModel = new Courts();
            $section = $courtsModel->getSectionByCourtid($courtid);

            $reservationsModel = new Reservations();
            $bookings = $reservationsModel->getBookingsForDateSection($date, $section);
            if (!is_array($bookings)) $bookings = [];

            $occupiedDurations = array_map(function($b) { return $b->duration; }, $bookings);
            $bookedHalfSlots = [];
            $booked2HourSlots = [];
            foreach ($bookings as $booking) {
                if ($booking->duration === 'half') {
                    $bookedHalfSlots[] = $booking->time;
                }
                if ($booking->duration === '2 hour') {
                    $booked2HourSlots[] = $booking->time;
                }
            }

            $halfDayToTwoHour = [
                '08:00:00' => ['08:00:00', '10:00:00'],
                '13:00:00' => ['13:00:00', '15:00:00']
            ];

            $twoHourToHalfDay = [
                '08:00:00' => '08:00:00',
                '10:00:00' => '08:00:00',
                '13:00:00' => '13:00:00',
                '15:00:00' => '13:00:00',
            ];

            $disable2HourSlots = $booked2HourSlots;
            foreach ($bookedHalfSlots as $halfSlot) {
                if (isset($halfDayToTwoHour[$halfSlot])) {
                    $disable2HourSlots = array_merge($disable2HourSlots, $halfDayToTwoHour[$halfSlot]);
                }
            }
            $disable2HourSlots = array_unique($disable2HourSlots);

            $disableHalfDaySlots = [];
            foreach ($booked2HourSlots as $slot) {
                if (isset($twoHourToHalfDay[$slot])) {
                    $disableHalfDaySlots[] = $twoHourToHalfDay[$slot];
                }
            }
            $disableHalfDaySlots = array_unique($disableHalfDaySlots);

            $response = [
                'full' => !(
                    in_array('full', $occupiedDurations) ||
                    count($bookedHalfSlots) > 0 ||
                    count($booked2HourSlots) > 0
                ),
                'half' => true,
                '2hour' => true,
                'bookedHalfSlots' => $bookedHalfSlots,
                'disable2HourSlots' => $disable2HourSlots,
                'disableHalfDaySlots' => $disableHalfDaySlots,
                'message' => ''
            ];

            if (in_array('full', $occupiedDurations)) {
                $response['full'] = false;
                $response['half'] = false;
                $response['2hour'] = false;
                $response['message'] = "Fully booked - no slots available on $date";
            }

            $morningCovered = in_array('08:00:00', $bookedHalfSlots) ||
                              (in_array('08:00:00', $disable2HourSlots) && in_array('10:00:00', $disable2HourSlots));
            $afternoonCovered = in_array('13:00:00', $bookedHalfSlots) ||
                                (in_array('13:00:00', $disable2HourSlots) && in_array('15:00:00', $disable2HourSlots));
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
            elseif (count($disable2HourSlots) > 0 && empty($response['message'])) {
                $response['message'] = "Some 2-hour slots are already booked on $date.";
            }

            $twoHourToHalfDay = [
                '08:00:00' => '08:00:00',
                '10:00:00' => '08:00:00',
                '13:00:00' => '13:00:00',
                '15:00:00' => '13:00:00',
            ];

            $disableHalfDaySlots = [];
            foreach ($booked2HourSlots as $slot) {
                if (isset($twoHourToHalfDay[$slot])) {
                    $disableHalfDaySlots[] = $twoHourToHalfDay[$slot];
                }
            }
            $disableHalfDaySlots = array_unique($disableHalfDaySlots);
            $response['disableHalfDaySlots'] = $disableHalfDaySlots;

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }

    public function reserve() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userid = $_SESSION['userid'];
            $courtid = 24;
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
                header("Location: " . ROOT . "/external/baseballform");
                exit;
            } else {
                echo "<script>alert('Reservation failed. Please try again.');</script>";
            }
        }
    }
}
