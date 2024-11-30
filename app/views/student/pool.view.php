<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/amar/pool.css">
  <title>Request a Pass</title>


</head>
<body>


<?php 
include 'nav.view.php';
?>
  
  <div class="container">
    <h1>Request a pass</h1>
    <p>Please complete the form and we will get back to you within 48 hours</p>
    <form class="request-form">
      <div class="form-group">
        <input type="text" placeholder="First name" required>
        <input type="text" placeholder="Last name" required>
      </div>
      <div class="form-group">
        <input type="email" placeholder="Email" required>
        <input type="tel" placeholder="Phone number" required>
      </div>

      <div class="form-section">
        <label>Preferred time slots</label>
        <div class="time-slots">
          <button type="button">Morning</button>
          <button type="button">Afternoon</button>
          <button type="button">Evening</button>
          <button type="button">Weekday</button>
          <button type="button">Weekend</button>
        </div>
      </div>

      <div class="form-section">
        
      </div>

      <div class="form-section">
        <label for="additional-requests">Additional requests or instructions</label>
        <textarea id="additional-requests" placeholder="Please let us know if you have any specific requests or instructions"></textarea>
      </div>

      <div class="form-group">
        <label class="checkbox">
          <input type="checkbox" required>
          I have read and accept the terms and conditions
        </label>
      </div>

      <button type="submit" class="submit-btn">Submit request</button>
    </form>
  </div>
</body>
</html>
