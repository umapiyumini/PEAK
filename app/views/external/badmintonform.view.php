<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/groundform.css">
    <title>External User Dashboard</title>
</head>
<body>
<?php include 'enav.view.php'; ?>
<div class="main">
<?php include 'top.view.php'; ?>

<div class="container1">
<h1 class="title1">Badminton court Reservation</h1>

<div class="rules">
    <h2>Please note </h2>
    <ul>
        <li><strong>Booking Time:</strong> Full day: 08:00 - 18:00; Half day: 08:00 - 13:00 or 13:00 - 18:00; 1 hour: 08:00 - 18:00 (hourly)</li>
        <li>Bookings can only be made 2 weeks in advance.</li>
        <li>No refunds, but switching to an available day is allowed.</li>
        <li>If canceled due to an internal event, another day will be provided.</li>
        <li>Preferred payment should be made a day before, as no refunds are issued.</li>
    </ul>
</div>

<form id="reservationForm" method="post" action="<?=ROOT?>/external/badmintonform/reserve" enctype="multipart/form-data">
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
    <input type="date" id="date" name="date" required min="<?= $today ?>" max="<?= $maxDate ?>">
    <p id="availabilityMessage" style="color: red; display: none;"></p>

    <!-- Duration -->
    <label for="duration">Duration:</label>
        <select id="duration" name="duration" required onchange="showSlots()">
            <option value="" disabled selected>Select Duration</option>
            <option id="halfDayOption" value="half">Half Day</option>
            <option id="fullDayOption" value="full">Full Day</option>
            <option id="onehourOption" value="1 hour">1 hours</option>
        </select>

    <!-- Hidden slots -->
    <div id="halfDaySlots" style="display:none;">
            <strong>Choose Time Slot:</strong>
            <div class="slot-container">
                <label><input type="radio" name="time_slot" value="08:00:00"> 08:00 - 13:00</label>
                <label><input type="radio" name="time_slot" value="13:00:00"> 13:00 - 18:00</label>
            </div>
        </div>
        
    

    <!-- 1 Hour Time Options -->
    <div id="oneHourSlots" style="display:none;">
            <strong>Choose Time Slot:</strong>
            <div class="slot-container">
                <label><input type="radio" name="time_slot" value="08:00:00"> 08:00 - 09:00</label>
                <label><input type="radio" name="time_slot" value="09:00:00"> 09:00 - 10:00</label>
                <label><input type="radio" name="time_slot" value="10:00:00"> 10:00 - 11:00</label>
                <label><input type="radio" name="time_slot" value="11:00:00"> 11:00 - 12:00</label>
                <label><input type="radio" name="time_slot" value="12:00:00"> 12:00 - 13:00</label>
                <label><input type="radio" name="time_slot" value="13:00:00"> 13:00 - 14:00</label>
                <label><input type="radio" name="time_slot" value="14:00:00"> 14:00 - 15:00</label>
                <label><input type="radio" name="time_slot" value="15:00:00"> 15:00 - 16:00</label>
                <label><input type="radio" name="time_slot" value="16:00:00"> 16:00 - 17:00</label>
                <label><input type="radio" name="time_slot" value="17:00:00"> 17:00 - 18:00</label>
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

    <!-- Organization Name -->
    <label for="userdetail">Name of organization:</label>
    <input type="text" id="userdetail" name="userdetail" required>

    <!-- Proof of Identity -->
    <label for="proof">Proof of Identity:</label>
    <input type="file" id="proof" name="proof" required>

    <!-- Number of Participants -->
    <label for="participants">Number of Participants:</label>
    <input type="number" id="participants" name="participants" min="1" required>

    <!-- Extra Details -->
    <label for="extraDetails">Extra Details:</label>
    <textarea id="extraDetails" name="extraDetails" rows="3"></textarea>

    <!-- Price -->
    <label for="price">Price:</label>
    <input type="text" id="price" name="price" readonly>

    <!-- Discounted Price -->
    <label for="discountedPrice">Discounted Price:</label>
    <input type="text" id="discountedPrice" name="discountedPrice" readonly>

    <button type="submit">Submit Reservation</button>
</form>
</div>

<!-- Modal Structure -->
<div id="successModal" class="modal" style="display: none;">
    <div class="modal-content">
        <h4>Reservation Successful</h4>
        <p>Your reservation has been made! You can check the status in the Reservations tab.</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="modal-close btn" id="closeModal">Close</a>
    </div>
</div>

<script>

// Price fetch
const bookingForSelect = document.getElementById('bookingFor');
const durationSelect = document.getElementById('duration');
const priceInput = document.getElementById('price');
const discountedPriceInput = document.getElementById('discountedPrice');
const userTypeSelect = document.getElementById('userType');

