<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hockey</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/sport.css">
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <div class="navbar">
    <a href="sportprofile">Home</a>
            <a href="sportattendance">Attendance</a>
            <a href="team">Team</a>
            <a href="coaches">Coaches</a>
            <a href="schedule">Schedule</a>
            <a href="sportrecords">Records</a>
    </div>
    
	<main>	
		<div class="content-container">
            <section class="main-content">
                <h1>Hockey</h1>
                <div class="image-slider">
                    <div class="slides">
                        
                            <img src="<?=ROOT?>/assets/images/vidusha/images1.jpeg" alt="Hockey Action 1">
                            <img src="<?=ROOT?>/assets/images/vidusha/images2.jpeg" alt="Hockey Action 2">
                            <img src="<?=ROOT?>/assets/images/vidusha/images3.jpg" alt="Hockey Team Celebration">
                        
                    </div>
                    <!-- Navigation Arrows -->
                    <button class="prev">&#10094;</button>
                    <button class="next">&#10095;</button>
                </div>
                <h2>Team 2024</h2>
				<article class="captains">
			        <div class="tile2">
				        <img src="wsdwd.png" alt="cap-men">
				        <p>Men's Captain</p>
			        </div>
			        <div class="tile2">
				        <img src="wsdwd.png" alt="vc-men">
					    <p>Men's Vice Captain</p>
			        </div>
			    </article>
            </section>
			

             <aside class="latest-news">
                <h2>Latest News</h2>
                <div id="newsContainer">

                    <!-- News Item 2 -->
                    <div class="news-item">
                        <h3>Inter-Faculty Tournament Winners</h3>
                        <p>The hockey team from the Faculty of Science emerged as champions in the inter-faculty hockey tournament. Their teamwork and dedication set a new benchmark for sportsmanship!</p>
                        <p class="news-date">Published: November 18, 2024</p>
                    </div>
            
                    <!-- News Item 3 -->
                    <div class="news-item">
                        <h3>Hockey Tournament 2024</h3>
                        <p>Congratulations to the Hockey team for an incredible performance! They clinched the title in this year’s Hockey Tournament, showcasing immense potential and talent.</p>
                        <p class="news-date">Published: November 15, 2024</p>
                    </div>
                </div>
            </aside>
        </div>
    </main>
	<script src="<?=ROOT?>/assets/js/vidusha/sportprofile.js"></script>
</body>
</html>
