<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pool Passes</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/pool.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
<?php $current_page = 'pool'; include 'sidebar.view.php'?>
    <div class="main-content">
       
        
        
        <div class="header">
            <h1>Pool Passes</h1>
            <button class="bell-icon"><i class="uil uil-bell"></i></button>
            <div class="notifications-dropdown">
                <div class="notifications-header">
                    <h3>Notifications</h3>
                    <span class="clear-all">Clear All</span>
                </div>
                <div class="notifications-list">
                <ul id="notificationsList"></ul>
            </div>
        </div>
        
        <button class="bell-icon"><i class="uil uil-signout"></i></button>
    </div>
    <main>

         <div class="container">
         <div class="settings-panel">
            <h2>Pool Settings</h2>
            <div class="controls">
                <form method="POST" action="<?=ROOT?>/ped_incharge/pool/saveSettings">
                    <div>
                        <label>Daily Student Limit:</label>
                        <input type="number" id="studentLimit" name='studentLimit' min="1" max="100" value="<?=$poolSettingsList[0]->student_limit?>">
                    </div>
                    <div>
                        <label>Pool Hours:</label>
                        <input type="time" id="startTime" name='startTime' value="<?= $poolSettingsList[0]->start_time?>">
                        <span>to</span>
                        <input type="time" id="endTime" name="endTime" value="<?= $poolSettingsList[0]->end_time?>">
                    </div>
                    <button type="submit" class="btn btn-save" >Save Settings</button>
                </form>
            </div>
        </div>
        <div class="cal-section">
        <div class="calendar">
            <div class="calendar-header">
                <button class="btn btn-next" onclick="previousMonth()">&lt;</button>
                <h2 id="currentMonth">November 2024</h2>
                <button class="btn btn-next" onclick="nextMonth()">&gt;</button>
            </div>
            <div class="calendar-grid" id="calendarGrid">
                <!-- Calendar days will be inserted here -->
            </div>
        </div>

        <div class="bookings-list" id="bookingsList">
            <h2>Bookings for <span id="selectedDate">November 27, 2024</span></h2>
            <div id="bookingsContainer">
                <!-- dynamically displayed using php and js -->
            </div>
        </div>
    </div>
</div>


</main>
            
<script>
    let bookings = <?= $bookings ?>;
</script>

    
	<script src="<?=ROOT?>/assets/js/ped_incharge/pool.js"></script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>

