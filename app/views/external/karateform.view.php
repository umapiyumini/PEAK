<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/groundform.css">
    <title>External User Dashboard</title>
</head>
<body>
<?php
    
    $showSuccessModal = false;
    if (isset($_SESSION['reservation_success']) && $_SESSION['reservation_success'] === true) {
        $showSuccessModal = true;
        // Clear the session variable
        $_SESSION['reservation_success'] = false;
    }
    ?>
<?php include 'enav.view.php'; ?>
<div class="main">
<?php include 'top.view.php'; ?>

<div class="container1">
<h1 class="title1">Karate court Reservation</h1>

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

<form id="reservationForm" method="post" action="<?=ROOT?>/external/karateform/reserve" enctype="multipart/form-data">
    <!-- Booking For -->
    <input type="hidden" name="court_name" value="karate">
    <label for="bookingFor">Booking For:</label>
    <select id="bookingFor" name="bookingFor" required>
        <option value="" disabled selected>Select</option>
        
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
    <div id="halfDayOptions" style="display:none;">
            <strong>Choose Time Slot:</strong>
            <div class="slot-container">
                <label><input type="radio" name="time_slot" id='slot1' value="08:00:00"> 08:00 - 13:00</label>
                <label><input type="radio" name="time_slot" id='slot2' value="13:00:00"> 13:00 - 18:00</label>
            </div>
        </div>
        
    

    <!-- 1 Hour Time Options -->
    <div id="oneHourSlots" style="display:none;">
            <strong>Choose Time Slot:</strong>
            <div class="slot-container">
                <label><input type="radio" name="time_slot" id='slotA' value="08:00:00"> 08:00 - 09:00</label>
                <label><input type="radio" name="time_slot" id='slotB' value="09:00:00"> 09:00 - 10:00</label>
                <label><input type="radio" name="time_slot" id='slotC' value="10:00:00"> 10:00 - 11:00</label>
                <label><input type="radio" name="time_slot" id='slotD' value="11:00:00"> 11:00 - 12:00</label>
                <label><input type="radio" name="time_slot" id='slotE' value="12:00:00"> 12:00 - 13:00</label>
                <label><input type="radio" name="time_slot" id='slotF' value="13:00:00"> 13:00 - 14:00</label>
                <label><input type="radio" name="time_slot" id='slotG' value="14:00:00"> 14:00 - 15:00</label>
                <label><input type="radio" name="time_slot" id='slotH' value="15:00:00"> 15:00 - 16:00</label>
                <label><input type="radio" name="time_slot" id='slotI' value="16:00:00"> 16:00 - 17:00</label>
                <label><input type="radio" name="time_slot" id='slotJ' value="17:00:00"> 17:00 - 18:00</label>
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

document.addEventListener('DOMContentLoaded', function() {
        // Get the form elements
        const bookingForSelect = document.getElementById('bookingFor');
        const durationSelect = document.getElementById('duration');
        const priceInput = document.getElementById('price');
        const userTypeSelect= document.getElementById('userType');
        const discountedPriceInput = document.getElementById('discountedPrice')
        const dateInput = document.getElementById('date');

        // Add event listeners
        bookingForSelect.addEventListener('change', updatePrice);
        durationSelect.addEventListener('change', updatePrice);
        userTypeSelect.addEventListener('change',updateDiscountedPrice);
         dateInput.addEventListener('change', checkAvailability);

         function updatePrice() {
            // Only proceed if both booking type and duration are selected
            if (bookingForSelect.value && durationSelect.value ) {
                // Map form values to database values
                const event = bookingForSelect.value === 'practice' ? 'practice' : 'tournament';
                const duration = durationSelect.value ;
              
                
                // Create form data
                const formData = new FormData();
                formData.append('court_name', 'karate'); // Use the actual court name
                formData.append('event', event);
                formData.append('duration', duration);
                
                
                // Send request
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '<?=ROOT?>/external/karateform/getPrice', true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        priceInput.value = xhr.responseText;
                    }
                };
                xhr.send(formData);
            }
            if (userTypeSelect.value) {
                updateDiscountedPrice();
            }
            
        }

        
        function updateDiscountedPrice() {
            // Only proceed if both price and user type are available
            if (priceInput.value && userTypeSelect.value) {
                // Create form data
                const formData = new FormData();
                formData.append('usertype', userTypeSelect.value);
                formData.append('price', priceInput.value);
                
                // Send request to get discounted price
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '<?=ROOT?>/external/karateform/getDiscount', true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        discountedPriceInput.value = xhr.responseText;
                    }
                };
                xhr.send(formData);
            } else {
                discountedPriceInput.value = '';
            }
        }



        });

        function showSlots() {
    const durationSelect = document.getElementById('duration');
    const halfDaySlots = document.getElementById('halfDayOptions');
    const oneHourSlots = document.getElementById('oneHourSlots');
    
    // Hide both slot containers first
    halfDaySlots.style.display = 'none';
    oneHourSlots.style.display = 'none';
    
    // Show the appropriate container based on selection
    if (durationSelect.value === 'half') {
        halfDaySlots.style.display = 'block';
    } else if (durationSelect.value === '1 hour') {
        oneHourSlots.style.display = 'block';
    }
}


