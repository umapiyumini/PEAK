<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/reservation.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <style>
        :root {
            --primary: #4a6fa5;
            --secondary: #6b8cbc;
            --light: #f5f7fa;
            --dark: #2c3e50;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
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
        
      
        
        .time-slots-container {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        
        .time-slots-header {
            display: grid;
            grid-template-columns: 100px repeat(4, 1fr);
            gap: 10px;
            margin-bottom: 15px;
            font-weight: bold;
            text-align: center;
            padding: 10px 0;
            background-color: #f1f5f9;
            border-radius: 4px;
        }
        
        .time-slot {
            display: grid;
            grid-template-columns: 100px repeat(4, 1fr);
            gap: 10px;
            margin-bottom: 10px;
            text-align: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        
        .time-label {
            font-weight: bold;
        }
        
        .section {
            border-radius: 4px;
            padding: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .section:hover {
            transform: scale(1.03);
        }
        
        .available {
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }
        
        .booked-internal {
            background-color: rgba(76, 175, 80, 0.3);
            color: #2e7d32;
            border: 1px solid #4CAF50;
        }
        
        .booked-external {
            background-color: rgba(33, 150, 243, 0.3);
            color: #0d47a1;
            border: 1px solid #2196F3;
        }
        
        .booked-special {
            background-color: rgba(255, 152, 0, 0.3);
            color: #e65100;
            border: 1px solid #FF9800;
        }

        @media (max-width: 768px) {
            .time-slots-header, .time-slot {
                grid-template-columns: 80px repeat(4, 1fr);
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
            <!-- <div class="notifications-dropdown">
                <div class="notifications-header">
                    <h3>Notifications</h3>
                    <span class="clear-all">Clear All</span>
                </div>
                <div class="notifications-list">
                    <ul id="notificationsList"></ul>
                </div>
              </div> -->
            <button class="bell-icon"><i class="uil uil-signout"></i></button>
        </div>

    <div class="container">
        <div class="date-selector">
            <input type="date" id="reservation-date" onchange="checkAvailability()">
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
            </div>
        </div>

        <div class="action-buttons">
            <button class="button" onclick="window.location.href='requests';">Requests</button>
            <button class="button" onclick="window.location.href='all_reservations_ground';">All reservations</button>
        </div>

        <div class="time-slots-container">
            <h2 id="availability-date">Ground Availability</h2>
            <p id="no-date-selected">Please select a date to view availability</p>
            
            <div id="time-slots" style="display: none;">
                <div class="time-slots-header">
                    <div>Time</div>
                    <div>Section A</div>
                    <div>Section B</div>
                    <div>Section C</div>
                    <div>Section D</div>
                </div>
                
                <div class="time-slots-content" id="slots-container">
                    <!-- Time slots will be populated here via JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample data - Replace with your actual data structure
        const bookingData = {
            "2025-04-21": {
                "09:00-10:00": {
                    "Section A": { status: "booked-internal", bookedBy: "Sports Team A" },
                    "Section B": { status: "available" },
                    "Section C": { status: "booked-external", bookedBy: "XYZ Organization" },
                    "Section D": { status: "available" }
                },
                "10:00-11:00": {
                    "Section A": { status: "booked-special", bookedBy: "Annual Tournament" },
                    "Section B": { status: "booked-internal", bookedBy: "Sports Team B" },
                    "Section C": { status: "available" },
                    "Section D": { status: "available" }
                },
                "11:00-12:00": {
                    "Section A": { status: "available" },
                    "Section B": { status: "available" },
                    "Section C": { status: "booked-external", bookedBy: "ABC Company" },
                    "Section D": { status: "booked-internal", bookedBy: "Faculty Meeting" }
                },
                "12:00-13:00": {
                    "Section A": { status: "available" },
                    "Section B": { status: "booked-external", bookedBy: "Local Club" },
                    "Section C": { status: "available" },
                    "Section D": { status: "booked-special", bookedBy: "Maintenance" }
                },
                "13:00-14:00": {
                    "Section A": { status: "booked-internal", bookedBy: "Department Event" },
                    "Section B": { status: "available" },
                    "Section C": { status: "available" },
                    "Section D": { status: "available" }
                },
                "14:00-15:00": {
                    "Section A": { status: "available" },
                    "Section B": { status: "available" },
                    "Section C": { status: "booked-internal", bookedBy: "Sports Team C" },
                    "Section D": { status: "booked-external", bookedBy: "External Vendor" }
                },
                "15:00-16:00": {
                    "Section A": { status: "booked-special", bookedBy: "Special Event" },
                    "Section B": { status: "booked-special", bookedBy: "Special Event" },
                    "Section C": { status: "booked-special", bookedBy: "Special Event" },
                    "Section D": { status: "booked-special", bookedBy: "Special Event" }
                },
                "16:00-17:00": {
                    "Section A": { status: "available" },
                    "Section B": { status: "available" },
                    "Section C": { status: "available" },
                    "Section D": { status: "available" }
                }
            },
            // Add more dates as needed
            "2025-04-22": {
                "09:00-10:00": {
                    "Section A": { status: "available" },
                    "Section B": { status: "available" },
                    "Section C": { status: "available" },
                    "Section D": { status: "available" }
                },
                "10:00-11:00": {
                    "Section A": { status: "booked-external", bookedBy: "Local School" },
                    "Section B": { status: "booked-external", bookedBy: "Local School" },
                    "Section C": { status: "available" },
                    "Section D": { status: "available" }
                }
                // Add more time slots for this date
            }
        };

        // Set today's date as default
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date();
            const formattedDate = today.toISOString().split('T')[0];
            document.getElementById('reservation-date').value = formattedDate;
            checkAvailability();
        });

        function checkAvailability() {
            const dateInput = document.getElementById('reservation-date').value;
            const availabilityDate = document.getElementById('availability-date');
            const noDateSelected = document.getElementById('no-date-selected');
            const timeSlots = document.getElementById('time-slots');
            const slotsContainer = document.getElementById('slots-container');
            
            // Format date for display
            const displayDate = new Date(dateInput).toLocaleDateString('en-US', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            
            availabilityDate.textContent = `Ground Availability for ${displayDate}`;
            
            if (bookingData[dateInput]) {
                noDateSelected.style.display = 'none';
                timeSlots.style.display = 'block';
                
                // Clear previous slots
                slotsContainer.innerHTML = '';
                
                // Generate time slots
                for (const timeSlot in bookingData[dateInput]) {
                    const sections = bookingData[dateInput][timeSlot];
                    
                    const slotDiv = document.createElement('div');
                    slotDiv.className = 'time-slot';
                    
                    const timeDiv = document.createElement('div');
                    timeDiv.className = 'time-label';
                    timeDiv.textContent = timeSlot;
                    slotDiv.appendChild(timeDiv);
                    
                    // Add sections
                    for (const section in sections) {
                        const sectionDiv = document.createElement('div');
                        sectionDiv.className = `section ${sections[section].status}`;
                        
                        let sectionText = section;
                        if (sections[section].status !== 'available') {
                            sectionText += `<br>(${sections[section].bookedBy})`;
                        } else {
                            sectionText += '<br>(Available)';
                        }
                        
                        sectionDiv.innerHTML = sectionText;
                        sectionDiv.addEventListener('click', function() {
                            if (sections[section].status === 'available') {
                                alert(`Book ${section} for ${timeSlot} on ${displayDate}?`);
                            } else {
                                alert(`${section} is already booked by ${sections[section].bookedBy} for ${timeSlot}`);
                            }
                        });
                        
                        slotDiv.appendChild(sectionDiv);
                    }
                    
                    slotsContainer.appendChild(slotDiv);
                }
            } else {
                noDateSelected.textContent = "No bookings data available for this date. All slots are available.";
                noDateSelected.style.display = 'block';
                timeSlots.style.display = 'none';
            }
        }

        function viewReservationRequests() {
            alert("Viewing pending reservation requests");
            // Implement navigation to reservation requests page
        }

        function viewAllRequests() {
            alert("Viewing all requests");
            // Implement navigation to all requests page
        }
    </script>

        <script src="<?=ROOT?>/assets/js/ped_incharge/home.js"></script>
        <script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
        <script src="<?=ROOT?>/assets/js/ped_incharge/reservation.js"></script>
    </div>
</body>
</html>
