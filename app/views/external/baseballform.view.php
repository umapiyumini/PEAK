<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-1.0">
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/groundform.css">
        <title>External User Dashboard</title>
    </head>


    <body>
        <!-- navigation bar -->
        <?php include 'enav.view.php'; ?>
        <div class="main">
        <?php include 'top.view.php'; ?>

        <!-- form part -->
        <div class="container1">
        <h1 class="title1">Baseball court Reservation</h1>


        <div class="rules">
                <h2>Please note </h2>
                <ul>
                    <li><strong>Booking Time:</strong> Full day: 08:00 - 18:00; Half day: 08:00 - 13:00 or 13:00 - 18:00</li>
                    <li>Bookings can only be made 2 weeks in advance.</li>
                    <li>No refunds, but switching to an available day is allowed.</li>
                    <li>If canceled due to an internal event, another day will be provided.</li>
                    <li>Preferred payment should be made a day before, as no refunds are issued.</li>
                </ul>
            </div>
            

            <form id="reservationForm" method="post" action="<?=ROOT?>/external/baseballform">

    <!-- Booking For -->
    <label for="bookingFor">Booking For:</label>
    <select id="bookingFor" name="bookingFor" required>
        <option value="" disabled selected>Select</option>
        <option value="practice">Practice</option>
        <option value="tournament">Tournament</option>
    </select>

    <!-- Date Picker -->
    <label for="date">Select Date:</label>
    <input type="date" id="date" name="date" required>

    <!-- Duration -->
    <label for="duration">Duration:</label>
    <select id="duration" name="duration" required>
        <option value="" disabled selected>Select Duration</option>
        <option value="halfDay">Half Day</option>
        <option value="fullDay">Full Day</option>
    </select>

    <!-- Half Day Time Options -->
    <div id="halfDayOptions" style="display: none;">
        <label>Choose Time Slot:</label>
        <div style="display: flex; gap: 30px;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="radio" id="slot1" name="timeSlot" value="08:00 - 13:00">
                08:00 - 13:00
            </label>
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="radio" id="slot2" name="timeSlot" value="13:00 - 18:00">
                13:00 - 18:00
            </label>
        </div>
    </div>

    <!-- User Type -->
    <label for="userType">User Type:</label>
    <select id="userType" name="userType" required>
        <option value="" disabled selected>Select</option>
        <option value="stateuniversity">State University</option>
        <option value="registeredclub">Registered club</option>
        <option value="governmentschool">Government School / University</option>
        <option value="semischool">Semi Government School / University</option>
        <option value="UOCfaculty">UOC Faculty</option>
        <option value="other">Other</option>
    </select>

     <!-- Proof of Identity -->
     <label for="proof">Proof of Identity:</label>
    <input type="file" id="proof" name="proof" required>

    
    <!-- Number of Participants -->
    <label for="participants">Number of Participants:</label>
    <input type="number" id="participants" name="participants" min="10" required>

    <!-- Extra Details -->
    <label for="extraDetails">Extra Details:</label>
    <textarea id="extraDetails" name="extraDetails" rows="3"></textarea>

   
    <!-- Price -->
    <label for="price">Price:</label>
    <input type="text" id="price" name="price" readonly>

    <!-- Discounted Price -->
    <label for="discountedPrice">Discounted Price:</label>
    <input type="text" id="discountedPrice" name="discountedPrice" readonly>

    <!-- Submit -->
    <button type="submit">Submit Reservation</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const durationSelect = document.getElementById('duration');
        const halfDayOptions = document.getElementById('halfDayOptions');

        durationSelect.addEventListener('change', () => {
            if (durationSelect.value === 'halfDay') {
                halfDayOptions.style.display = 'block';
            } else {
                halfDayOptions.style.display = 'none';
            }
        });
    });
</script>

    </div>


    <!-- Modal for reservation summary -->
<!-- Modal for Reservation Summary -->
<!-- Modal for Reservation Summary -->
<div id="reservationSummaryModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Reservation Summary</h2>
        <div class="summary-details">
            <p><strong>Area:</strong> <span id="summaryArea"></span></p>
            <p><strong>Reason:</strong> <span id="summaryReason"></span></p>
            <p><strong>Date:</strong> <span id="summaryDate"></span></p>
            <p><strong>Duration:</strong> <span id="summaryDuration"></span></p>
            <p><strong>Selected Time Slot:</strong> <span id="summaryTimeSlot"></span></p>
            <hr>
            <p><strong>Base Price:</strong> <span id="summaryPrice"></span></p>
            <p><strong>Discounted Price:</strong> <span id="summaryDiscountPrice"></span></p>
            <hr>
            <p><strong>Total:</strong> <span id="summaryTotal"></span></p>
        </div>
        <div class="modal-buttons">
            <button id="backToForm">Back</button>
            <button id="confirmReservation"><a href="reservations">Confirm</a></button>
        </div>
    </div>
</div>




  

    <script src="<?=ROOT?>/assets/js/uma/indoor.js"></script>
</body>
</html>





