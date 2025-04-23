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
            <button id="generate-qr" onclick="generateQRCode()">Generated QR Code</button>
            <img id="qr-image" src="" alt="QR Code">
        </div>
        
        
            <div class="card-body">
        <?php if (empty($playerData)): ?>
            <div class="alert alert-info">No attendance records found.</div>
        <?php else: ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Player Name</th>
                        <?php foreach ($dates as $date): ?>
                            <th><?= date('M d', strtotime($date)) ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($playerData as $player): ?>
                        <tr>
                            <td><?= $player['name'] ?></td>
                            <?php foreach ($dates as $date): ?>
                                <?php if (isset($player['dates'][$date])): ?>
                                    <?php if ($player['dates'][$date] == 'Present'): ?>
                                        <td class="bg-success text-white">Present</td>
                                    <?php elseif ($player['dates'][$date] == 'Absent'): ?>
                                        <td class="bg-danger text-white absent-cell" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#absenceReasonModal"
                                            data-player="<?= $player['name'] ?>"
                                            data-date="<?= $date ?>">
                                            Absent
                                        </td>
                                    <?php else: ?>
                                        <td class="bg-secondary text-white">-</td>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <td class="bg-secondary text-white">-</td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    </main>
    <script>
function generateQRCode() {
    const userId = "<?= $_SESSION['userid'] ?? 'guest' ?>";
    const date = new Date().toISOString().slice(0, 10);
    const qrText = `attendance|${userId}|${date}`;
    const qrUrl = `https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=${encodeURIComponent(qrText)}`;
    
  
    console.log("QR Text:", qrText);
    console.log("QR URL:", qrUrl);
    document.getElementById("qr-image").src = qrUrl;
}
</script>
    <script src="<?=ROOT?>/assets/js/vidusha/sportattendance.js"></script>
</body>
</html>
