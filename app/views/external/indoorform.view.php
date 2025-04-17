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
        <h1 class="title1">Badminton court Reservation</h1>


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


        <form id="reservationForm">
            <!-- Dropdown for area selection -->
            <label for="area">Select Area:</label>
            <select id="area" name="area" required>
                <option value="" disabled selected>Select an area</option>
                <option value="badminton">Badminton</option>
                <option value="Karate/Twaekondo">Karate/Twaekondo</option>
                <option value="Table Tennis">Table Tennis</option>
                <option value="Wrestling">Wrestling</option>
                <option value="volleyball">Volleyball</option>
            </select>

            <!-- Dropdown for reason selection -->
            <label for="reason">Booking for: </label>
            <select id="reason" name="reason" required>
                <option value="" disabled selected>Select a reason</option>
                <option value="practice">Practice</option>
                <option value="matches">Matches/Sports Festivals</option>
            </select>

            <!-- Dropdown for duration selection -->
            <label for="duration">Duration:</label>
            <select id="duration" name="duration" required>
                <option value="" disabled selected>Select duration</option>
                <option value="fullDay">Full Day</option>
                <option value="halfDay">Half Day</option>
                <option value="twoHours"> 1 Hour</option>
            </select>

            <!-- Auto-generated price -->
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" readonly>

           <!-- Auto-generated price with discount -->
            <label for="disprice">Total Price with Discount:</label>
            <input type="text" id="disprice" name="disprice" readonly>

            <!-- Date selection -->
            <label for="date">Select Date:</label>
            <input type="date" id="date" name="date" required>

            <!-- Time slots -->
            <div id="timeSlotsContainer">
                <label for="timeSlots">Available Time Slots:</label>
                <div id="timeSlots"></div>
            </div>

            <!-- Reservation rules -->
            <label for="proof">Document of proof</label>
                <input type="file"   required>
               
<br>
           

            <!-- Submit button -->
            <button type="submit">Next</button>
        </form>


        
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