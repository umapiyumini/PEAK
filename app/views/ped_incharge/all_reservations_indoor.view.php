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

            <div id="reservations-school">
            <div class="reservation school">
        <div class="reservation-header">
            <h3 class="client-name">Thurstan College</h3>
            <span class="status">Paid</span>
        </div>
        <div class="reservation-details">
            <div class="detail-item">
                <div class="detail-label">Reservation ID</div>
                <div class="detail-value">GR001</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Contact</div>
                <div class="detail-value">+1234567890</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Date</div>
                <div class="detail-value">2024-11-18</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Time</div>
                <div class="detail-value">14:00-16:00</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Event</div>
                <div class="detail-value">Volleyball match</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Payment</div>
                <div class="detail-value">5000Rs</div>
            </div>
        </div>
        <button class="cancel-btn" >Cancel Reservation</button>
    </div>

    <div class="reservation club">
        <div class="reservation-header">
            <h3 class="client-name">UOC Badminton team</h3>
        </div>
        <div class="reservation-details">
            <div class="detail-item">
                <div class="detail-label">Reservation ID</div>
                <div class="detail-value">GR002</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Contact</div>
                <div class="detail-value">+1987654321</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Date</div>
                <div class="detail-value">2024-11-18</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Time</div>
                <div class="detail-value">16:30-18:30</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Event</div>
                <div class="detail-value">Practices</div>
            </div>
        </div>
        <button class="cancel-btn">Cancel Reservation</button>
    </div>

    <div class="reservation individual">
        <div class="reservation-header">
            <h3 class="client-name">Mr. Weerasinghe</h3>
            <span class="status">Not paid</span>
        </div>
        <div class="reservation-details">
            <div class="detail-item">
                <div class="detail-label">Reservation ID</div>
                <div class="detail-value">GR003</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Contact</div>
                <div class="detail-value">+1122334455</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Date</div>
                <div class="detail-value">2024-11-19</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Time</div>
                <div class="detail-value">09:00-10:00</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Event</div>
                <div class="detail-value">Karate</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Payment</div>
                <div class="detail-value">10000Rs</div>
            </div>
        </div>
        <button class="cancel-btn">Cancel Reservation</button>
    </div>

        </main>   

  

 
  
    <script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>

</body>
</html>
