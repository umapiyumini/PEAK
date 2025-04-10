<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
        <h1 class="title1">Strength hall Reservation</h1>




        <form id="reservationForm" action="<?= ROOT ?>/external/strengthform/book" method="POST" enctype="multipart/form-data">
    <!-- Existing form fields -->
    <label for="subscription">Subscription:</label>
    <select id="subscription" name="subscription" required>
        <option value="" disabled selected>Select subscription</option>
        <option value="annual">Annual</option>
        <option value="6 month">6 Month</option>
        <option value="3 month">3 Month</option>
    </select>

    <label for="price">Price:</label>
    <input type="text" id="price" name="price" readonly>

    

    <button type="submit">Next</button>
</form>


        <div id="reservationSummaryModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Reservation Summary</h2>
        <div class="summary-details">
            <p><strong>Area:</strong> <span id="summaryArea"></span></p>
            <p><strong>Duration:</strong> <span id="summaryDuration"></span></p>
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


        
    </div>


    

    <script>
// Add an event listener to the subscription dropdown
document.getElementById('subscription').addEventListener('change', function() {
    // Get the selected subscription value
    const subscription = this.value;

    // Get the price input element where the price will be displayed
    const priceElement = document.getElementById('price');

    // Use Fetch API to send a POST request to the backend to get the price
    fetch('<?= ROOT ?>/external/strengthform/getPrice', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `subscription=${subscription}`
    })
    .then(response => response.text())  // Handle the response as plain text
    .then(price => {
        // Update the price input field with the returned price
        priceElement.value = price;  // This will set the price to the input field
    })
    .catch(error => {
        // Handle errors if any
        console.error('Error fetching price:', error);
    });
});

</script>



  

    
</body>
</html>