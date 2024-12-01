<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Calendar</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/calendar.css">
</head>
<body>
    <h1>Gym Weekly Booking Calendar</h1>
    <div class="calendar-container">
        
        <div class="week-selector">
            <button id="prev-week">&lt; Previous Week</button>
            <span id="week-display"></span>
            <button id="next-week">Next Week &gt;</button>
        </div>
        <div id="calendar">
            <!-- Table will be dynamically generated -->
        </div>
    </div>

    <!-- Modal for booked members -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span id="close-modal" class="close">&times;</span>
            <h2>Booking Details</h2>
            <p id="modal-content"></p>
        </div>
    </div>


    <script src="<?=ROOT?>/assets/js/vidusha/calendar.js"></script>
</body>
</html>
