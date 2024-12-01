<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gym Entry Requests</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/gymentry.css">
</head>
<body>
  <div class="topic-header">Gym Entry Requests</div>
  <div class="container">
    <div class="request-list">
      <div class="request-item">
        <img src="https://via.placeholder.com/50" alt="Nancy's Profile">
        <div class="request-info">
          <h2>Nancy</h2>
          <p>Reg No:1130</p>
          <p>Requested for 7:30-8:30pm</p>
        </div>
        <div class="buttons">
          <button class="approve" onclick="handleApprove('Nancy', 'Reg No:1130', '7:30-8:30pm')">Approve</button>
          <button class="reject" onclick="handleReject('Nancy', 'Reg No:1130', '7:30-8:30pm')">Reject</button>
        </div>
      </div>

      <div class="request-item">
        <img src="https://via.placeholder.com/50" alt="Kate's Profile">
        <div class="request-info">
          <h2>Kate</h2>
          <p>Reg No:1131</p>
          <p>Requested for 10:30-11:30am</p>
        </div>
        <div class="buttons">
          <button class="approve" onclick="handleApprove('Kate', 'Reg No:1131', '10:30-11:30am')">Approve</button>
          <button class="reject" onclick="handleReject('Kate', 'Reg No:1131', '10:30-11:30am')">Reject</button>
        </div>
      </div>

      <div class="request-item">
        <img src="https://via.placeholder.com/50" alt="James's Profile">
        <div class="request-info">
          <h2>James</h2>
          <p>Reg No:1132</p>
          <p>Requested for 5:30-6:30pm</p>
        </div>
        <div class="buttons">
          <button class="approve" onclick="handleApprove('James', 'Reg No:1132', '5:30-6:30pm')">Approve</button>
          <button class="reject" onclick="handleReject('James', 'Reg No:1132', '5:30-6:30pm')">Reject</button>
        </div>
      </div>

      <div class="request-item">
        <img src="https://via.placeholder.com/50" alt="Daniel's Profile">
        <div class="request-info">
          <h2>Daniel</h2>
          <p>Reg No:1133</p>
          <p>Requested for 6:30-7:30pm</p>
        </div>
        <div class="buttons">
          <button class="approve" onclick="handleApprove('Daniel', 'Reg No:1133', '6:30-7:30pm')">Approve</button>
          <button class="reject" onclick="handleReject('Daniel', 'Reg No:1133', '6:30-7:30pm')">Reject</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div id="modal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <h2 id="modalTitle"></h2>
      <p id="modalUsername"></p>
      <p id="modalRequestTime"></p>
      <button id="confirmButton">Confirm</button>
    </div>
  </div>

  <script src="<?=ROOT?>/assets/js/vidusha/gymentry.js"></script>
</body>
</html>
