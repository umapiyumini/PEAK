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

        
        <!-- Display Error or Success Message -->
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="error-message" style="color: red;"><?= $_SESSION['error_message'] ?></div>
            <?php unset($_SESSION['error_message']); ?>
        <?php elseif (isset($_SESSION['success_message'])): ?>
            <div class="success-message" style="color: green;"><?= $_SESSION['success_message'] ?></div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

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

            <button type="submit">Next</button>
        </form>

        <div id="reservationSummaryModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Reservation made</h2>
                <div class="summary-details">
                    <p><strong>Area:</strong> <span id="summaryArea"></span></p>
                    <p><strong>Price:</strong> <span id="summaryPrice"></span></p>
                    <p><strong>Status:</strong> <span id="summaryStatus"></span></p>
                    <p> you will be notified when the booking is accepted then you can proceed with the payment </p>
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

        // Handle booking submission via JS
        document.getElementById('reservationForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const subscription = document.getElementById('subscription').value;
            const price = document.getElementById('price').value;

            const formData = new FormData();
            formData.append('subscription', subscription);
            formData.append('price', price);
            

            fetch('<?= ROOT ?>/external/strengthform/book', {
                method: 'POST',
                body: formData
            })
            .then(res => {
                if (!res.ok) throw new Error("Booking failed");
                return res.text();
            })
            .then(data => {
                // Show confirmation modal
                document.getElementById('summaryArea').innerText = "Strength Hall";
                document.getElementById('summaryPrice').innerText = price;
                document.getElementById('summaryStatus').innerText = "pending";


                document.getElementById('reservationSummaryModal').style.display = 'block';
            })
            .catch(error => {
                alert("Booking failed: " + error.message);
            });
        });

        // Modal close buttons
        document.querySelector('.close').onclick = function() {
            document.getElementById('reservationSummaryModal').style.display = 'none';
        }
        document.getElementById('closeModal').onclick = function() {
            document.getElementById('reservationSummaryModal').style.display = 'none';
        }
        </script>

    </body>
</html>
