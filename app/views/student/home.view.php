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
   
  </main>
	
  <script src="home.js"></script>
	<script src="navbar.js"></script>
</body>
</html>

