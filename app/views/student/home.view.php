<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/amar/home.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/amar/ped.css">

  <style>
    .notice-container {
      display: flex;
      flex-direction: column;
      gap: 20px;
      padding: 20px;
    }

    .notice-item {
      border: 8px solid #d8b4f8; /* Light purple */
      border-radius: 8px;
      padding: 15px 20px;
      background-color: #f9f9f9;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .notice-item h2 {
      margin-bottom: 10px;
      font-size: 1.5em;
      color: #333;
    }

    .notice-item p {
      margin: 5px 0;
      line-height: 1.6;
    }

    main {
      padding: 20px;
    }

    #studentPhoto {
      max-width: 150px;
      margin: 20px 0;
      border-radius: 8px;
    }

    h1 {
      text-align: center;
      margin: 10px 0;
    }
  </style>
</head>
<body>
<?php 
include 'nav.view.php';
?>

<main>
  <section class="content">
    <h1>Physical Education Administrative Kit</h1>
    <h1>University Of Colombo</h1>
    <img src="<?=ROOT?>/assets/images/amar/ped_logo.jpg" alt="Student Photo" id="studentPhoto">

    <h1>Notices</h1>
    <div class="notice-container">
      <?php if(!empty($notices)): ?>
        <?php foreach($notices as $n): ?>      
          <div class="notice-item">
            <h2><?= $n->title ?></h2>
            <p><strong>Date: <?= $n->publishdate ?></strong> | <strong>Time: <?= $n->publishtime ?></strong></p>
            <p><strong>Details:</strong> <?= $n->content ?></p>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </section>
</main>

<script src="home.js"></script>
<script src="navbar.js"></script>
</body>
</html>