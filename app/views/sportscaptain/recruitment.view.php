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
      
       <?php if(isset($data['recritmentrequest'])): ?>
        <?php foreach($data['recritmentrequest'] as $request): ?>
      <div class="notification-card">
        <p><strong>Registration No:</strong><?=htmlspecialchars($request->regno)?></p>
        <p><strong>Name:</strong><?=htmlspecialchars($request->name)?></p>
        <p><strong>Faculty:</strong><?=htmlspecialchars($request->faculty)?></p>
        <p><strong>Reason:</strong><?=htmlspecialchars($request->reason)?></p>
        <div class="action-buttons">
        <button class="approve-btn" onclick="approveRequest('<?= $request->regno ?>', this)">Approve</button>


          <button class="reject-btn" onclick="rejectRequest('<?= $request->regno ?>', this)">Reject</button>
        </div>
      </div>
  <?php endforeach; ?>
  <?php else: ?>
    <p>No recruitment requests available.</p>
  <?php endif; ?>
    </div>
  </div>

<div id="message-container"></div>

  <script src="<?=ROOT?>/assets/js/vidusha/recruitment.js"></script>
</body>
</html>
