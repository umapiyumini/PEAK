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
            <?php if (!empty($sport) && !empty($sport->sport_name)) { ?>
            <h1><?php echo htmlspecialchars($sport->sport_name); ?></h1>
            <?php } else { ?>
                <h1>Sport Not Found</h1>
            <?php } ?>
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
                        
				        <img src="<?=ROOT?>/assets/images/vidusha/mcaptain.jpeg" alt="cap-men">
				        <p>Men's Captain</p>
			        </div>
			        <div class="tile2">
				        <img src="<?=ROOT?>/assets/images/vidusha/mvcaptain.jpeg" alt="vc-men">
					    <p>Men's Vice Captain</p>
			        </div>
			    </article>
            </section>
			

             <aside class="latest-news">
                <h2>Latest News</h2>
                <div id="newsContainer">

                    <!-- News Item 2 -->
                    <div class="news-item">
                    <?php if (!empty($news)) { ?>
                        <?php foreach ($news as $news){?>
                        
                    <h1><?php echo htmlspecialchars($news->topic); ?></h1>
                    <p><?php echo htmlspecialchars($news->content); ?></p>
                    <p>Published: <?php echo htmlspecialchars($news->published_date); ?></p>
                    <?php } ?>
                    <?php } else { ?>
                        <h1>Sport News Not Found</h1>
                    <?php } ?>
                    </div>
            
                    
                </div>
            </aside>
        </div>
    </main>
	<script src="<?=ROOT?>/assets/js/vidusha/sportprofile.js"></script>
</body>
</html>
