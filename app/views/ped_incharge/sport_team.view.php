<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hockey Team Roster</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/hockeyteam.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
<?php $current_page = 'sports'; include 'sidebar.view.php'?>
    <div class="main-content">
    <div class="navbar" style="border-radius:8px;">
    <a href="hockey">Home</a>
            <a href="hockeyattendance">Attendance</a>
            <a href="hockeyteam">Team</a>
            <a href="hockeycoaches">Coaches</a>
            <a href="hockeyschedule">Schedule</a>
            <a href="hockeysportrecords">Records</a>
    </div>
    <div class="container">
        <h1 style="margin-top:4rem;">Hockey Men's Team</h1>
        
        <div class="form-container" style="display: none;">
            <h2>Player Details</h2>
            <form id="player-form">
                <input type="text" id="player-regno" placeholder="Player Reg No" value="Sudara Sachintha" required>
                <input type="text" id="player-position" placeholder="Position" value="Goal Keeper" required>
                <input type="number" id="player-number" placeholder="Jersey Number" value="01" required>
                <!-- <button type="submit">Player Details</button> -->
            </form>
        </div>

        <div class="roster-container">
            <h2>Team</h2>
            <table id="roster-table">
                <thead>
                    <tr>
                        <th>Reg No</th>
                        <th>Position</th>
                        <th>Jersey Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Player rows will be added here dynamically -->
                </tbody>
            </table>
        </div>
    </div>
</div>

    <script src="<?=ROOT?>/assets/js/ped_incharge/hockeyteam.js"></script>
</body>
</html>
