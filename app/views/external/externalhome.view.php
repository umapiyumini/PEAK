<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-1.0">
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/edashboard.css">
        <title>External User Dashboard</title>
    </head>


    <body>
        <!-- navigation bar -->
        <?php include 'enav.view.php'; ?>
        <div class="main">
        <?php include 'top.view.php'; ?>
                <div class="container1">
                 <div class="namecard">
                    <h1 class="titlecard">Welcome John!</h1>
                    <img src="<?=ROOT?>/assets/images/user1.jpg" class="propic">
                    <p class="aboutcard">Company ABC Pvt Ltd</p>
                   
                    </p>
                    </div>
                
                 <div class="popularreservations">
                    <h2 class="sectiontitle">Top Reservation Picks</h2>
                    <div class="imagecontainer">
                        <div class="imageitem">
                            <img src="<?=ROOT?>/assets/images/ground.jpg" alt="Ground" class="reservationimage">
                            <p class="price">Baseball ground</p>
                            <p class="price">Rs 10,000 / hour</p>
                        </div>
                        <div class="imageitem">
                            <img src="<?=ROOT?>/assets/images/indoor.jpg" alt="Stadium" class="reservationimage">
                            <p class="price">Badminton Court</p>
                            <p class="price">Rs 15,000 / hour</p>
                        </div>
                        <div class="imageitem">
                            <img src="<?=ROOT?>/assets/images/tennis.jpg" alt="Tennis Court" class="reservationimage">
                            <p class="price">Tennis Court</p>
                            <p class="price">Rs 5,000 / hour</p>
                        </div>
                        <div class="imageitem">
                            <img src="<?=ROOT?>/assets/images/basketball.jpg" alt="Basketball Court" class="reservationimage">
                            <p class="price">Basketball Court</p>
                            <p class="price">Rs 7,000 / hour</p>
                        </div>
                    </div>
                </div>

            </div>

                <!-- Second row of cards -->
                <div class="container2">
    <!-- Pending Requests Card -->
    <div class="namecard">
        <h3>Upcoming Events</h3>
        <div class="request-details">
            <?php if (!empty($upcoming)): ?>
                <?php foreach ($upcoming as $request): ?>
                    <div class="request-item">
                        <p><strong>Facility:</strong> <?= htmlspecialchars($request->courtname) ?></p>
                        <p><strong>Booking Time:</strong> <?= htmlspecialchars($request->time) ?></p>
                        <p><strong>Price:</strong> Rs <?= number_format($request->price, 2) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No upcoming events.</p>
            <?php endif; ?>
        </div>
    </div>



    <!-- Payments Due Card -->
    <div class="namecard">
    <h3>Payments Due</h3>
    <div class="payment-details">
        <?php if (!empty($duePayments) && is_array($duePayments)) : ?>
            <?php $totalDue = 0; ?>
            <?php foreach ($duePayments as $payment) : ?>
                <div class="payment-item">
                    
                    <p><strong>Facility:</strong> <?= htmlspecialchars($payment->courtname) ?></p>
                    <p><strong>Price:</strong> Rs <?= number_format((float)$payment->price, 2) ?></p>
                </div>
                <?php $totalDue += (float)$payment->price; ?>
            <?php endforeach; ?>
            <div class="total-payment">
                <h4>Total Due: Rs <?= number_format($totalDue, 2) ?></h4>
            </div>
        <?php else : ?>
            <p>No pending payments.</p>
        <?php endif; ?>
    </div>
</div>



    <!-- Quick Action Cards -->
    <!-- <div class="namecard">
        <h3>Quick Actions</h3>
        <div class="action-buttons">
            <button class="action-button">Make New Reservation</button>
            <a href="prices"><button class="action-button">View <br> Prices</button></a>
            <button class="action-button">View Discounts</button>
            <button class="action-button">View Availabilities</button>
        </div>
    </div>
    
</div> -->

<div class="namecard">
    <h3>Quick Actions</h3>
    <div class="action-buttons">
        <a href="pickfacility" >
            <button class="action-button">Make New Reservation</button>
        </a>
        <a href="prices" >
            <button class="action-button">View <br> Prices</button>
        </a>
        <a href="discounts">
            <button class="action-button">View <br> Discounts</button>
        </a>
        <a href="rules" >
            <button class="action-button">View Rules and regulations</button>
        </a>
    </div>
</div>

        </div>
       <script> 
        let toggle = document.querySelector(".toggle");
                let navigation = document.querySelector(".navigation");
                let main = document.querySelector(".main");

                toggle.onclick = function(){
                navigation.classList.toggle("active");
                main.classList.toggle("active");
  
            }
       </script>
        <script src="../js/dashboard.js"></script>
    </body>
</html>