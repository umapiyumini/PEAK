<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-1.0">
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/prices.css">
        <title>External User Dashboard</title>
    </head>


    <body>
        <!-- navigation bar -->
        <?php include 'enav.view.php'; ?>
        <div class="main">
        <?php include 'top.view.php'; ?>

        
        <div class="container1">
        <h1 class="title1">Select a Facility to View Prices</h1>
        <div class="cards">
          <div class="card">
            <h2>Ground Facility</h2>
            <p>View prices for the hockey court, cricket pitch, and more.</p>
            <a href= "groundprices"><button onclick="viewPrices('Ground Facility')">View Prices</button></a>
          </div>
          <div class="card">
            <h2>Indoor Stadium</h2>
            <p>Check prices for the table tennis court, badminton court, etc.</p>
            <a href= "indoorprices"><button onclick="viewPrices('Indoor Stadium')">View Prices</button></a>
          </div>
          <div class="card">
            <h2>Strength Hall</h2>
            <p>Explore prices fitness facilities.</p>
            <a href="strength"><button onclick="viewPrices('Strength Hall')">View Prices</button></a>
          </div>
        </div>
      </div>
    
    </div>

        
        
    </body>
</html>