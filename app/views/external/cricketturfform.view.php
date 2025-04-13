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
        <h1 class="title1">Cricket turf Reservation</h1>


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
            

            <form id="reservationForm" method="post" >

<!-- Booking For -->
<label for="bookingFor">Booking For:</label>
<select id="bookingFor" name="bookingFor" required>
    <option value="" disabled selected>Select</option>
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
<select id="duration" name="duration" required>
    <option value="" disabled selected>Select Duration</option>
    
    <option id="2hourOption"value="2 hour">2 hours</option>
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
<label for="userproof">Proof of Identity:</label>
<input type="file" id="userproof" name="proof" required>

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
    <script>
    // Get form elements
    const bookingForSelect = document.getElementById('bookingFor');
    const durationSelect = document.getElementById('duration');
    const priceInput = document.getElementById('price');
    const discountedPriceInput = document.getElementById('discountedPrice');
    const userTypeSelect = document.getElementById('userType');

    // Function to fetch price
    function fetchPrice() {
        const event = bookingForSelect.value;
        const duration = durationSelect.value;
        const description = "no"; // Hardcoded since you don't want users to select this

        if (event && duration) {
            fetch('http://localhost/PEAK/public/external/cricketturfform/getPrice', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `bookingFor=${encodeURIComponent(event)}&duration=${encodeURIComponent(duration)}&description=${encodeURIComponent(description)}`
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

    // Function to fetch discounted price
function fetchDiscountedPrice(price) {
    const userType = userTypeSelect.value;

    if (!userType || !price) {
        discountedPriceInput.value = '';
        return;
    }

    fetch('http://localhost/PEAK/public/external/volleyballform/getDiscountedPrice', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
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

    // Add event listeners for form changes
    bookingForSelect.addEventListener('change', fetchPrice);
    durationSelect.addEventListener('change', fetchPrice);
    userTypeSelect.addEventListener('change', () => {
    const price = priceInput.value;
    if (price) {
        fetchDiscountedPrice(price);
    }
});
</script>

</body>
</html>





