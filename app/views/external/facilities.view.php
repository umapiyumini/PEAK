<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-1.0">
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/facility.css">
        <title>External User Dashboard</title>
    </head>


    <body>
        <!-- navigation bar -->
        <?php include 'enav.view.php'; ?>
        <div class="main">
        <?php include 'top.view.php'; ?>

        <div class="main1">
                <!-- Page Title -->
                <div class="page-title">
                    <h1>Explore Our Facilities</h1>
                    <p>Choose the perfect space for your next event or activity!</p>
                </div>
        
                <!-- Facility Grid -->
                <div class="facility-grid">
                    <div class="facility-card">
                        <img src="<?=ROOT?>/assets/images/tennis.jpg" alt="Tennis Court">
                        <h3>Tennis Court</h3>
                        <p>Perfect for a friendly match or serious practice.</p>
                        <p class="price">Rs 2,500/2hrs</p>
                       <a href="groundform"> <button class="reserve-button">Book Now</button></a>
                    </div>
                    <div class="facility-card">
                        <img src="<?=ROOT?>/assets/images/basketball.jpg" alt="Basketball Court">
                        <h3>Basketball Court</h3>
                        <p>Perfect for team games and basketball lovers.</p>
                        <p class="price">Rs 6,000/2hrs</p>
                        <a href="groundform"> <button class="reserve-button">Book Now</button></a>
                    </div>
                    <div class="facility-card">
                        <img src="<?=ROOT?>/assets/images/indoor.jpg" alt="Indoor Stadium">
                        <h3>Indoor Badminton court</h3>
                        <p>Ideal for tournaments</p>
                        <p class="price">Rs 3000/hr</p>
                        <a href="indoorform"> <button class="reserve-button">Book Now</button></a>
                    </div>
                    <div class="facility-card">
                        <img src="<?=ROOT?>/assets/images//tennis.jpg" alt="Tennis Court">
                        <h3>Badminton Court</h3>
                        <p>Great for singles or doubles matches.</p>
                        <p class="price">Rs 1,500/hr</p>
                        <a href="groundform"> <button class="reserve-button">Book Now</button></a>
                    </div>
                    <div class="facility-card">
                        <img src="<?=ROOT?>/assets/images/indoor.jpg" alt="Indoor Stadium">
                        <h3>Indoor Stadium</h3>
                        <p>Ideal for large events and indoor sports.</p>
                        <p class="price">Rs 5,000/hr</p>
                        <a href="indoorform"> <button class="reserve-button">Book Now</button></a>
                    </div>

                    <div class="facility-card">
                        <img src="<?=ROOT?>/assets/images/tennis.jpg" alt="Tennis Court">
                        <h3>Badminton Court</h3>
                        <p>Great for singles or doubles matches.</p>
                        <p class="price">Rs 1,500/hr</p>
                        <a href="groundform"> <button class="reserve-button">Book Now</button></a>
                    </div>

                </div>
            </div>
        
            <script src="../js/dashboard.js"></script>
        </body>
        </html>