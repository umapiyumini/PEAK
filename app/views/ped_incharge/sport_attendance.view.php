<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Chart</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/hockeyattendance.css">
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
        <main>
            <h1 style="margin-top:4rem;">Attendance</h1>
            <div class="controls">
                <input type="text" id="search-bar" placeholder="Search by player name..." onkeyup="filterTable()">
                <!-- <button id="generate-qr" onclick="generateQR()">Generated QR Code</button> -->
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
                        <td>Aamir Arshad</td>
                        <td class="present">Present</td>
                        <td class="absent" title="Sick">Absent</td>
                        <td class="present">Present</td>
                        <td class="absent" title="Sick">Absent</td>
                    </tr>
                    <tr>
                        <td>Dinith Dulanja</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                        <td class="absent" title="Sick">Absent</td>
                        <td class="present">Present</td>
                    </tr>
                    <tr>
                        <td>Amantha Tharusha</td>
                        <td class="absent" title="Sick">Absent</td>
                        <td class="absent" title="Sick">Absent</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                    </tr>
                    <tr>
                        <td>Theshawa Dasun</td>
                        <td class="absent" title="Sick">Absent</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                    </tr>
                    <tr>
                        <td>Mario Silva</td>
                        <td class="absent" title="Sick">Absent</td>
                        <td class="absent" title="Sick">Absent</td>
                        <td class="present">Present</td>
                        <td class="absent" title="lectures">Absent</td>
                    </tr>
                    <tr>
                        <td>Pasindu Madhushan</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                    </tr>
                    <tr>
                        <td>Akindu Liyange</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                    </tr>
                    <tr>
                        <td>Gayan Sasmina</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                    </tr>
                    <tr>
                        <td>Hirusha Deemantha</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                        <td class="absent" title="Sick">Absent</td>
                    </tr>
                    <tr>
                        <td>Chanaka Sampath</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                        <td class="absent" title="sick">Absent</td>
                        <td class="present">Present</td>
                    </tr>
                </tbody>
            </table>
        </main>
    </div>
    <script src="<?=ROOT?>/assets/js/ped_incharge/hockeyattendance.js"></script>
</body>
</html>
