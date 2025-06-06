<?php
class Baseballform extends Controller {

    
    public function index() {
        $this->view('external/baseballform');
    }

    public function getPrice() {
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          
            $courtName = $_POST['court_name'] ?? '';
            $event = $_POST['event'] ?? '';
            $duration = $_POST['duration'] ?? '';
            $description = $_POST['description'] ?? '';
            
            
            if (empty($courtName) || empty($event) || empty($duration) || empty($description)) {
                echo 'Missing required parameters';
                return;
            }
            
            $groundcourts = new Groundcourts();
            $price = $groundcourts->getPriceByCourtName($event, $duration, $description, $courtName);
            
            
            if ($price !== null) {
                echo $price;
            } else {
                echo "Price not found";
            }
        } else {
            echo "Invalid request method";
        }
        
        
        exit;
    }
    
    
    
    
    public function getDiscount() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          
            $userType = $_POST['usertype'] ?? '';
            $price = $_POST['price'] ?? '';
            
            
            
            if (empty($userType) || empty($price) ) {
                echo 'Missing required parameters';
                return;
            }
            $price = floatval($price);
    
            $discounts = new Discounts();
            $discount = $discounts->getDiscountByUserType($userType);
           
            
            if ($discount !== null) {
                $discountedPrice = $price - ($price * $discount);
                echo number_format($discountedPrice,2,'.','');
            } else {
                echo "discount not found";
            }
        } else {
            echo "Invalid request method";
        }
        
        
        exit;
    }
    
    public function checkFullDayAvailability() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $date = $_POST['date'] ?? '';
            $courtName = $_POST['court_name'] ?? '';
    
            if (empty($date) || empty($courtName)) {
                echo 'Missing parameters';
                return;
            }
    
           
            $courts = new Courts();
            $court = $courts->getCourtByName($courtName);
            if (!$court) {
                echo 'Court not found';
                return;
            }
    
            $section = $court->section;
    
    
            
            
            $reservations = new Reservations();
            $isBooked = $reservations->isFullDayBooked($date, $section);
    
            
            echo $isBooked ? 'full' : 'available';
        } else {
            echo 'Invalid request method';
        }
        exit;
    }
    
    
    
    public function checkHalfDayAvailability() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $date = $_POST['date'] ?? '';
            $courtName = $_POST['court_name'] ?? '';
    
            if (empty($date) || empty($courtName)) {
                echo 'Missing parameters';
                return;
            }
    
         
            $courts = new Courts();
            $court = $courts->getCourtByName($courtName);
            if (!$court) {
                echo 'Court not found';
                return;
            }
    
            $section = $court->section;
    
        
            $reservations = new Reservations();
            $bookedHalfDaySlots = $reservations->getBookedHalfDaySlots($date, $section);
            
            
            $bookedTwoHourSlots = $reservations->getBookedTwoHourSlots($date, $section);
            
      
            $halfDayStatus = 'none';
            if (in_array('08:00:00', $bookedHalfDaySlots) && in_array('13:00:00', $bookedHalfDaySlots)) {
                $halfDayStatus = 'both';
            } else if (in_array('08:00:00', $bookedHalfDaySlots)) {
                $halfDayStatus = 'morning';
            } else if (in_array('13:00:00', $bookedHalfDaySlots)) {
                $halfDayStatus = 'afternoon';
            }
            
            
            $response = $halfDayStatus . '|';
            
            
            if (!empty($bookedTwoHourSlots)) {
                $response .= implode(',', $bookedTwoHourSlots);
            }
            
            echo $response;
        } else {
            echo 'Invalid request method';
        }
        exit;
    }
    
    
    
public function checkTwoHourAvailability() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $date = $_POST['date'] ?? '';
        $courtName = $_POST['court_name'] ?? '';

        if (empty($date) || empty($courtName)) {
            echo 'Missing parameters';
            return;
        }

        
        $courts = new Courts();
        $court = $courts->getCourtByName($courtName);
        if (!$court) {
            echo 'Court not found';
            return;
        }

        $section = $court->section;

        
        $reservations = new Reservations();
        $bookedTwoHourSlots = $reservations->getBookedTwoHourSlots($date, $section);
        
       
        echo implode(',', $bookedTwoHourSlots);
    } else {
        echo 'Invalid request method';
    }
    exit;
}

    
    public function reserve() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $userid = $_SESSION['userid'];
            $courtName = $_POST['court_name'] ?? '';
            $courts = new Courts();
            $court = $courts->getCourtByName($courtName);
            if (!$court) {
                echo 'Court not found';
                return;
            }
    
            $courtid = $court->courtid;
    
           
    
          
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
                'created_at' => $created_at,
            ];
    
            
            $reservationsModel = new Reservations();
            $result = $reservationsModel->insert($data);
    
            if ($result) {
                session_start();
                $_SESSION['reservation_success'] = true;
                header("Location: " . ROOT . "/external/baseballform"); 
    
                exit;
            } else {
                echo "<script>alert('Reservation failed. Please try again.');</script>";
            }
            
    }
    
    
    }
    
    }
    
