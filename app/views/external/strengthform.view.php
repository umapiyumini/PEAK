<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/groundform.css">
        <title>External User Dashboard</title>
        <style>
            #nextBtn:disabled {
            cursor: not-allowed;
            opacity: 0.5;
}
            </style>
    </head>

    <body>
        <!-- navigation bar -->
        <?php include 'enav.view.php'; ?>
        <div class="main">
        <?php include 'top.view.php'; ?>

        

        <!-- form part -->
        <div class="container1">
        <h1 class="title1">Strength hall Reservation</h1>


        <form id="reservationForm">
            <label for="subscription">Subscription:</label>
            <select id="subscription" name="subscription" required>
                <option value="" disabled selected>Select subscription</option>
                <option value="annual">Annual</option>
                <option value="6 month">6 Month</option>
                <option value="3 month">3 Month</option>
            </select>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" readonly>
            <div id="subscriptionMessage"></div> <!-- Area to display the message -->

            <button type="submit" id="nextBtn">Next</button>
        </form>
       
         <!-- Ongoing Subscriptions Section -->
         <div class="ongoing-subscriptions" style="margin-top: 30px;"> 
    <h2>Current Ongoing Subscriptions</h2>
    <?php if (!empty($subscriptions)): ?>
        <ul>
            <?php foreach ($subscriptions as $subscription): ?>
                <li>
                    <div style="margin-top: 10px;">
                    <p><strong>Subscription:</strong> <?= htmlspecialchars($subscription->subscription) ?></p>
                    <p><strong>Status:</strong> <?= htmlspecialchars($subscription->status) ?></p>
                    <p><strong>Valid till:</strong> <?= htmlspecialchars($subscription->subscription_end_date) ?></p>
                               <?php if ($subscription->status === 'To pay'): ?>
                                
                                <a href="<?= ROOT ?>/external/subscriptionpay/show/<?= $subscription->subscriptionid ?>/<?= urlencode($subscription->subscription) ?>" class="pay-now">Pay Now</a>

                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No ongoing subscriptions found.</p>
    <?php endif; ?>
    </div> 
</div>


<div id="reservationSummaryModal" class="modal" style="display: none;">

                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2>Reservation made</h2>
                        <div class="summary-details">
                            <p><strong>Area:</strong> <span id="summaryArea"></span></p>
                            <p><strong>Price:</strong> <span id="summaryPrice"></span></p>
                            <p><strong>Status:</strong> <span id="summaryStatus"></span></p>
                            <p>You will be notified when the booking is accepted, then you can proceed with the payment.</p>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <script>
   // Fetch price on subscription change
document.getElementById('subscription').addEventListener('change', function() {
    const subscription = this.value;
    const priceElement = document.getElementById('price');

    fetch('<?= ROOT ?>/external/strengthform/getPrice', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `subscription=${subscription}`
    })
    .then(response => response.text())
    .then(price => {
        priceElement.value = price;
    })
    .catch(error => {
        console.error('Error fetching price:', error);
    });
});

// Handle form submission
document.getElementById('reservationForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    const subscription = document.getElementById('subscription').value;
    const price = document.getElementById('price').value;
    const userId = '<?= $this->getUserId() ?>'; // Ensure this outputs the correct user ID dynamically

    // Send the data to the controller to insert into the database
    fetch('<?= ROOT ?>/external/strengthform/submitReservation', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `subscription=${subscription}&price=${price}&userid=${userId}`
    })
    .then(response => response.text())
    .then(data => {
        // Show the reservation summary in the modal
        const modal = document.getElementById('reservationSummaryModal');
        document.getElementById('summaryArea').innerText = subscription;
        document.getElementById('summaryPrice').innerText = price;
        document.getElementById('summaryStatus').innerText = 'Pending'; // Status is always "Pending" initially

        modal.style.display = "block"; // Show the modal
    })
    .catch(error => {
        console.error('Error submitting reservation:', error);
    });
});

// Modal close functionality
document.querySelector('.close').addEventListener('click', function() {
    document.getElementById('reservationSummaryModal').style.display = "none";
});

//allow or dont allow 
document.getElementById('subscription').addEventListener('change', function() {
    var subscriptionType = this.value; // Get selected subscription
    var userId = <?php echo $_SESSION['userid']; ?>; // Get user ID from PHP session

    if (subscriptionType && userId) {
        // Make an AJAX call to check the active subscription status
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?= ROOT ?>/external/strengthform/checksubscriptionstatus', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText; // Get response from server

                // Show the message returned from the server
                document.getElementById('subscriptionMessage').innerHTML = response;
            }
        };
        xhr.send('userId=' + userId + '&subscriptionType=' + subscriptionType);
    }
});

//button disabling
document.getElementById('subscription').addEventListener('change', function () {
    const subscriptionType = this.value;
    const userId = <?= json_encode($_SESSION['userid']) ?>;
    const messageDiv = document.getElementById('subscriptionMessage');
    const nextButton = document.getElementById('nextBtn');

    fetch('<?= ROOT ?>/external/strengthform/checkSubscriptionStatus/json', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `userId=${userId}&subscriptionType=${subscriptionType}`
    })
    .then(response => response.json())
    .then(data => {
        messageDiv.textContent = data.message;
        nextButton.disabled = !data.canPay;  // Disable button when canPay is false
    })
    .catch(error => {
        console.error('Error:', error);
        messageDiv.textContent = "An error occurred while checking subscription status.";
        nextButton.disabled = true;  // Disable the button if there's an error
    });
});


</script>

    </body>
</html>
