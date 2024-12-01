<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/indoor_reservation.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <?php $current_page = 'reservation'; include 'sidebar.view.php'?>

    <!-- Header and Main Content -->
    <div class="main-content">

        <div class="header">
            <h1>Indoor stadium reservations</h1>
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
            <button class="bell-icon"><i class="uil uil-signout"></i></button>
        </div>
        <main>
            <div class="container cal">  
                <section class="calendar-section">
                    <div class="calendar">
                        <div class="calendar-header">
                            <span id="prev" class="nav_cal"><i class="uil uil-arrow-left"></i></span>
                            <span id="month-year"></span>
                            <span id="next" class="nav_cal"><i class="uil uil-arrow-right"></i></span>
                        </div>
                        <div class="calendar-body">
                            <div class="days">
                                <div>Mon</div>
                                <div>Tue</div>
                                <div>Wed</div>
                                <div>Thu</div>
                                <div>Fri</div>
                                <div>Sat</div>
                                <div>Sun</div>
                            </div>
                            <div class="dates" id="dates"></div>
                        </div>
                    </div>
                </section>

                <aside class="controls-section">
                    <div class="button-group">
                        <button class="button" onclick="window.location.href='requests';">Requests</button>
                        <button class="button" onclick="window.location.href='all_reservations_indoor';">All reservations</button>
                    </div>

                    <div class="legend">
                        <div class="legend-item">
                            <div class="legend-color external"></div>
                            <span>External</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color sports"></div>
                            <span>Sports</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color special"></div>
                            <span>Special events</span>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="calendar-container">
                <div class="time-column">
                    <!-- Day view with hourly slots -->
                    <div class="time">Time</div>
                    <div class="time">6:00 AM</div>
                    <div class="time">7:00 AM</div>
                    <div class="time">8:00 AM</div>
                    <div class="time">9:00 AM</div>
                    <div class="time">10:00 AM</div>
                    <div class="time">11:00 AM</div>
                    <div class="time">12:00 PM</div>
                    <div class="time">1:00 PM</div>
                    <div class="time">2:00 PM</div>
                    <div class="time">3:00 PM</div>
                    <div class="time">4:00 PM</div>
                    <div class="time">5:00 PM</div>
                    <div class="time">6:00 PM</div>
                    <!-- Add more time slots as needed -->
                </div>

                <div class="day-column">
                    <!-- Day view with hourly slots -->
                    <div class="day">Sunday</div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <!-- Add more time slots as needed -->
                </div>

                <div class="day-column">
                    <!-- Day view with hourly slots -->
                    <div class="day">Monday</div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <!-- Add more time slots as needed -->
                </div>
                
                <div class="day-column">
                    <!-- Day view with hourly slots -->
                    <div class="day">Tuseday</div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <!-- Add more time slots as needed -->
                </div>
                
                <div class="day-column">
                    <!-- Day view with hourly slots -->
                    <div class="day">Wednsday</div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <!-- Add more time slots as needed -->
                </div>

                <div class="day-column">
                    <!-- Day view with hourly slots -->
                    <div class="day">Thursay</div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <!-- Add more time slots as needed -->
                </div>

                <div class="day-column">
                    <!-- Day view with hourly slots -->
                    <div class="day">Friday</div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <!-- Add more time slots as needed -->
                </div>

                <div class="day-column">
                    <!-- Day view with hourly slots -->
                    <div class="day">Saturday</div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <div class="time-slot"></div>
                    <!-- Add more time slots as needed -->
                </div>
            </div>
        </main>
    </div>

  

    <script src="<?=ROOT?>/assets/js/ped_incharge/home.js"></script>
    <script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>
