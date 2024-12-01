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
        <table id="attendance-chart">
            <thead>
                <tr>
                    <th>Player Name</th>
                    <th>2024-11-22</th>
                    <th>2024-11-23</th>
                    <th>2024-11-24</th>
                    <th>2024-11-25</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>John Doe</td>
                    <td class="present">Present</td>
                    <td class="absent" title="Sick">Absent</td>
                    <td class="present">Present</td>
                    <td class="absent" title="Sick">Absent</td>
                </tr>
                <tr>
                    <td>Jane Smith</td>
                    <td class="present">Present</td>
                    <td class="present">Present</td>
                    <td class="absent" title="Sick">Absent</td>
                    <td class="present">Present</td>
                </tr>
                <tr>
                    <td>Mike Johnson</td>
                    <td class="absent" title="Sick">Absent</td>
                    <td class="absent" title="Sick">Absent</td>
                    <td class="present">Present</td>
                    <td class="present">Present</td>
                </tr>
            </tbody>
        </table>
    </main>
    <script src="<?=ROOT?>/assets/js/vidusha/sportattendance.js"></script>
</body>
</html>
