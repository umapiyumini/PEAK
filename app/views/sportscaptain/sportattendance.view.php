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
    <?php include_once(__DIR__ . '/../includes/message.php'); ?>
        <div class="controls">
            <input type="text" id="search-bar" placeholder="Search by player name..." onkeyup="filterTable()">
            <button id="generate-qr" onclick="generateQRCode()">Generated QR Code</button>
            <div id="qr-image"></div>
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

        foreach ($attendance['records'] as $record) {
            $groupedAttendance[$record->name][$record->date] = $record->attendance;
        }

        foreach ($groupedAttendance as $playerName => $playerAttendance) { ?>
            <tr>
                <td><?php echo htmlspecialchars($playerName); ?></td>
                
                <?php foreach ($attendance['dates'] as $date) { 
                    $status = $playerAttendance[$date] ?? 'Absent'; 
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

    <!-- Absent Reason Modal -->
<div id="absentReasonModal" class="modal" style="display:none;">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Enter Absent Reason</h2>
    <textarea id="absentReason" rows="4" cols="50" placeholder="Enter reason here..."></textarea>
    <button id="submitReason">Submit</button>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <script>
function generateQRCode() {
    //const userId = "<?= $_SESSION['userid'] ?? 'guest' ?>";
    const date = new Date().toISOString().slice(0, 10);
    const qrText = `attendance|${date}`;

    // Clear old QR code if any
    const qrContainer = document.getElementById("qr-image");
    qrContainer.innerHTML = "";

    // Generate QR code
    new QRCode(qrContainer, {
        text: qrText,
        width: 200,
        height: 200
    });

    console.log("QR Text:", qrText);
}



</script>
    <script src="<?=ROOT?>/assets/js/vidusha/sportattendance.js"></script>
</body>
</html>
