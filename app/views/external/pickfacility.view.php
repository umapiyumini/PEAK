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
    <h1 class="title1">Select a Facility to Reserve</h1>
    <div class="cards">
        <div class="card">
             <h2>Ground Facility</h2>
            <img src="<?=ROOT?>/assets/images/ground.jpg" alt="Ground Facility" class="card-image">
            <p>Reserve the hockey court, cricket pitch, and more.</p>
            <a href="groundcourts"><button onclick="reserveFacility('Ground Facility')">Select &rarr;</button></a>
        </div>


        <div class="card">
            <h2>Indoor Stadium</h2>
            <img src="<?=ROOT?>/assets/images/indoor.jpg" alt="Indoor Stadium" class="card-image">
            <p>Book the Table Tennis court, badminton court, and other facilities.</p>
            <a href="indoorcourts"><button onclick="reserveFacility('Indoor Stadium')">Select &rarr;</button></a>
        </div>


        <div class="card">
            <h2>Strength Hall</h2>
            <img src="<?=ROOT?>/assets/images/uma/hall.jpg" alt="Strength Hall" class="card-image">
            <p>Reserve fitness facilities for your sessions.</p>
            <a href="strengthform"><button onclick="reserveFacility('Strength Hall')">Select &rarr;</button></a>
        </div>

    </div>

</div>

</div>

      </div>
    
    </div>

        
        
    </body>
</html>