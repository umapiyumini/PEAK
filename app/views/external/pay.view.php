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

        <?php if (!empty($_SESSION['payment_success'])): ?>
  <script>
    window.onload = function() {
      const modal = document.getElementById("confirmationModal");
      const closeBtn = document.querySelector(".close");
      modal.style.display = "block";
      closeBtn.onclick = function () {
          modal.style.display = "none";
      };
      window.onclick = function (event) {
          if (event.target == modal) {
              modal.style.display = "none";
          }
      };
    };
  </script>
  <?php unset($_SESSION['payment_success']); ?>
<?php endif; ?>


        
        <form id="paymentForm" action="<?= ROOT ?>/external/pay/submitPayment" method="POST" enctype="multipart/form-data" onsubmit="return validateAndSubmit(event)">    
        <div>
                <label for="reservationid">Reservation ID</label>
                <input type="text" id="reservationid" name="reservationid" 
                    value="<?= isset($_POST['reservationid']) ? htmlspecialchars($_POST['reservationid']) : '' ?>" 
                    readonly>
            </div>
            <div class="form-group">
                <label for="totalprice">Total Price to Pay</label>
                <input type="text" id="totalprice" name="totalprice" 
                    value="<?= isset($_POST['discountedprice']) ? 'Rs. ' . htmlspecialchars($_POST['discountedprice']) : '' ?>" 
                    readonly>
            </div>
            <div class="form-group">
                <label for="paymentproof">Upload Payment Proof</label>
                <input type="file" id="paymentproof" name="paymentproof" required>
            </div>
            <p>Note: If you have not made the payment yet, please visit <a href="https://pay.cmb.ac.lk/" target="_blank">the University of Colombo payment gateway</a> to make the payment.</p>
            <button type="submit">Submit</button>
        </form>
        </div>
        </div>
        
        <!-- Confirmation Modal -->
        <div id="confirmationModal" class="modal" style="display: none;">
          <div class="modal-content">
            <span class="close">&times;</span>
            <p>✅ Your payment proof was submitted successfully. It will be checked and confirmed soon.</p>
          </div>
        </div>

        




</div>

        <script>
           function validateAndSubmit(event) {
    event.preventDefault(); // Prevent default form submission
    
    // Check if file is selected
    const fileInput = document.getElementById('paymentproof');
    if (!fileInput.files.length) {
        alert('Please select a payment proof file');
        return false;
    }
    
    // Show the modal
    const modal = document.getElementById('confirmationModal');
    modal.style.display = 'block';
    
    // Submit the form after a short delay to allow the modal to be seen
    setTimeout(function() {
        document.getElementById('paymentForm').submit();
    }, 2000); // 2 seconds delay
    
    return false; // Prevent default form submission
}
            </script>
    </body>

</html>
