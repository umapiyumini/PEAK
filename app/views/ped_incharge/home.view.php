<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Full Calendar</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/home.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">


</head>
<body>
	<header>
        <div class="header-container">
            <div class="logo">
                <img src="<?=ROOT?>/assets/images/ped_incharge/logo.png" alt="PEAK Logo">
            </div>
			<button class="hamburger" onclick="toggleMenu()">&#9776;</button>
            <nav>
                <ul>
                    <li><a href="home" class="active">Home</a></li>
                    <li><a href="ground_reservation">Dashboard</a></li>
                </ul>
            </nav>
			<button class="bell-icon">
                <i class="uil uil-bell"></i>
            </button>
            <div class="profile-icon">
                <img src="<?=ROOT?>/assets/images/ped_incharge/pro_icon.png" alt="Profile Icon">
            </div>
        </div>
		
		<div class="dropdown-menu" id="dropdownMenu">
            <ul>
                <li><a href="#"><i class="uil uil-user"></i> My Profile</a></li>
                <li><a href="#"><i class="uil uil-signout"></i> Log out</a></li>
            </ul>
		</div>
    </header>

 <main>
	 <section class="content">
		 <h1>Physical Education Administrative Kit</h1>
		 <h1>University Of Colombo</h1>
		 <img src="<?=ROOT?>/assets/images/ped_incharge/ped_logo.jpg" alt="uni logo">

  <div class="notice_board">
    <div class="notice-form">
        <form method="POST" action="<?=ROOT?>/ped_incharge/home/addnotice">
            <input type="text" name="title" placeholder="Title" value="<?= htmlspecialchars($_POST['title'] ?? '') ?>"><br>
            <?php if (isset($errors['title'])) echo '<p class="error">'.$errors['title'].'</p>'; ?>

            <textarea name="content" placeholder="Content"><?= htmlspecialchars($_POST['content'] ?? '') ?></textarea><br>
            <?php if (isset($errors['content'])) echo '<p class="error">'.$errors['content'].'</p>'; ?>

            <select name="visibility">
                <option value="">-- Select Visibility --</option>
                <option value="students" <?= (($_POST['visibility'] ?? '') == 'students') ? 'selected' : '' ?>>All Students</option>
                <option value="captains" <?= (($_POST['visibility'] ?? '') == 'captains') ? 'selected' : '' ?>>Only Sports Captains</option>
                <option value="amalgamated club" <?= (($_POST['visibility'] ?? '') == 'amalgamated club') ? 'selected' : '' ?>>Amalgamated Club</option>
            </select><br>
            <?php if (isset($errors['visibility'])) echo '<p class="error">'.$errors['visibility'].'</p>'; ?>


            <button type="submit">Publish Notice</button>
        </form>
    </div>
</div>

  
    <?php foreach ($notices as $i): ?>
      <div class="notice">
          <h2><?= htmlspecialchars($i->title) ?></h2>
          <p><?= nl2br(htmlspecialchars($i->content)) ?></p>
          <p class="notice-date"><small>Published: <?= $i->publishdate ?> at <?= $i->publishtime ?></small></p>
          <p class="notice-visibility"><small>Visibility: <?= strtoupper($i->visibility) ?></small></p>
          <div class="notice-actions">
            <button 
              onclick="editModal(this)"
              data-noticeid="<?=$i->noticeid?>"
              data-title="<?=$i->title?>"
              data-content="<?=$i->content?>"
              data-publishdate="<?=$i->publishdate?>"
              data-publishtime="<?=$i->publishtime?>"
              data-visibility="<?=$i->visibility?>"
            >
              Edit
            </button>
            <button onClick="deleteNotice(<?=$i->noticeid?>)">Delete</button>
          </div>
      </div>
      
    <?php endforeach; ?>
			 
		 
	
  </main>

  <!-- edit notices modal -->
<div id="editModal" class="modal" style="display:none">
  <div class="modal-content">
    <span class="close-modal" onclick="closeModal('editModal')">&times;</span>
    <h2 class="modal-header">Edit Notice</h2>
    <form method="POST" action="<?=ROOT?>/ped_incharge/home/editnotice">
      <input type="hidden" name="noticeid" id="noticeid">

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
      </div>

      <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" id="content"></textarea>
      </div>

      <input type="hidden" name="publishdate" id="publishdate">
      <input type="hidden" name="publishtime" id="publishtime">

      <div class="form-group">
        <label for="visibility">Visibility</label>
        <select name="visibility" id="visibility">
          <option value="">-- Select Visibility --</option>
          <option value="students">All Students</option>
          <option value="captains">Only Sports Captains</option>
          <option value="amalgamated club">Only Amalgamated Club</option>
        </select>
      </div>

      <button type="submit" class="submit-btn">Update Notice</button>
    </form>
  </div>
</div>


	<footer class="footer">
    <div class="footer-container">
		<div class="footer-column">
    <img src="<?=ROOT?>/assets/images/ped_incharge/logo.png" alt="PEAK Logo">
    </div>
        <div class="footer-column">
            <h3>Contact Us</h3>
            <ul>
                <li><i class="uil uil-phone"></i> +94 987 657 976</li>
                <li><i class="uil uil-envelope"></i> support@peak.com</li>
                <li><i class="uil uil-map-marker"></i> University of Colombo</li>
            </ul>
        </div>
		<div class="footer-column">
            <h3>Privacy</h3>
            <ul>
                <li> Privcay Policy</li>
                <li>Terms & conditions</li>
            </ul>
        </div>

        <div class="footer-column">
            <h3>Follow Us</h3>
            <ul class="social-media">
                <li><a href="#"><i class="uil uil-facebook"></i></a></li>
                <li><a href="#"><i class="uil uil-twitter"></i></a></li>
				<li><a href="#"><i class="uil uil-instagram"></i></a></li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2024 University of Colombo.All Rights Reserved.</p>
    </div>
  </footer>
  

  <script src="<?=ROOT?>/assets/js/ped_incharge/home.js"></script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>

