<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Reservations</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/all_reservation.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <?php $current_page = 'reservation'; include 'sidebar.view.php'?>

    <!-- Header and Main Content -->
    
    <div class="main-content">

        <div class="header">
        <button onclick="history.back()" class="goBackButton"><i class="uil uil-arrow-left"></i></button>
            <h1>All Reservations</h1>
            <button class="bell-icon"><i class="uil uil-bell"></i></button>
            <!-- <div class="notifications-dropdown">
                <div class="notifications-header">
                    <h3>Notifications</h3>
                    <span class="clear-all">Clear All</span>
                </div>
                <div class="notifications-list">
                    <ul id="notificationsList"></ul>
                </div>
              </div> -->
            <button class="bell-icon"><a href="<?=ROOT?>/logout"><i class="uil uil-signout"></i></a></button>
        </div> 
        <main>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search...">
                <i class="uil uil-search"></i>
            </div>

            <?php if(!empty($allReservations)): ?>
             <?php foreach($allReservations as $i): ?>
                <div class="reservation <?= strtolower(str_replace(' ', '-', $i->role)) ?>">
                    <div class="reservation-header">
                        <h3 class="client-name"><?= $i->username ?></h3>
                        <span class="status"><?= $i->status ?></span>
                    </div>
                    <div class="reservation-details">
                        <div class="detail-item">
                            <div class="detail-label">Reservation ID</div>
                            <div class="detail-value"><?= $i->reservationid ?></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Contact</div>
                            <div class="detail-value"><?= $i->contact_number ?></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Date</div>
                            <div class="detail-value"><?= $i->date ?></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Time</div>
                            <div class="detail-value"><?= $i->time ?></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Event</div>
                            <div class="detail-value"><?= $i->event ?></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Court</div>
                            <div class="detail-value"><?= $i->courtname ?></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Payment</div>
                            <div class="detail-value"><?= $i->discountedprice ?></div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
               <?php endif; ?>
        </main>   

  

   
    <script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>

</body>
</html>
