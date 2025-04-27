<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coaches Details</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/hockeycoaches.css">
</head>
<body>
    <?php $current_page = 'sports'; include 'sidebar.view.php'?>
    <div class="main-content">
    <div class="navbar">
    <a href="hockey">Home</a>
            <a href="hockeyattendance">Attendance</a>
            <a href="hockeyteam">Team</a>
            <a href="hockeycoaches">Coaches</a>
            <a href="hockeyschedule">Schedule</a>
            <a href="hockeysportsrecords">Records</a>
    </div>
        <div class="container">
            <h1>Coaches and Instructors</h1>
        
            <section>
                <div id="combined-container" class="tiles-container">
                    <!-- Combined coaches and instructors cards will be added dynamically here -->
                </div>
            </section>
        </div>    
        </div>
    <script src="<?=ROOT?>/assets/js/ped_incharge/hockeycoaches.js"></script>
</body>
</html>
