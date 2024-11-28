<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/amar/gym.css">

  <title>Request Gym Access</title>
 
</head>
<body>

<?php 
include 'nav.view.php';
?>

  <div class="container">
   
    <main>

      <section class="form-section">
        <h2>Request Gym Access</h2>
        <p>Please note that your request will be reviewed by the gym manager. You will receive an email to confirm your booking.</p>
        <form action="#" method="post" class="request-form">
          <div class="form-group">
            <label for="date">Preferred date</label>
            <input type="date" id="date" name="date" required>
          </div>
          <div class="form-group">
            <label for="time-slot">Preferred time slot</label>
            <input type="text" id="time-slot" name="time-slot" placeholder="Enter time slot" required>
          </div>
          <div class="form-group">
            <label for="notes">Personal preferences or notes</label>
            <textarea id="notes" name="notes" rows="4" placeholder="Enter any special requirements or notes"></textarea>
          </div>
          <button type="submit" class="submit-button">Submit</button>
        </form>
      </section>
    </main>
  </div>
</body>
</html>
