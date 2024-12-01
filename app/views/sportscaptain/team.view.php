<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hockey Team Roster</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/team.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

    <div class="navbar">
    <a href="sportprofile">Home</a>
            <a href="sportattendance">Attendance</a>
            <a href="team">Team</a>
            <a href="coaches">Coaches</a>
            <a href="schedule">Schedule</a>
            <a href="sportrecords">Records</a>
    </div>
    <div class="container">
        <h1>Hockey Men's Team</h1>
        
        <div class="form-container">
            <h2>Add Player</h2>
            <form id="player-form">
                <input type="text" id="player-regno" placeholder="Player Reg No" required>
                <input type="text" id="player-position" placeholder="Position" required>
                <input type="number" id="player-number" placeholder="Jersey Number" required>
                <button type="submit">Add Player</button>
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

    <script src="<?=ROOT?>/assets/js/vidusha/team.js"></script>
</body>
</html>