function fetchPrice() {
    const event = bookingForSelect.value;
    const duration = durationSelect.value;
    

    if (event && duration) {
        fetch('<?=ROOT?>/external/badmintonform/getPrice', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `bookingFor=${encodeURIComponent(event)}&duration=${encodeURIComponent(duration)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.price) {
                priceInput.value = data.price;
            } else {
                priceInput.value = 'Price not available';
            }
        })
        .catch(error => {
            console.error('Error fetching price:', error);
            priceInput.value = 'Error fetching price';
        });
    } else {
        priceInput.value = '';
    }
}

function fetchDiscountedPrice(price) {
    const userType = userTypeSelect.value;
    if (!userType || !price) {
        discountedPriceInput.value = '';
        return;
    }

    fetch('<?=ROOT?>/external/Volleyballform/getDiscountedPrice', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `userType=${encodeURIComponent(userType)}&price=${encodeURIComponent(price)}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.discountedPrice !== undefined) {
            discountedPriceInput.value = data.discountedPrice;
        } else {
            discountedPriceInput.value = 'Not available';
        }
    })
    .catch(error => {
        console.error('Error fetching discounted price:', error);
        discountedPriceInput.value = 'Error';
    });
}

bookingForSelect.addEventListener('change', fetchPrice);
durationSelect.addEventListener('change', fetchPrice);
userTypeSelect.addEventListener('change', () => {
    const price = priceInput.value;
    if (price) fetchDiscountedPrice(price);
});


        // Function to show hidden time slots 
        function showSlots() {
        const selectedDuration = document.getElementById("duration").value;
        document.getElementById("halfDaySlots").style.display = (selectedDuration === "half") ? "block" : "none";
        document.getElementById("oneHourSlots").style.display = (selectedDuration === "1 hour") ? "block" : "none";
    }

    // Add event listeners for form changes
    bookingForSelect.addEventListener('change', fetchPrice);
    durationSelect.addEventListener('change', fetchPrice);
    
    userTypeSelect.addEventListener('change', () => {
        const price = priceInput.value;
        if (price) {
            fetchDiscountedPrice(price);
        }
    });

    // Date availability check (ADD THIS BLOCK)
    
    const dateInput = document.getElementById('date');
const availabilityMessage = document.getElementById('availabilityMessage');
const fullDayOption = document.getElementById('fullDayOption');
const halfDayOption = document.getElementById('halfDayOption');
const oneHourOption = document.getElementById('onehourOption');

dateInput.addEventListener('change', function() {
    const selectedDate = dateInput.value;
    if (!selectedDate) return;

    fetch('http://localhost/PEAK/public/external/badmintonform/checkAvailability', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `date=${encodeURIComponent(selectedDate)}`
    })
    .then(response => response.json())
    .then(data => {
        // Disable duration options based on backend response
        if (fullDayOption) fullDayOption.disabled = !data.full;
        if (halfDayOption) halfDayOption.disabled = !data.half;
        if (oneHourOption) oneHourOption.disabled = !data['1hour'];

        // Show/hide availability message
        if (data.message) {
            availabilityMessage.textContent = data.message;
            availabilityMessage.style.display = "block";
        } else {
            availabilityMessage.textContent = "";
            availabilityMessage.style.display = "none";
        }

        // Reset all half-day and 2-hour slots to enabled
        document.querySelectorAll('#halfDaySlots input[type="radio"]').forEach(r => r.disabled = false);
        document.querySelectorAll('#oneHourSlots input[type="radio"]').forEach(r => r.disabled = false);

        // Disable booked half-day slots
        if (Array.isArray(data.bookedHalfSlots)) {
            data.bookedHalfSlots.forEach(function(time) {
                let radio = document.querySelector('#halfDaySlots input[type="radio"][value="' + time + '"]');
                if (radio) radio.disabled = true;
            });
        }

        // Disable half-day slots that overlap with booked 1-hour slots
if (Array.isArray(data.disableHalfDaySlots)) {
    data.disableHalfDaySlots.forEach(function(time) {
        let radio = document.querySelector('#halfDaySlots input[type="radio"][value="' + time + '"]');
        if (radio) radio.disabled = true;
    });
}

        // Disable 1-hour slots that are booked OR overlap with booked half-day slots
        if (Array.isArray(data.disableOneHourSlots)) {
            data.disableOneHourSlots.forEach(function(time) {
                let radio = document.querySelector('#oneHourSlots input[type="radio"][value="' + time + '"]');
                if (radio) radio.disabled = true;
            });
        }
    })
    .catch(error => {
        availabilityMessage.textContent = "Error checking date availability.";
        availabilityMessage.style.display = "block";
        console.error(error);
    });
});

// Modal logic
document.addEventListener('DOMContentLoaded', function() {
    <?php if (isset($_SESSION['reservation_success']) && $_SESSION['reservation_success']): ?>
        document.getElementById('successModal').style.display = 'flex';
        <?php unset($_SESSION['reservation_success']); ?>
    <?php endif; ?>
    var closeBtn = document.getElementById('closeModal');
    if (closeBtn) {
        closeBtn.onclick = function() {
            document.getElementById('successModal').style.display = 'none';
        }
    }
    var modal = document.getElementById('successModal');
    if (modal) {
        modal.onclick = function(e) {
            if (e.target === modal) modal.style.display = 'none';
        }
    }
});
</script>
</body>
</html>
