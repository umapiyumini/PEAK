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
        <!-- navigation bar -->
        <?php include 'enav.view.php'; ?>
        <div class="main">
        <?php include 'top.view.php'; ?>

        <!-- form part -->
        <div class="container1">
        <h1 class="title1">Tennis court Reservation</h1>


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
            

            <form id="reservationForm" method="post" enctype="multipart/form-data" action="<?=ROOT?>/external/tennisform/reserve">
            <input type="hidden" id="description" name="description" value="no">
            <input type="hidden" name="court_name" value="tennis">

<!-- Booking For -->
<label for="bookingFor">Booking For:</label>
<select id="bookingFor" name="bookingFor" required>
    <option value="" disabled selected>Select</option>
    <option value="tournament">Tournament</option>
    <option value="practice">Practice</option>
    
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
<select id="duration" name="duration" required onchange="showSlots()">
    <option value="" disabled selected>Select Duration</option>
    
    <option id="halfDayOption" value="half">Half Day</option>
            <option id="fullDayOption" value="full">Full Day</option>
            <option id="2hourOption" value="2 hour">2 hours</option>
</select>




<!-- Hidden slots -->
<div id="halfDayOptions" style="display:none;">
    <strong>Choose Time Slot:</strong>
    <div class="slot-container">
        <label><input type="radio" name="time_slot" id='slot1' value="08:00:00"> 08:00 - 12:00</label>
        <label><input type="radio" name="time_slot" id='slot2' value="13:00:00"> 13:00 - 17:00</label>
    </div>
</div>

<div id="twoHourSlots" style="display:none;">
    <strong>Choose Time Slot:</strong>
    <div class="slot-container">
        <label><input type="radio" name="time_slot" id='slotA' value="08:00:00"> 08:00 - 10:00</label>
        <label><input type="radio" name="time_slot" id='slotB' value="10:00:00"> 10:00 - 12:00</label>
        <label><input type="radio" name="time_slot" id='slotC' value="13:00:00"> 13:00 - 15:00</label>
        <label><input type="radio" name="time_slot" id='slotD' value="15:00:00"> 15:00 - 17:00</label>
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
<label for="userproof">Proof of Identity:</label>
<input type="file" id="userproof" name="proof" accept=".pdf,application/pdf" required>

<!-- school -->
<label for="userdetail">Name of organization:</label>
<input type="text" id="userdetail" name="userdetail"  required>


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

    <!--modal-->
<div id="successModal" class="modal" style="display:none;">
  <div class="modal-content" style="max-width:400px;margin:auto;padding:2em;background:#fff;border-radius:8px;box-shadow:0 2px 10px rgba(0,0,0,0.2);text-align:center;">
    <span id="closeModal" style="float:right;font-size:1.5em;cursor:pointer;">&times;</span>
    <h2>Reservation Submitted!</h2>
    <p>You will be notified soon if the reservation gets accepted.</p>
  </div>
</div>


    <script>
    
