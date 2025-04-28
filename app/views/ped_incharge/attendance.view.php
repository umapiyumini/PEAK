<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Attendance Excuse Letters</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/letters.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
  <?php $current_page = 'letters'; include 'sidebar.view.php'?>

  <!-- Header and Main Content -->
  <div class="main-content">

      <div class="header">
          <h1>Attendance Excuse Letters</h1>
          <button class="bell-icon"><i class="uil uil-bell"></i></button>
            <!-- <div class="notifications-dropdown">
                <div class="notifications-header">
                    <h3>Notifications</h3>
                    <span class="clear-all">Clear All</span>
                </div>
                <div class="notifications-list">
                    <ul id="notificationsList"></ul>
                </div>
              </div> -->
            <button class="bell-icon"><i class="uil uil-signout"></i></button>
      </div>
    <main>
    <div class="container">

     
        

        <div class="document-list">
        <?php if(!empty($excuserequests)):?>
            <?php foreach ($excuserequests as $i): ?>
            <div class="document-card">
                <div class="document-header">
                    <h3>Attendance Excuse</h3>
                    <span class="document-status"><?=$i->status?></span>
                </div>
                <div class="document-details">
                    <div class="detail-item">
                        <span class="detail-label">Faculty</span>
                        <span class="detail-value"><?=$i->faculty?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Registration Numbers</span>
                        <span class="detail-value"><?php foreach($i->players as $j): echo $j->reg_no; endforeach;?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Sport</span>
                        <span class="detail-value"><?=$i->sport_name?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tournament</span>
                        <span class="detail-value"><?=$i->tournament_name?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Start Date</span>
                        <span class="detail-value"><?=$i->start_date?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">End Date</span>
                        <span class="detail-value"><?=$i->end_date?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Submission Date</span>
                        <span class="detail-value"><?=$i->submit_date?></span>
                    </div>
                </div>
                <div class="document-actions">
                    <button class="btn-approve" onclick="approve(<?=$i->request_id?>)">Approve</button>
                    <button class="btn-reject" onclick="rejectDocument(<?=$i->request_id?>)">Reject</button>
                </div>
            </div>
            <?php endforeach;?>
            <?php else:?>
                <div>No Excuse Letters Found</div>
              <?php endif;?>
        </div>
    </div>

 
    </main>
    <script>
        function approve(id) {
            window.location.href = `<?=ROOT?>/ped_incharge/attendance/approve/${id}`;
        }
        function rejectDocument(id) {
            window.location.href = `<?=ROOT?>/ped_incharge/attendance/rejectDocument/${id}`;
        }
    </script>
    <script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>