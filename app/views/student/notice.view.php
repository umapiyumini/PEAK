<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Full Calendar</title>
  <link rel="stylesheet" href="home.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/amar/amalgamated/home.css">

   


</head>
<body>
<?php
include 'nav.view.php';?>
 <main>
	 <section class="content">
		 <h1>Physical Education Administrative Kit</h1>
		 <h1>University Of Colombo</h1>
         <img src="<?=ROOT?>/assets/images/amar/Amal_Logo.png" alt="Amalgamated Club">


		 <!--div class="year_plan"><a href="#">Year Plan</a></div-->
		 
     <h1>Notices</h1>
     <div class="notice-container">
          <div class="notice">
            <h2>Annual Sports Meet</h2>
            <p><strong>Date:</strong> March 10, 2024</p>
            <p><strong>Venue:</strong> Main Sports Ground</p>
            <p><strong>Details:</strong> All departments are invited to participate. Registration closes on March 5, 2024.</p>
          </div>
          <div class="notice">
            <h2>Gym Membership Renewal</h2>
            <p><strong>Deadline:</strong> February 25, 2024</p>
            <p><strong>Details:</strong> Renew your gym membership online or visit the office between 9 AM and 4 PM.</p>
          </div>
          <div class="notice">
            <h2>Inter-Department Cricket League</h2>
            <p><strong>Start Date:</strong> April 1, 2024</p>
            <p><strong>Venue:</strong> University Cricket Ground</p>
            <p><strong>Details:</strong> Teams must submit their final player list by March 20, 2024.</p>
          </div>
          <div class="notice">
            <h2>Colors Night 2024</h2>
            <p><strong>Date:</strong> May 15, 2024</p>
            <p><strong>Venue:</strong> University Auditorium</p>
            <p><strong>Details:</strong> Celebrate the achievements of our athletes. Tickets are available now!</p>
          </div>
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
		<a href="home_calendar.php">View full calendar</a>
		<a href=" ../Gym/calendar.html">View Gym Calendar</a>
	
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
	

  <script src="<?=ROOT?>/assets/js/amar/home.js"></script>
  <script src="<?=ROOT?>/assets/js/amar/nav.js"></script>
</body>
</html>

