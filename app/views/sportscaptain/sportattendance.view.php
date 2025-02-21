<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Chart</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/sportattendance.css">
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
    <header>
        <h1>Practice Attendance Chart</h1>
    </header>
    <main>
        <div class="controls">
            <input type="text" id="search-bar" placeholder="Search by player name..." onkeyup="filterTable()">
        </div>
        
        <?php if (!empty($attendance['records'])) { ?>
    <table id="attendance-chart">
        <thead>
            <tr>
                <th>Player Name</th>
                <?php foreach ($attendance['dates'] as $date) { ?>
                    <th><?php echo htmlspecialchars($date); ?></th>
                <?php } ?>  
            </tr>
        </thead>
        <tbody>
        <?php
        $groupedAttendance = [];

        // Group attendance records by player
        foreach ($attendance['records'] as $record) {
            $groupedAttendance[$record->name][$record->date] = $record->attendance;
        }

        foreach ($groupedAttendance as $playerName => $playerAttendance) { ?>
            <tr>
                <td><?php echo htmlspecialchars($playerName); ?></td>
                
                <?php foreach ($attendance['dates'] as $date) { 
                    $status = $playerAttendance[$date] ?? 'Absent'; // Default to 'Absent' if no record
                    $class = ($status === 'Present') ? 'present' : 'absent';
                ?>
                    <td class="<?php echo $class; ?>"><?php echo htmlspecialchars($status); ?></td>
                <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <p>No attendance records found.</p>
<?php } ?>

    </main>
    <script src="<?=ROOT?>/assets/js/vidusha/sportattendance.js"></script>
</body>
</html>
