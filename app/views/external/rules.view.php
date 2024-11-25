<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-1.0">
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/rules.css">
        <title>External User Dashboard</title>
    </head>


    <body>
        <!-- navigation bar -->
        <?php include 'enav.view.php'; ?>
        <div class="main">
        <?php include 'top.view.php'; ?>

        <div class="container1">
        <h1>Rules and Regulations</h1>

        <!-- Reservation Rules Section -->
        <section class="rules-section">
            <h2>Reservation Rules</h2>
            <ul>
                <li><strong>Booking Time:</strong> 
                    <ul>
                        <li>Full Day: 08:00 AM - 06:00 PM</li>
                        <li>Half Day: 
                            <ul>
                                <li>Morning: 08:00 AM - 01:00 PM</li>
                                <li>Afternoon: 01:00 PM - 06:00 PM</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>Bookings can only be made <strong>2 weeks in advance</strong>.</li>
                <li>No refunds, but switching to an available day is allowed.</li>
                <li>If canceled due to an internal event, another day will be provided.</li>
                <li>Preferred payment should be made a <strong>day before</strong>, as no refunds are issued.</li>
            </ul>
        </section>

        
        <!-- Payment Methods Section -->
        <section class="payment-section">
            <h2>Payment Methods</h2>
            <div class="payment-method">
                <h3>Method 01: Bank Deposit</h3>
                <p><strong>Bank:</strong> Peoples Bank</p>
                <p><strong>Branch:</strong> Thimbirigasyaya</p>
                <p><strong>Account Number:</strong> 607179200008</p>
                <p><strong>Account Name:</strong> Sports Promotion Fund of the University of Colombo</p>
            </div>
            <div class="payment-method">
                <h3>Method 02: By Cheque</h3>
                <p>In favour of <strong>Bursar, University of Colombo</strong></p>
            </div>
            <div class="payment-method">
                <h3>Method 03: Online Payment</h3>
                <p>Visit: <a href="https://pay.cmb.ac.lk" target="_blank">https://pay.cmb.ac.lk</a></p>
                <p>Fill in the required details:</p>
                <ul class>
                    <li><strong>Fee Type:</strong> Ground Booking</li>
                    <li><strong>Your Name:</strong> Name of the Payer</li>
                    <li><strong>NIC/Passport:</strong> Enter your NIC or Passport number</li>
                    <li><strong>Payment Reference:</strong> 607179200008</li>
                    <li><strong>Card Type:</strong> Select VISA or MasterCard</li>
                    <li><strong>Total Amount (LKR):</strong> Enter the payment amount</li>
                </ul>
                <p>Click <strong>Submit</strong> to complete your payment.</p>
            </div>
        </section>

        <!-- Upload Payment Proof Section -->
        <section class="upload-section">
            <h2>Upload Payment Proof</h2>
            <p>After completing your payment, please <strong>upload your payment proof</strong> to the website for verification. Ensure your payment receipt includes:</p>
            <ul>
                <li>Payment Date</li>
                <li>Payment Amount</li>
                <li>Reference Number</li>
            </ul>
        </section>
    </div>
</body>
</html>