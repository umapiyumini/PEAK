<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/reservation.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <style>
        .container {
            margin: 0 auto;
            padding: 20px;
            width: 100%;
            line-height: 1.8;
        }
        
        header {
            background-color: var(--primary);
            color: white;
            padding: 20px 0;
            margin-bottom: 30px;
        }
        
        header h1 {
            text-align: center;
        }
        
        .date-selector {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }
        
        .date-selector input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .color-manual {
            background: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .color-manual h3 {
            margin-bottom: 10px;
        }
        
        .color-indicators {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .color-item {
            display: flex;
            align-items: center;
            margin-right: 15px;
        }
        
        .color-box {
            width: 20px;
            height: 20px;
            margin-right: 8px;
            border-radius: 3px;
        }
        
        .internal {
            background-color: var(--res-sports);
        }
        
        .external {
            background-color: var(--res-external);
        }
        
        .special {
            background-color: var(--res-special);
        }
        
        .paid-reservations {
            background-color: #e0e0e0;
        }
        
        .time-slots-container {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        
        .time-slots-header {
            display: grid;
            grid-template-columns: 100px repeat(5, 1fr);
            gap: 10px;
            margin-bottom: 15px;
            font-weight: bold;
            text-align: center;
            padding: 10px 0;
            background-color: #f1f5f9;
            border-radius: 4px;
        }
        
        
        .time-label {
            font-weight: bold;
        }
        
        .section {
            border: 1px solid #333;
            border-radius: 4px;
            padding: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 14px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .section:hover {
            transform: scale(1.03);
            white-space: normal; /* Show full text on hover */
            z-index: 1;
        }
        
        .available {
            background-color: #f1f5f9;
            color: #333;
        }
        
        .booked-external {
            background-color: rgba(76, 175, 80, 0.3);
            color: #2e7d32;
            border: 1px solid #4CAF50;
        }
        
        .booked-internal {
            background-color: rgba(33, 150, 243, 0.3);
            color: #0d47a1;
            border: 1px solid #2196F3;
        }
        
        .booked-special {
            background-color: rgba(255, 152, 0, 0.3);
            color: #e65100;
            border: 1px solid #FF9800;
        }
        
        .payment-pending {
            background-color: #e0e0e0;
            color: #424242;
            border: 1px solid #9e9e9e;
        }

        .time-slots-content {
             display: grid;
            grid-template-rows: repeat(<?= count($allTimeSlots) ?>, auto);
        }

        .time-slot {
            display: contents; 
        }

        .time-label, .section {
            padding: 5px;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .time-slots-content {
            display: grid;
            grid-template-columns: 100px repeat(5, 1fr);
            gap: 10px;
        }

        /* Style for cells that span multiple rows */
        .section[style*="grid-row: span"] {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }


        @media (max-width: 768px) {
            .time-slots-header, .time-slot {
                grid-template-columns: 80px repeat(5, 1fr);
                font-size: 14px;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 10px;
            }
            
            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    
    <?php $current_page = 'reservation'; include 'sidebar.view.php';?>

    <!-- Header and Main Content -->

    <div class="main-content">
        <div class="header">
            <h1>Ground reservations</h1>
            <button class="bell-icon"><i class="uil uil-bell"></i></button>

            <button class="bell-icon"><i class="uil uil-signout"></i></button>
        </div>

        <div class="container">
        <div class="date-selector">
            <input type="date" id="reservation-date" value="<?= isset($selectedDate) ? $selectedDate : date('Y-m-d') ?>" onchange="changeDate()">
        </div>

            <div class="color-manual">
                <h3>Booking Legend</h3>
                <div class="color-indicators">
                    <div class="color-item">
                        <div class="color-box internal"></div>
                        <span>Internal Bookings</span>
                    </div>
                    <div class="color-item">
                        <div class="color-box external"></div>
                        <span>External Bookings</span>
                    </div>
                    <div class="color-item">
                        <div class="color-box special"></div>
                        <span>Special Bookings</span>
                    </div>
                    <div class="color-item">
                        <div class="color-box paid-reservations"></div>
                        <span>Payment Pending/Paid</span>
                    </div>
                </div>
            </div>

            <div class="action-buttons">
                <button class="button" onclick="window.location.href='requests';">Requests</button>
                <button class="button" onclick="window.location.href='all_reservations_ground';">All reservations</button>
                <button class="button" onclick="openModal()" >Make a Reservation</button>
            </div>

            <div class="time-slots-container" id="time-slots">
                <h2 id="availability-date">Ground Availability</h2>

                    <div class="time-slots-header">
                        <div>Time</div>
                            <?php foreach ($allSections as $section): ?>
                                <div>Section <?= $section ?></div>
                            <?php endforeach; ?>
                    </div>

                    <div class="time-slots-content" id="slots-container">
                    <?php 
                            $processed = []; // Keep track of slots we've already handled
                            
                            foreach ($allTimeSlots as $timeIndex => $time): ?>
                                <div class="time-slot">
                                    <div class="time-label"><?= $time ?></div>
                                    <?php foreach ($allSections as $section): 
                                        $slotKey = "$timeIndex-$section";
                                        
                        // Skip this cell if it's been covered by a previous span
                        if (isset($processed[$slotKey])) {
                            continue;
                        }
                        
                        $data = $structured[$time][$section] ?? ['status' => 'available', 'bookedBy' => null, 'event' => null, 'userType' => null, 'span' => 1];
                        
                        // Get the event name to display
                        $displayText = !empty($data['event']) ? $data['event'] . ' (ID: ' . $data['reservationid'] . ', Name: ' . $data['name'] . ')': 'Available';
                        
                        // Determine CSS class based on booking status and type
                        if($data['status'] == 'available') {
                            $sectionClass = 'available';
                        } 
                        elseif($data['status'] == 'paid' || $data['status'] == 'To pay') {
                            $sectionClass = 'payment-pending';
                        }
                        elseif($data['status'] == 'confirmed') {
                            switch(strtolower($data['userType'])) {
                                case 'sports captain':
                                    $sectionClass = 'booked-internal';
                                    break;
                                case 'external user':
                                    $sectionClass = 'booked-external';
                                    break;
                                case 'admin':
                                    $sectionClass = 'booked-special';
                                    break;
                                default:
                                    $sectionClass = 'booked-internal';
                            }
                        }
                        else {
                            $sectionClass = 'available';
                        }
                        
                        // Add status information to title attribute
                        $statusInfo = '';
                        if($data['status'] == 'paid') {
                            $statusInfo = ' (Paid)';
                        } elseif($data['status'] == 'To pay') {
                            $statusInfo = ' (To Pay)';
                        } elseif($data['status'] == 'confirmed') {
                            $statusInfo = ' (' . ucfirst($data['userType']) . ')';
                        }
                        
                        // Set grid-row-span for multi-slot reservations
                        $span = isset($data['span']) ? $data['span'] : 1;
                        $spanStyle = ($span > 1) ? 'grid-row: span '.$span.';' : '';
                
                // If this is a spanning slot, mark future slots as processed
                if ($span > 1) {
                    for ($i = 0; $i < $span; $i++) {
                        if ($timeIndex + $i < count($allTimeSlots)) {
                            $processed[($timeIndex + $i)."-$section"] = true;
                        }
                    }
                }
            ?>
                <div class="section <?= $sectionClass ?>"
                     style="<?= $spanStyle ?>"
                     title="<?= htmlspecialchars($displayText . $statusInfo) ?>">
                    <?= htmlspecialchars($displayText) ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>
</div>


    <!-- New Reservation Modal -->
<div id="reservationModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Make a New Reservation</h2>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <div class="modal-body">
            <form id="newReservationForm" method="POST" action="<?=ROOT?>/ped_incharge/save_reservation">
                <!-- Hidden user ID from session -->
                <!-- <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>"> -->
                
                <div class="form-group">
                    <label for="event_name">Event Name:</label>
                    <input type="text" id="event_name" name="event" required>
                </div>
                
                <div class="form-group">
                    <label for="event_date">Date:</label>
                    <input type="date" id="event_date" name="date" required min="<?= date('Y-m-d') ?>">
                </div>
                
                <div class="form-row">
                    <div class="form-group half">
                        <label for="start_time">Start Time:</label>
                        <input type="time" id="start_time" name="start_time" required>
                    </div>
                    
                    <div class="form-group half">
                        <label for="end_time">End Time:</label>
                        <input type="time" id="end_time" name="end_time" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="section">Ground Section:</label>
                    <select id="section" name="section" required>
                        <option value="">Select a section</option>
                        <option value="C">Section C</option>
                        <option value="D">Section D</option>
                        <option value="E">Section E</option>
                        <option value="F">Section F</option>
                        <option value="G">Section G</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="reserved_by">Reserved By:</label>
                    <input type="text" id="reserved_by" name="reserved_by" required>
                </div>
                
                <div class="form-group">
                    <label for="reservation_type">Reservation Type:</label>
                    <select id="reservation_type" name="reservation_type" required>
                        <option value="">Select type</option>
                        <option value="internal">Internal</option>
                        <option value="external">External</option>
                        <option value="special">Special</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="participants">Number of Participants:</label>
                    <input type="number" id="participants" name="participants" min="1" required>
                </div>
                
                <div class="form-group">
                    <label for="notes">Additional Notes:</label>
                    <textarea id="notes" name="notes" rows="3"></textarea>
                </div>
                
                <div class="form-actions">
                    <button type="button" class="btn btn-cancel" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn btn-submit">Submit Reservation</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <script>
        // Function to change the date and reload the page with the selected date
        function changeDate() {
            const dateInput = document.getElementById('reservation-date').value;
            window.location.href = window.location.pathname + '?date=' + dateInput;
        }

        // Format date for display
        function updateDisplayDate() {
            const dateInput = document.getElementById('reservation-date').value;
            const availabilityDate = document.getElementById('availability-date');
            
            // Format date for display
            const displayDate = new Date(dateInput).toLocaleDateString('en-US', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            
            availabilityDate.textContent = `Ground Availability for ${displayDate}`;
        }

        // When the page loads, update the display date
        document.addEventListener('DOMContentLoaded', function() {
            // Only set it to today if it's empty
            if (!document.getElementById('reservation-date').value) {
                const today = new Date();
                const formattedDate = today.toISOString().split('T')[0];
                document.getElementById('reservation-date').value = formattedDate;
            }
            
            // Always update the display date
            updateDisplayDate();
        });

        // Get the modal element
        const modal = document.getElementById("reservationModal");
        
        // Function to open the modal
        function openModal() {
            modal.style.display = "block";
            document.body.style.overflow = "hidden"; // Prevent scrolling behind modal
            
            // Set the current selected date in the form
            const calendarDate = document.getElementById("reservation-date").value;
            if (calendarDate) {
                document.getElementById("event_date").value = calendarDate;
            } else {
                const today = new Date().toISOString().split('T')[0];
                document.getElementById("event_date").value = today;
            }
        }
        
        // Function to close the modal
        function closeModal() {
            modal.style.display = "none";
            document.body.style.overflow = "auto"; // Restore scrolling
        }
        
        // When the user clicks anywhere outside of the modal, close it
        window.addEventListener("click", function(event) {
            if (event.target == modal) {
                closeModal();
            }
        });
        
        // Form validation before submission
        document.getElementById("newReservationForm").addEventListener("submit", function(event) {
            const startTime = document.getElementById("start_time").value;
            const endTime = document.getElementById("end_time").value;
            
            // Check if end time is after start time
            if (startTime >= endTime) {
                event.preventDefault();
                alert("End time must be after start time");
            }
        });
    </script>

    <script src="<?=ROOT?>/assets/js/ped_incharge/home.js"></script>
    <script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
    <script src="<?=ROOT?>/assets/js/ped_incharge/reservation.js"></script>
</body>
</html>