<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Recruitment</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/recruitment.css">
</head>
<body>

  <div class="container">
    <h1>Student Recruitment Notifications</h1>
    <div id="notification-list">
      <!-- Sample student notification -->
      <div class="notification-card">
        <p><strong>Registration No:</strong> 12345</p>
        <p><strong>Name:</strong> John Doe</p>
        <p><strong>Faculty:</strong> Computer Science</p>
        <p><strong>Reason:</strong> School hocky team member</p>
        <div class="action-buttons">
          <button class="approve-btn" onclick="approveRequest(12345)">Approve</button>
          <button class="reject-btn" onclick="rejectRequest(12345)">Reject</button>
        </div>
      </div>
      <!-- Add more notifications dynamically -->
    </div>
  </div>
  <div id="notification-list"></div>
<div id="message-container"></div>

  <script src="<?=ROOT?>/assets/js/vidusha/recruitment.js"></script>
</body>
</html>
