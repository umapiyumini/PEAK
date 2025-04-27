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
            position: relative;
            min-height: 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
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

/* Add these CSS rules to your existing style section */

/* Highlight available slots as clickable */
.section.available {
    background-color: #f1f5f9;
    color: #333;
    cursor: pointer;
    transition: all 0.2s ease;
}

.section.available:hover {
    background-color: #e3e8f0;
    transform: scale(1.03);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.section.available::after {
    content: "Click to reserve";
    display: block;
    font-size: 10px;
    color: #6b7280;
    font-style: italic;
    margin-top: 2px;
}

.section:not(.available) {
    cursor: default;
}

.section.rejected {
    background-color: #f1f5f9;
    color: #333;
    cursor: pointer;
    transition: all 0.2s ease;
}

.section.rejected:hover {
    background-color: #e3e8f0;
    transform: scale(1.03);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.section.rejected::after {
    content: "Click to reserve";
    display: block;
    font-size: 10px;
    color: #6b7280;
    font-style: italic;
    margin-top: 2px;
}
.modal-content {
    max-width: 600px;
    max-height: 90vh;
    overflow-y: auto;
}

#duration {
    font-weight: bold;
}

.cancel-button {
    display: block;
    margin-top: 5px;
    padding: 2px 5px;
    background-color: #ff5252;
    color: white;
    border: none;
    border-radius: 3px;
    font-size: 11px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.cancel-button:hover {
    background-color: #d32f2f;
    transform: scale(1.05);
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

    <?php
        if (isset($_SESSION['error'])) {
            echo "<div id='error-message' style='position: fixed ;top: 20px; right: 20px;background-color:rgb(206, 29, 29);color: white; padding: 15px 20px; border-radius: 5px; z-index: 9999; box-shadow: 0 2px 10px rgba(0,0,0,0.2); transition: opacity 0.5s ease-out;'>"
                . htmlspecialchars($_SESSION['error']) . "</div>";
            unset($_SESSION['error']);
        }

        if (isset($_SESSION['success'])) {
            echo "<div id='success-message' style='position: fixed ;top: 20px; right: 20px;background-color:rgb(57, 184, 11);color: white; padding: 15px 20px; border-radius: 5px; z-index: 9999; box-shadow: 0 2px 10px rgba(0,0,0,0.2); transition: opacity 0.5s ease-out;'>"
                . htmlspecialchars($_SESSION['success']) . "</div>";
            unset($_SESSION['success']);
        }
    ?>
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
                            $processed = []; //keep track of process handled
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
                        
                        $displayText = !empty($data['event']) ? $data['event'] . ' (ID: ' . $data['reservationid'] . ', Name: ' . $data['name'] . ')': 'Available';
                
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
                        
                        $statusInfo = '';
                        if($data['status'] == 'paid') {
                            $statusInfo = ' (Paid)';
                        } elseif($data['status'] == 'To pay') {
                            $statusInfo = ' (To Pay)';
                        } elseif($data['status'] == 'confirmed') {
                            $statusInfo = ' (' . ucfirst($data['userType']) . ')';
                        }
                        
                        $span = isset($data['span']) ? $data['span'] : 1;
                        $spanStyle = ($span > 1) ? 'grid-row: span '.$span.';' : '';
                
                if ($span > 1) {
                    for ($i = 0; $i < $span; $i++) {
                        if ($timeIndex + $i < count($allTimeSlots)) {
                            $processed[($timeIndex + $i)."-$section"] = true;
                        }
                    }
                }
            ?>
                <?php 
                    $isPastDate = $selectedDate < date('Y-m-d');
                    $canReserve = $data['status'] == 'available' && !$isPastDate;
                ?>
                <div class="section <?= $sectionClass ?>"
                    style="<?= $spanStyle ?>"
                    title="<?= htmlspecialchars($displayText . $statusInfo) ?>"
                    <?= ($data['status'] == 'available') ? 'onclick="openReservationModal(\'' . $time . '\', \'' . $section . '\')"' : '' ?>>
                    <?= htmlspecialchars($displayText) ?>
                    <?php if ($sectionClass == 'booked-special'): ?>
                        <button class="cancel-button" onclick="cancelReservation(<?= $data['reservationid'] ?>)">Cancel</button>
                    <?php endif; ?>
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
            <span class="close" onclick="closeModal('reservationModal')">&times;</span>
        </div>
        <div class="modal-body">
            <form id="newReservationForm" method="POST" action="ground_reservation/saveReservation">
                <div class="form-group">
                    <label for="event_name">Event Name:</label>
                    <select id="event_name" name="event" required>
                        <option value="">-- Select Event --</option>
                        <option value="practice">Practice</option>
                        <option value="tournament">Tournament</option>
                        <option value="other">Other</option>
                    </select>
                </div> 
                <div class="form-group">
                    <label for="event_date">Date:</label>
                    <input type="date" id="event_date" name="date" readonly min="<?= date('Y-m-d') ?>">
                </div>
                
                <div class="form-row">
                    <div class="form-group half">
                        <label for="start_time">Start Time:</label>
                        <input type="time" id="start_time" name="time" readonly>
                    </div>
                    
                    <div class="form-group half">
                        <label for="duration">Duration:</label>
                        <select id="duration" name="duration" required>
                            <option value="">Select a duration</option>
                            <option value="2 hour">2 Hours</option>
                            <option value="half">Half Day</option>
                            <option value="full">Full Day</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="section">Section:</label>
                    <select id="section" name="section" disabled onchange="populateCourts(this.value)">
                        <option value="">Select a section</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="G">G</option>
                    </select>
                    <input type="hidden" id="hiddensection" name="section">
                </div>

                <div class="form-group">
                    <label for="court">Court:</label>
                    <select id="court" name="court" required>
                        <option value="">Select a court</option>
                        <!-- Options will be populated dynamically -->
                    </select>
                </div>
                <?php
                    $courtsBySection = [];

                    foreach($groundcourts as $court) {
                        $courtsBySection[$court->section][] = [
                            'id' => $court->courtid,
                            'name' => $court->name
                        ];
                    }
                    ?>

                    <div id="court-data" data-courts='<?= json_encode($courtsBySection) ?>'></div>


                <div class="form-group">
                    <label for="reserved_by">Reserved By:</label>
                    <input type="text" id="reserved_by" name="reserved_by" required>
                </div>
                
                <div class="form-group">
                    <label for="participants">Number of Participants:</label>
                    <input type="number" id="participants" name="participants" min="1">
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

        // document.addEventListener('DOMContentLoaded', function() {
        //     updateDisplayDate();
            
        //     document.getElementById('newReservationForm').addEventListener('submit', function(event) {
        //         const selectedDate = document.getElementById('event_date').value;
        //         const today = new Date().toISOString().split('T')[0];
                
        //         if (selectedDate < today) {
        //             event.preventDefault();
        //             alert('Cannot make reservations for past dates.');
        //             return false;
        //         }
        //         return true;
        //     });
        // });


    function openReservationModal(timeSlot, section) {
        // Check if selected date is today or future
        const calendarDate = document.getElementById("reservation-date").value;
        const today = new Date().toISOString().split('T')[0];
        
        if (calendarDate < today) {
            alert('Cannot make reservations for past dates.');
            return; // Don't open the modal
        }
        
        const startTime = timeSlot.split(' - ')[0];
        const modal = document.getElementById("reservationModal"); // Make sure to get the modal
        modal.style.display = "block";
        document.body.style.overflow = "hidden";

        // Set current date & time
        document.getElementById("event_date").value = calendarDate;   
        document.getElementById("start_time").value = startTime;
        
        // Set the section
        const sectionSelect = document.getElementById("section");
        for (let i = 0; i < sectionSelect.options.length; i++) {
            if (sectionSelect.options[i].value === section) {
                sectionSelect.selectedIndex = i;
                break;
            }
        }

        document.getElementById("hiddensection").value = section;

        populateCourts(section);
        
        updateDurationOptions(startTime);
    }

        function openModal() {
            // Check if selected date is today or future
            const calendarDate = document.getElementById("reservation-date").value;
            const today = new Date().toISOString().split('T')[0];

            if (calendarDate < today) {
                alert('Cannot make reservations for past dates.');
                return; // Don't open the modal
            }
            
            modal.style.display = "block";
            document.body.style.overflow = "hidden";
            
            // Set the current selected date in the form
            document.getElementById("event_date").value = calendarDate;
            
            // Reset the form for manual entry
            document.getElementById("start_time").value = "";
            document.getElementById("section").selectedIndex = 0;
            
            // Update duration options with default (8 AM)
            updateDurationOptions("08:00:00");
        }

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


// Add this new function to dynamically update duration options
function updateDurationOptions(startTime) {
    const durationSelect = document.getElementById("duration");
    
    // Clear existing options
    durationSelect.innerHTML = "";
    
    // Add default empty option
    const defaultOption = document.createElement("option");
    defaultOption.value = "";
    defaultOption.text = "Select a duration";
    durationSelect.add(defaultOption);
    
    // Add options based on start time
    if (startTime === "08:00:00") {
        // For 8:00 AM, all options are available
        addDurationOption(durationSelect, "2 hour", "2 Hours");
        addDurationOption(durationSelect, "half", "Half Day");
        addDurationOption(durationSelect, "full", "Full Day");
    } 
    else if (startTime === "13:00:00") {
        // For 1:00 PM, only 2 hours and half day options
        addDurationOption(durationSelect, "2 hour", "2 Hours");
        addDurationOption(durationSelect, "half", "Half Day");
    }
    else {
        // For 10:00 AM and 3:00 PM, only 2 hours option
        addDurationOption(durationSelect, "2 hour", "2 Hours");
    }
}

// Helper function to add options to select
function addDurationOption(selectElement, value, text) {
    const option = document.createElement("option");
    option.value = value;
    option.text = text;
    selectElement.add(option);
}

function populateCourts(section) {
    const courtSelect = document.getElementById("court");
    courtSelect.innerHTML = '<option value="">Select a court</option>';

    const courtDataElement = document.getElementById("court-data");
    const courtsBySection = JSON.parse(courtDataElement.dataset.courts);

    if (courtsBySection[section]) {
        courtsBySection[section].forEach(court => {
            const option = document.createElement("option");
            option.value = court.id;
            option.textContent = court.name;
            courtSelect.appendChild(option);
        });
    }
}



    function closeModal(modal) {
        modal.style.display = "none";
        document.body.style.overflow = "auto"; 
    }   

    window.onclick= function(event){
        if(event.target.classList.contains('modal')){
            event.target.style.display = 'none';
        }
    }

    //error message disappear
    setTimeout(() => {
    const fadeOut = (id) => {
        const el = document.getElementById(id);
        if (el) {
            el.style.opacity = "0";
            el.style.transform = "translateY(-10px)";
            setTimeout(() => el.remove(), 500);
        }
    };

    fadeOut('error-message');
    fadeOut('success-message');
}, 3000);

    //cancel reservation
    function cancelReservation(reservationid){
        event.stopPropagation();
        
        if (confirm("Are you sure you want to cancel this reservation?")) {
            window.location.href = "ground_reservation/cancelReservation/" + reservationid;
        }
    }
    </script>

    <script src="<?=ROOT?>/assets/js/ped_incharge/home.js"></script>
    <script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
    <script src="<?=ROOT?>/assets/js/ped_incharge/reservation.js"></script>
</body>
</html>