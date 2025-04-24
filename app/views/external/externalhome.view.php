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
                    <h1 class="titlecard">Welcome <?= htmlspecialchars($user->name) ?>!</h1>
                    <img src="<?= !empty($user->image) 
                        ? '/PEAK/uploads/profile_pictures/' . htmlspecialchars($user->image) 
                        : '/PEAK/assets/images/user1.jpg' ?>" class="propic" alt="Profile Picture">
                    <p class="aboutcard"><?= htmlspecialchars($company_name) ?></p>
                </div>

                
                <div class="popularreservations">
                    <h2 class="sectiontitle"> Facilities and Courts</h2>
                    <div class="imagecontainer">
                        <?php if (!empty($topCourts)): ?>
                            <?php foreach ($topCourts as $court): ?>
                            <div class="imageitem">
                                <img 
                                    src="<?= htmlspecialchars($court->image) ?>" 
                                    alt="<?= htmlspecialchars($court->name) ?>" 
                                    class="reservationimage"
                                >
                                <p class="price"><?= htmlspecialchars($court->name) ?></p>
                    
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No courts available.</p>
                        <?php endif; ?>
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
                                <p><strong>Date:</strong>   <?= htmlspecialchars($request->date) ?></p>
                                <p><strong>Booking Time:</strong> <?= htmlspecialchars($request->time) ?></p>
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



  

                <div class="namecard">
                    <h3>Quick Actions</h3>
                    <div class="action-buttons">
                        <a href="pickfacility" >
                            <button class="action-button">Make New Reservation</button>
                        </a>
                        <a href="prices" >
                            <button class="action-button">View <br> Prices</button>
                        </a>
                        <a href="discount">
                            <button class="action-button">View <br> Discounts</button>
                        </a>
                        <a href="rules" >
                            <button class="action-button">View Rules and regulations</button>
                        </a>
                    </div>
                </div>

        </div>
      
       
    </body>
</html>