<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/sportcaptainhome.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">


</head>
<body>
	<header>
        <div class="header-container">
            <div class="logo">
                <img src="<?=ROOT?>/assets/images/vidusha/logo.png" alt="PEAK Logo">
            </div>
			<button class="hamburger" onclick="toggleMenu()">&#9776;</button>
            <nav>
                <ul>
                    <li><a href="#" class="active">Home</a></li>
                    <li><a href="sportscaptaindashboard">Dashboard</a></li>
                    <li><a href="#" >About</a></li>
                </ul>
            </nav>
			<button class="bell-icon" >
        <a href="notification">
                <i class="uil uil-bell" ></i></a>
            </button>
            <div class="profile-icon" id="profileIcon">
              <img src="<?=ROOT?>/assets/images/vidusha/pro_icon.png" alt="Profile Icon">
              <div class="dropdown-menu" id="dropdownMenu">
                  <ul>
                      <li><a href="#"><i class="uil uil-user"></i> My Profile</a></li>
                      <li><a href="#"><i class="uil uil-signout"></i> Log out</a></li>
                  </ul>
              </div>
          </div>  
        </div>
    </header>

 <main>
	 <section class="content">
		 <h1>Physical Education Administrative Kit</h1>
		 <h1>University Of Colombo</h1>
		 <img src="<?=ROOT?>/assets/images/vidusha/ped_logo.jpg" alt="uni logo">
		 
     <h1>Notices</h1>
     <div class="notice-container">
     <?php if (!empty($data['notices'])): ?>
      <?php foreach($data['notices'] as $notice): ?> 
          <div class="notice">
            <h2><?= $notice->title?></h2>
            <p><strong><?= $notice->content?></p>
      </div>
            <?php endforeach; ?>
            <?php else: ?>
              <p>No notices available.</p>
            <?php endif; ?>
          

        </div>
      
			 
		 
	 </section>
    <aside class="calendar">
      <div class="calendar-header">
        <span id="prev" class="nav_cal"><i class="uil uil-arrow-left"></i></span>
        <span id="month-year"></span>
        <span id="next" class="nav_cal"><i class="uil uil-arrow-right"></i></span>
      </div>

		
      <div class="calendar-body">
        <div class="days">
          <div>Mon</div>
          <div>Tue</div>
          <div>Wed</div>
          <div>Thu</div>
          <div>Fri</div>
          <div>Sat</div>
          <div>Sun</div>
        </div>
        <div class="dates" id="dates"></div>
      </div>
		
	
    <div class="upcoming-events">
      <h2>Upcoming Events</h2>
      <div class="events-grid">
        <a href="#" class="event-card">
          <h3>Fitness Challenge</h3>
          <p>Date: 1st June 2024</p>
          <p>Time: 4:00 PM - 7:00 PM</p>
          <p>Venue: University Gymnasium</p>
        </a>
        <a href="event-schedule.html" class="event-card">
          <h3>Inter faculty hockey</h3>
          <p>Date: 10th July 2024</p>
          <p>Time: 9:30 AM - 12:30 PM</p>
          <p>Venue: UOC ground</p>
        </a>
        <a href="#" class="event-card">
          <h3>Leadership program</h3>
          <p>Date: 20th August 2024</p>
          <p>Time: 1:00 PM - 5:00 PM</p>
          <p>Venue: UOC ground</p>
        </a>
      </div>
    </div>
    </aside>
  </main>
	<footer class="footer">
    <div class="footer-container">
		<div class="footer-column">
    <img src="<?=ROOT?>/assets/images/vidusha/pedlogo.png" alt="PEAK Logo">
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
  

  <script src="<?=ROOT?>/assets/js/vidusha/sportcaptainhome.js"></script>
	
</body>
</html>