document.addEventListener('DOMContentLoaded', function() {
        // Get the form elements
        const bookingForSelect = document.getElementById('bookingFor');
        const durationSelect = document.getElementById('duration');
        const descriptionSelect = document.getElementById('description');
        const priceInput = document.getElementById('price');
        const userTypeSelect= document.getElementById('userType');
        const discountedPriceInput = document.getElementById('discountedPrice')
        const dateInput = document.getElementById('date');

        // Add event listeners
        bookingForSelect.addEventListener('change', updatePrice);
        durationSelect.addEventListener('change', updatePrice);
        // descriptionSelect.addEventListener('change', updatePrice);
        userTypeSelect.addEventListener('change',updateDiscountedPrice);
         dateInput.addEventListener('change', checkAvailability);

         function updatePrice() {
            // Only proceed if both booking type and duration are selected
            if (bookingForSelect.value && durationSelect.value) {
                // Map form values to database values
                const event = bookingForSelect.value === 'practice' ? 'practice' : 'tournament';
                const duration = durationSelect.value ;
                const description = 'no';
                
                // Create form data
                const formData = new FormData();
                formData.append('court_name', 'tennis'); // Use the actual court name
                formData.append('event', event);
                formData.append('duration', duration);
                formData.append('description', description); // Default description
                
                // Send request
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '<?=ROOT?>/external/tennisform/getPrice', true);
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
                xhr.open('POST', '<?=ROOT?>/external/tennisform/getDiscount', true);
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
    const twoHourSlots = document.getElementById('twoHourSlots');
    
    // Hide both slot containers first
    halfDaySlots.style.display = 'none';
    twoHourSlots.style.display = 'none';
    
    // Show the appropriate container based on selection
    if (durationSelect.value === 'half') {
        halfDaySlots.style.display = 'block';
    } else if (durationSelect.value === '2 hour') {
        twoHourSlots.style.display = 'block';
    }
}


//availability check

function checkAvailability() {
    const dateInput = document.getElementById('date');
    const durationSelect = document.getElementById('duration');
    const messageElem = document.getElementById('availabilityMessage');
    const halfDayOption = document.getElementById('halfDayOption');
    const fullDayOption = document.getElementById('fullDayOption');
    const twohourOption = document.getElementById('2hourOption');
    const slot1 = document.getElementById('slot1');
    const slot2 = document.getElementById('slot2');

    // Reset options and message
    messageElem.style.display = 'none';
    halfDayOption.disabled = false;
    fullDayOption.disabled = false;
    twohourOption.disabled = false; // Enable two-hour option by default
    slot1.disabled = false;
    slot2.disabled = false;
    
    if (!dateInput.value) {
        return;
    }

    // Create form data
    const formData = new FormData();
    formData.append('date', dateInput.value);
    formData.append('court_name', 'tennis');
    
    // Send request
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '<?=ROOT?>/external/tennisform/checkFullDayAvailability', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.responseText === 'full') {
                // Show message
                messageElem.style.display = 'block';
                messageElem.textContent = 'This date is fully booked for this section.';
                
                // Disable all duration options
                fullDayOption.disabled = true;
                halfDayOption.disabled = true;
                twohourOption.disabled = true;
                
                // Reset duration selection if needed
                if (durationSelect.value === 'full' || durationSelect.value === 'half' || durationSelect.value === '2 hour') {
                    durationSelect.value = '';
                    document.getElementById('halfDayOptions').style.display = 'none';
                    document.getElementById('twoHourSlots').style.display = 'none';
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
    const twohourOption = document.getElementById('2hourOption');
    const slot1 = document.getElementById('slot1');
    const slot2 = document.getElementById('slot2');
    const slotA = document.getElementById('slotA');
    const slotB = document.getElementById('slotB');
    const slotC = document.getElementById('slotC');
    const slotD = document.getElementById('slotD');
    
    // Reset all slots
    slotA.disabled = false;
    slotB.disabled = false;
    slotC.disabled = false;
    slotD.disabled = false;
    twohourOption.disabled = false;
    
    // Create form data
    const formData = new FormData();
    formData.append('date', date);
    formData.append('court_name', 'tennis');
  
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '<?=ROOT?>/external/tennisform/checkHalfDayAvailability', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const responseParts = xhr.responseText.split('|');
            const halfDayStatus = responseParts[0];
            const twoHourSlots = responseParts[1] ? responseParts[1].split(',') : [];
            
            console.log("Half-day status:", halfDayStatus);
            console.log("Two-hour slots booked:", twoHourSlots);
            
            // Process half-day availability
            if (halfDayStatus === 'both') {
                // Both half-day slots are booked
                messageElem.style.display = 'block';
                messageElem.textContent = 'All time slots are booked for this date.';
                halfDayOption.disabled = true;
                fullDayOption.disabled = true;
                twohourOption.disabled = true;
            } else if (halfDayStatus === 'morning') {
                // Morning slot is booked
                messageElem.style.display = 'block';
                messageElem.textContent = 'Morning slot is already booked. Only afternoon slot is available.';
                fullDayOption.disabled = true;
                slot1.disabled = true;
                
                // Disable morning two-hour slots
                slotA.disabled = true;
                slotB.disabled = true;
                
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
                
                // Disable afternoon two-hour slots
                slotC.disabled = true;
                slotD.disabled = true;
                
                // If afternoon slot was selected, clear it
                if (slot2.checked) {
                    slot2.checked = false;
                }
            }
            
            // Process two-hour slot availability
            if (twoHourSlots.length > 0) {
                // Enable two-hour option since we need to check individual slots
                twohourOption.disabled = false;
                
                twoHourSlots.forEach(slot => {
                    // Disable specific two-hour slots
                    if (slot === '08:00:00') {
                        slotA.disabled = true;
                        slot1.disabled =true;
                        if (slotA.checked) slotA.checked = false;
                    }
                    if (slot === '10:00:00') {
                        slotB.disabled = true;
                        slot1.disabled =true;
                        if (slotB.checked) slotB.checked = false;
                    }
                    if (slot === '13:00:00') {
                        slotC.disabled = true;
                        slot2.disabled =true;
                        if (slotC.checked) slotC.checked = false;
                    }
                    if (slot === '15:00:00') {
                        slotD.disabled = true;
                        slot2.disabled =true;
                        if (slotD.checked) slotD.checked = false;
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
                const morningSlotsFull = slotA.disabled && slotB.disabled;
                const afternoonSlotsFull = slotC.disabled && slotD.disabled;
                
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





