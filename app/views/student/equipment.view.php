<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/amar/equipment.css">

  <title>Sports Equipment Request</title>
  
</head>
<body>

<?php 
include 'nav.view.php';
?>
 
  <div class="container">
    <main class="main-content">
      <h1>Sports Equipment Request</h1>
      <form class="form">
        <label for="equipment-type">Equipment Type</label>
        <select id="equipment-type" required>
          <option value="" disabled selected>Select an equipment type</option>
          <option value="Basketball">Basketball</option>
          <option value="Soccer Ball">Soccer Ball</option>
          <option value="Tennis Racket">Tennis Racket</option>
        </select>

        <label for="quantity">Quantity</label>
        <input type="number" id="quantity" placeholder="Enter quantity" required>

        <label for="additional-info">Additional Information</label>
        <textarea id="additional-info" placeholder="Enter additional information"></textarea>

        <button type="submit">Submit Request</button>
      </form>
    </main>

    
  </div>
</body>
</html>
