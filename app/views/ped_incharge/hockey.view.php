<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hockey</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/hockey.css">
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <?php $current_page = 'sports'; include 'sidebar.view.php'?>
    <div class="main-content">
    <div class="navbar" style="border-radius:8px;">
            <a href="hockey">Home</a>
            <a href="hockeyattendance">Attendance</a>
            <a href="hockeyteam">Team</a>
            <a href="hockeycoaches">Coaches</a>
            <a href="hockeyschedule">Schedule</a>
            <a href="hockeysportrecords">Records</a>
        </div>
        
        <main>	
            <div class="content-container">
                <section class="main-content2">
                    <h1>Hockey</h1>
                    <div class="image-slider">
                        <div class="slides">
                            <img src="<?=ROOT?>/assets/images/ped_incharge/play1.jpg" alt="Hockey Action 1">
                            <img src="<?=ROOT?>/assets/images/ped_incharge/play2.jpg" alt="Hockey Action 2">
                            <img src="<?=ROOT?>/assets/images/ped_incharge/play3.jpg" alt="Hockey Team Celebration">
                        </div>
                        <!-- Navigation Arrows -->
                        <button class="prev">&#10094;</button>
                        <button class="next">&#10095;</button>
                    </div>
                    <h2>Team 2024</h2>
                    <article class="captains">
                        <div class="tile2">
                            <img src="<?=ROOT?>/assets/images/ped_incharge/mcaptain.jpg" alt="cap-men">
                            <div class="cap-name">
                            <p style="color:grey;">Captain</p>
                            <p>Dinith Dulanja</p>
</div>
                        </div>
                        <div class="tile2">
                            <img src="<?=ROOT?>/assets/images/ped_incharge/mvcaptain.jpg" alt="vc-men">
                            <div class="cap-name">
                            <p style="color:grey;">Vice Captain</p>
                            <p>Aamir Arshad</p>
                        </div>
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
    </div>

	<script src="<?=ROOT?>/assets/js/ped_incharge/hockey.js"></script>
</body>
</html>
