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

        <div class="container1">
        <h2 class="title1" style="margin-bottom: 30px;">Payment Submission</h2>

        <p style="margin-bottom: 20px;">
            <strong>Note:</strong> If you have not made the payment yet, please do so at 
            <a href="https://pay.cmb.ac.lk/" target="_blank" class="payment-link">
                https://pay.cmb.ac.lk/
            </a>
            before uploading the proof.
        </p>


        <?php if (isset($subscription)): ?>
    <form action="<?= ROOT ?>/external/subscriptionpay/submitPayment" method="POST" enctype="multipart/form-data">
        <!-- ✅ Hidden subscriptionid field -->
        <input type="hidden" name="subscriptionid" value="<?= htmlspecialchars($subscription->subscriptionid) ?>">

        <div class="form-group">
            <label for="totalprice">Total Price to Pay</label>
            <?php
            $price = '';
            switch (strtolower($subscription->subscription)) {
                case 'annual':
                    $price = 6000;
                    break;
                case '6 month':
                    $price = 3500;
                    break;
                case '3 month':
                    $price = 2000;
                    break;
                default:
                    $price = 0;
            }
            ?>
            <input type="text" id="totalprice" name="totalprice" 
                value="<?= $price !== '' ? 'Rs. ' . htmlspecialchars($price) : '' ?>" readonly>
        </div>
        <div class="form-group">
            <label for="paymentproof">Upload Payment Proof</label>
            <input type="file" id="paymentproof" name="paymentproof" required>
        </div>
        <p>Note: If you have not made the payment yet, please visit <a href="https://pay.cmb.ac.lk/" target="_blank">the University of Colombo payment gateway</a> to make the payment.</p>
        <button type="submit">Submit</button>
    </form>
<?php else: ?>
    <p>No subscription found for the provided ID.</p>
<?php endif; ?>


        
      <!-- Confirmation Modal -->
<div id="confirmationModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>✅ Your payment proof was submitted successfully. It will be checked and confirmed soon.</p>
  </div>
</div>





    </body>
</html>