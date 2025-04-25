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
            <button class="action-btn" id="scan-qr-btn" onclick="toggleQRScanner()">Scan QR Code</button>
            <button class="action-btn" id="generate-qr-btn" onclick="showQRCodeGenerator()">Generate QR Code</button>
        </div>

        <!-- Scanner Area -->
        <div id="scanner-area" class="scanner-area">
            <h3>Scan Player QR Code</h3>
            <div id="scanner-container">
                <div id="qr-reader"></div>
                <p>Position the QR code in the scanner.</p>
            </div>
        </div>

        <!-- Month Selector -->
        <div class="month-selector">
            <button class="month-btn active" onclick="showMonth('january')">January</button>
            <button class="month-btn" onclick="showMonth('february')">February</button>
            <button class="month-btn" onclick="showMonth('march')">March</button>
            <button class="month-btn" onclick="showMonth('april')">April</button>
            <button class="month-btn" onclick="showMonth('may')">May</button>
            <button class="month-btn" onclick="showMonth('june')">June</button>
            <button class="month-btn" onclick="showMonth('july')">July</button>
            <button class="month-btn" onclick="showMonth('august')">August</button>
            <button class="month-btn" onclick="showMonth('september')">September</button>
            <button class="month-btn" onclick="showMonth('october')">October</button>
            <button class="month-btn" onclick="showMonth('november')">November</button>
            <button class="month-btn" onclick="showMonth('december')">December</button>
        </div>
        
        <div class="overflow-x-auto">
            <!-- January Table -->
            <!-- Attendance Table -->
<table class="attendance-table">
    <thead>
        <tr>
            <th>Player Name</th>
            <?php foreach ($dates as $date): ?>
                <th><?= date('d/m', strtotime($date)) ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($playerData as $player): ?>
            <tr>
                <td><?= htmlspecialchars($player['name']) ?></td>
                <?php foreach ($dates as $date): ?>
                    <?php 
                        $status = $player['dates'][$date] ?? ''; 
                        $class = strtolower($status);
                        $display = $status === 'present' ? '' : ucfirst($status);
                    ?>
                    <td class="<?= $class ?> attendance-cell" onclick="openAttendanceModal('<?= $player['name'] ?>', '<?= $date ?>', '<?= $status ?>')"><?= $display ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

    </main>

    <!-- Attendance Modal -->
    <div id="attendance-modal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close" onclick="closeAttendanceModal()">&times;</span>
            <h3>Update Attendance</h3>
            <form id="attendance-form">
                <input type="hidden" id="student-id" name="student-id">
                <input type="hidden" id="attendance-date" name="attendance-date">
                
                <div class="form-group">
                    <label for="attendance-notes">Reason:</label>
                    <textarea id="attendance-notes" name="attendance-notes" rows="3"></textarea>
                </div>
                
                <button type="button" class="action-btn" onclick="saveAttendance()">Save</button>
            </form>
        </div>
    </div>

    <!-- QR Code Generator Modal -->
    <div id="qr-generator-modal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close" onclick="closeQRGeneratorModal()">&times;</span>
            <h3>Generate QR Code</h3>
            <form id="qr-form">
                <div class="form-group">
                    <label for="qr-date">Date:</label>
                    <input type="date" id="qr-date" name="qr-date" value="">
                </div>
                
                <button type="button" class="action-btn" onclick="generateQRCode()">Generate</button>
            </form>
            <div style="text-align: center; margin-top: 20px;">
                <img id="qr-image" src="" alt="QR Code" style="max-width: 200px; display: none;">
            </div>
        </div>
    </div>

    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.0.0/html5-qrcode.min.js"></script>


    <script src="<?=ROOT?>/assets/js/vidusha/sportattendance.js"></script>
</body>
</html>