//availability check

function checkAvailability() {
    const dateInput = document.getElementById('date');
    const durationSelect = document.getElementById('duration');
    const messageElem = document.getElementById('availabilityMessage');
    const halfDayOption = document.getElementById('halfDayOption');
    const fullDayOption = document.getElementById('fullDayOption');
    const onehourOption = document.getElementById('onehourOption');
    const slot1 = document.getElementById('slot1');
    const slot2 = document.getElementById('slot2');

    // Reset options and message
    messageElem.style.display = 'none';
    halfDayOption.disabled = false;
    fullDayOption.disabled = false;
    onehourOption.disabled = false;
    slot1.disabled = false;
    slot2.disabled = false;
    
    if (!dateInput.value) {
        return;
    }

    // Create form data
    const formData = new FormData();
    formData.append('date', dateInput.value);
    formData.append('court_name', 'karate');
    
    // Send request
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '<?=ROOT?>/external/karateform/checkFullDayAvailability', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.responseText === 'full') {
                // Show message
                messageElem.style.display = 'block';
                messageElem.textContent = 'This date is fully booked for this section.';
                
                // Disable all duration options
                fullDayOption.disabled = true;
                halfDayOption.disabled = true;
                onehourOption.disabled = true;
                
                // Reset duration selection if needed
                if (durationSelect.value === 'full' || durationSelect.value === 'half' || durationSelect.value === '1 hour') {
                    durationSelect.value = '';
                    document.getElementById('halfDayOptions').style.display = 'none';
                    document.getElementById('oneHourSlots').style.display = 'none';
                }
            } else {
                checkHalfDayAvailability(dateInput.value);
            }
        }
    };
    xhr.send(formData);
}

