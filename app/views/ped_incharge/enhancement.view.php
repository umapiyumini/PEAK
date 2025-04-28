<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enhancement Letters</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/letters.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
  <?php $current_page = 'letters'; include 'sidebar.view.php'?>

  <div class="main-content">

      <div class="header">
          <h1>Enhancement Letters</h1>
          <button class="bell-icon"><i class="uil uil-bell"></i></button>
            <button class="bell-icon"><i class="uil uil-signout"></i></button>
      </div>
    <main>
    <div class="container">
        <div class="document-list">
        <?php if(!empty($enhreqs)):?>
            <?php foreach ($enhreqs as $i): ?>
            <div class="document-card">
                <div class="document-header">
                    <h3>Enhancement Letter Request</h3>
                    <span class="document-status status-pending">Pending</span>
                </div>
                <div class="document-details">
                    <div class="detail-item">
                        <span class="detail-label">Student Name</span>
                        <span class="detail-value"><?=$i->name?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Registration Number</span>
                        <span class="detail-value"><?=$i->registration_number?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Sport</span>
                        <span class="detail-value"><?=$i->sport?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tournament</span>
                        <span class="detail-value"><?=$i->achievement?></span>
                    </div>
                </div>
                <div class="document-actions">
                    <button class="btn-approve" onclick="approve(<?=$i->request_id?>)">Approve</button>
                    <button class="btn-reject" onclick="rejectDocument(<?=$i->request_id?>)">Reject</button>
                </div>
            </div>
            <?php endforeach;?>
            <?php else:?>
                <div>No Enhancement Letters Found</div>
              <?php endif;?>
        </div>
    </div>

    </main>
    <script>
        function approve(id) {
            window.location.href = `<?=ROOT?>/ped_incharge/enhancement/approve/${id}`;
        }
        function rejectDocument(id) {
            window.location.href = `<?=ROOT?>/ped_incharge/enhancement/rejectDocument/${id}`;
        }
    </script>
    <script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>