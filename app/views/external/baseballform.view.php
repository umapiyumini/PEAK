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
            

            <form id="reservationForm" method="post" action="<?=ROOT?>/external/baseballform/book">

<!-- Booking For -->
<label for="bookingFor">Booking For:</label>
<select id="bookingFor" name="bookingFor" required>
    <option value="" disabled selected>Select</option>
    <option value="practice">Practice</option>
    <option value="tournament">Tournament</option>
</select>

<!-- Date Picker -->
<?php 
    $today = date('Y-m-d'); 
    $maxDate = date('Y-m-d', strtotime('+14 days')); 
?>
<label for="date">Select Date:</label>
<input type="date" id="date" name="date" required 
       min="<?= $today ?>" 
       max="<?= $maxDate ?>">
       <p id="availabilityMessage" style="color: red; display: none;"></p>

<!-- Duration -->
<label for="duration">Duration:</label>
<select id="duration" name="duration" required>
    <option value="" disabled selected>Select Duration</option>
    <option  id="halfDayOption" value="half">Half Day</option>
    <option id="fullDayOption"value="full">Full Day</option>
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
    <option value="universities">State University</option>
    <option value="clubs">Registered Club</option>
    <option value="govt schools">Government School / University</option>
    <option value="semi govt">Semi Government School / University</option>
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

<!-- Modal Structure -->
<div id="successModal" class="modal" style="display: none;">
    <div class="modal-content">
        <h4>Reservation Successful</h4>
        <p>Your reservation has been made! You can check the status in the Reservations tab.</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="modal-close btn" id="closeModalBtn">Close</a>
    </div>
</div>



  
<script>
document.addEventListener('DOMContentLoaded', () => {
    const bookingFor = document.getElementById('bookingFor');
    const durationSelect = document.getElementById('duration');
    const halfDayOptions = document.getElementById('halfDayOptions');
    const priceInput = document.getElementById('price');
    const dateInput = document.getElementById('date'); // Date input field
    const fullDayOption = document.getElementById('fullDayOption'); // Full day option

    const slot1 = document.getElementById('slot1'); // Morning 8-1
    const slot2 = document.getElementById('slot2'); // Afternoon 1-6

    // Show/hide time slots based on duration
    function handleDurationChange() {
        if (durationSelect.value === 'half') {
            halfDayOptions.style.display = 'block';
        } else {
            halfDayOptions.style.display = 'none';
        }
        fetchPrice(); // Fetch price whenever duration is selected/changed
    }

    // Fetch price from the server based on selected values
    function fetchPrice() {
        const event = bookingFor.value;
        const duration = durationSelect.value;
        const description = "no";  // Fixed to "no" unless extraDetails logic changes

        if (!event || !duration) return; // Only run if both are selected

        fetch("<?=ROOT?>/external/baseballform/getPrice", {
            method: "POST",
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                event: event,
                duration: duration,
                description: description
            })
        })
        .then(response => response.text())  // Expect plain text response
        .then(data => {
            console.log(data);  // Log the response from the server
            if (data.includes('Error')) {
                priceInput.value = "Not available";  // Handle error response
            } else {
                priceInput.value = data;  // Set price input to the returned price
            }
        })
        .catch(err => {
            console.error("Error fetching price:", err);
            priceInput.value = "Error";  // In case of failure
        });
    }

    // Check availability for selected date and court
    function checkAvailability() {
        const date = dateInput.value;
        const courtId = 24; // Static court ID for now
        const section = 'C';
        const messageElement = document.getElementById('availabilityMessage');

        fetch("<?=ROOT?>/external/baseballform/checkAvailability", {
            method: "POST",
            body: new URLSearchParams({
                date: date,
                section: section
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);

            // Reset options
            fullDayOption.disabled = false;
            document.querySelector('option[value="half"]').disabled = false;
            slot1.disabled = false;
            slot2.disabled = false;
            messageElement.style.display = 'none';
            messageElement.textContent = '';

            if (data.fullDayCount > 0) {
                // If full day is booked — disable both full and half day
                fullDayOption.disabled = true;
                document.querySelector('option[value="half"]').disabled = true;
                slot1.disabled = true;
                slot2.disabled = true;
                messageElement.textContent = "Pick another date — fully booked!";
                messageElement.style.display = 'block';
            } else if (data.halfDayCount > 0) {
                // If half-day is booked — disable only full day
                fullDayOption.disabled = true;
                messageElement.textContent = "Only half-day booking is available for this date.";
                messageElement.style.display = 'block';

                // Check which half-day slot is already booked
                if (data.bookedHalfSlot) {
                    if (data.bookedHalfSlot.startsWith("08:00")) {
                        slot1.disabled = true;  // Morning slot disabled
                        slot2.disabled = false;
                    } else if (data.bookedHalfSlot.startsWith("13:00")) {
                        slot2.disabled = true;  // Afternoon slot disabled
                        slot1.disabled = false;
                    }
                }
            }
        })
        .catch(err => {
            console.error('Error:', err);
            messageElement.textContent = "Something went wrong while checking availability.";
            messageElement.style.display = 'block';
        });
    }

    // Attach event listeners
    bookingFor.addEventListener('change', fetchPrice);
    durationSelect.addEventListener('change', handleDurationChange);
    dateInput.addEventListener('change', checkAvailability);  // Call checkAvailability when date changes

    // 💡 New: Calculate discounted price when usertype is selected
    const userTypeSelect = document.getElementById('userType');
    const discountedPriceInput = document.getElementById('discountedPrice');

    if (userTypeSelect) {
        userTypeSelect.addEventListener('change', () => {
            const event = bookingFor.value;
            const duration = durationSelect.value;
            const description = "no";
            const usertype = userTypeSelect.value;
            const basePrice = priceInput.value;  // Get the price from the input field

            if (!event || !duration || !usertype || !basePrice) return;

            fetch("<?=ROOT?>/external/baseballform/getDiscountedPrice", {
                method: "POST",
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({
                    event: event,
                    duration: duration,
                    description: description,
                    usertype: usertype,
                    basePrice: basePrice // Send the base price from the price input
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.discountedPrice !== undefined) {
                    discountedPriceInput.value = data.discountedPrice.toFixed(2);
                } else if (data.error) {
                    discountedPriceInput.value = data.error;
                }
            })
            .catch(err => {
                console.error("Error fetching discounted price:", err);
                discountedPriceInput.value = "Error";
            });
        });
    }

});



</script>


</body>
</html>