function checkHalfDayAvailability(date) {
    const messageElem = document.getElementById('availabilityMessage');
    const halfDayOption = document.getElementById('halfDayOption');
    const fullDayOption = document.getElementById('fullDayOption');
    const onehourOption = document.getElementById('onehourOption');
    const slot1 = document.getElementById('slot1');
    const slot2 = document.getElementById('slot2');
    const slotA = document.getElementById('slotA');
    const slotB = document.getElementById('slotB');
    const slotC = document.getElementById('slotC');
    const slotD = document.getElementById('slotD');
    const slotE = document.getElementById('slotE');
    const slotF = document.getElementById('slotF');
    const slotG = document.getElementById('slotG');
    const slotH = document.getElementById('slotH');
    const slotI = document.getElementById('slotI');
    const slotJ = document.getElementById('slotJ');
    
    
    // Reset all slots
    slotA.disabled = false;
    slotB.disabled = false;
    slotC.disabled = false;
    slotD.disabled = false;
    slotE.disabled = false;
    slotF.disabled = false;
    slotG.disabled = false;
    slotH.disabled = false;
    onehourOption.disabled = false;
    
    // Create form data
    const formData = new FormData();
    formData.append('date', date);
    formData.append('court_name', 'karate');
  
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '<?=ROOT?>/external/karateform/checkHalfDayAvailability', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const responseParts = xhr.responseText.split('|');
            const halfDayStatus = responseParts[0];
            const oneHourSlots = responseParts[1] ? responseParts[1].split(',') : [];
            
            console.log("Half-day status:", halfDayStatus);
            console.log("1-hour slots booked:", oneHourSlots);
            
            // Process half-day availability
            if (halfDayStatus === 'both') {
                // Both half-day slots are booked
                messageElem.style.display = 'block';
                messageElem.textContent = 'All time slots are booked for this date.';
                halfDayOption.disabled = true;
                fullDayOption.disabled = true;
                onehourOption.disabled = true;
            } else if (halfDayStatus === 'morning') {
                // Morning slot is booked
                messageElem.style.display = 'block';
                messageElem.textContent = 'Morning slot is already booked. Only afternoon slot is available.';
                fullDayOption.disabled = true;
                slot1.disabled = true;
                
                // Disable morning one-hour slots
                slotA.disabled = true;
                slotB.disabled = true;
                slotC.disabled = true;
                slotD.disabled = true;
                
                // If morning slot was selected, clear it
                if (slot1.checked) {
                    slot1.checked = false;
                }
            } else if (halfDayStatus === 'afternoon') {
                // Afternoon slot is booked
                messageElem.style.display = 'block';
                messageElem.textContent = 'Afternoon slot is already booked. Only morning slot is available.';
                fullDayOption.disabled = true;
                slot2.disabled = true;
                
                // Disable afternoon one-hour slots
                slotE.disabled = true;
                slotF.disabled = true;
                slotG.disabled = true;
                slotH.disabled = true;
                
                // If afternoon slot was selected, clear it
                if (slot2.checked) {
                    slot2.checked = false;
                }
            }
            
            // Process one-hour slot availability
            if (oneHourSlots.length > 0) {
                // Enable one-hour option since we need to check individual slots
                onehourOption.disabled = false;
                
                oneHourSlots.forEach(slot => {
                    // Disable specific two-hour slots
                    if (slot === '08:00:00') {
                        slotA.disabled = true;
                        slot1.disabled =true;
                        if (slotA.checked) slotA.checked = false;
                    }
                    if (slot === '09:00:00') {
                        slotB.disabled = true;
                        slot1.disabled =true;
                        if (slotB.checked) slotB.checked = false;
                    }
                    if (slot === '10:00:00') {
                        slotC.disabled = true;
                        slot1.disabled =true;
                        if (slotC.checked) slotC.checked = false;
                    }
                    if (slot === '11:00:00') {
                        slotD.disabled = true;
                        slot1.disabled =true;
                        if (slotD.checked) slotD.checked = false;
                    }
                    if (slot === '12:00:00') {
                        slotE.disabled = true;
                        slot1.disabled =true;
                        if (slotE.checked) slotE.checked = false;
                    }
                    if (slot === '13:00:00') {
                        slotF.disabled = true;
                        slot2.disabled =true;
                        if (slotF.checked) slotF.checked = false;
                    }
                    if (slot === '14:00:00') {
                        slotG.disabled = true;
                        slot2.disabled =true;
                        if (slotG.checked) slotG.checked = false;
                    }
                    if (slot === '15:00:00') {
                        slotH.disabled = true;
                        slot2.disabled =true;
                        if (slotH.checked) slotH.checked = false;
                    }
                    if (slot === '16:00:00') {
                        slotI.disabled = true;
                        slot2.disabled =true;
                        if (slotI.checked) slotI.checked = false;
                    }
                    if (slot === '17:00:00') {
                        slotJ.disabled = true;
                        slot2.disabled =true;
                        if (slotJ.checked) slotJ.checked = false;
                    }
                });
                
                // Disable full day option if any two-hour slot is booked
                fullDayOption.disabled = true;
                
                // Display message about two-hour bookings if no other message is displayed
                if (halfDayStatus === 'none' && !messageElem.textContent) {
                    messageElem.style.display = 'block';
                    messageElem.textContent = 'Some time slots are already booked for this date.';
                }
                
                // Check if all morning or afternoon slots are booked
                const morningSlotsFull = slotA.disabled && slotB.disabled &&  slotC.disabled && slotD.disabled;
                const afternoonSlotsFull = slotE.disabled && slotF.disabled &&  slotG.disabled && slotH.disabled;
                
                if (morningSlotsFull) {
                    slot1.disabled = true;
                    if (slot1.checked) slot1.checked = false;
                }
                
                if (afternoonSlotsFull) {
                    slot2.disabled = true;
                    if (slot2.checked) slot2.checked = false;
                }
            }
        }
    };
    xhr.send(formData);
}


// Add event listener to date input
document.addEventListener('DOMContentLoaded', function() {
    // Your existing code...
    
    // Add event listener for date changes
    const dateInput = document.getElementById('date');
    dateInput.addEventListener('change', checkAvailability);
});

document.addEventListener('DOMContentLoaded', function() {
    // Check if we should show the success modal
    <?php if ($showSuccessModal): ?>
    const successModal = document.getElementById('successModal');
    successModal.style.display = 'block';
    
    // Add event listener to close button
    document.getElementById('closeModal').addEventListener('click', function() {
        successModal.style.display = 'none';
    });
    
    // Close modal when clicking outside of it
    window.addEventListener('click', function(event) {
        if (event.target === successModal) {
            successModal.style.display = 'none';
        }
    });
    <?php endif; ?>
});


</script>
</body>
</html>
