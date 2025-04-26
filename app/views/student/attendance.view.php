<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Chart</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/sportattendance.css">
</head>
<body>

<script src="https://unpkg.com/html5-qrcode"></script>

<!-- Scanner Area -->
<div id="qr-reader" style="width: 300px;"></div>

<!-- Hidden Form -->
<form id="attendance-form" action="<?=ROOT?>/attendance/submit" method="POST">
  <input type="hidden" name="reg_no" id="reg_no">
  <input type="hidden" name="date" id="date">
  <input type="hidden" name="sport_id" id="sport_id">
  <input type="hidden" name="attendance" value="Present">
</form>

<script>
const html5QrCode = new Html5Qrcode("qr-reader");

function onScanSuccess(decodedText) {
    const parts = decodedText.split("|");
    if (parts[0] === "attendance" && parts.length === 4) {
        document.getElementById("reg_no").value = parts[1];
        document.getElementById("date").value = parts[2];
        document.getElementById("sport_id").value = parts[3];
        document.getElementById("attendance-form").submit();
    } else {
        alert("Invalid QR format");
    }
}

html5QrCode.start(
    { facingMode: "environment" },
    { fps: 10, qrbox: 250 },
    onScanSuccess
).catch(err => {
    console.error("Camera error:", err);
});
</script>


</body>
</html>
