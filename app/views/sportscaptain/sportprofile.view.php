<?php include_once('../app/views/includes/message.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hockey</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/sport.css">
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
    <?php include_once(__DIR__ . '/../includes/message.php'); ?>
	<main>	
		<div class="content-container">
        

            <section class="main-content">
            <?php if (!empty($sport) && !empty($sport->sport_name)) { ?>
            <h1><?php echo htmlspecialchars($sport->sport_name); ?></h1>
            <?php } else { ?>
                <h1>Sport Not Found</h1>
            <?php } ?>
            <img src="<?=ROOT?>/assets/images/vidusha/images1.jpeg" alt="Hockey Action 1">
                        
                   
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
                    <div class="add-news">
                        <h2>Add News</h2>
                        <form action="<?=ROOT?>/sportscaptain/sportprofile/addnews" method="POST">
                        <input type="text" name="topic" placeholder="Topic" required>
                        <textarea name="content" placeholder="Content" required></textarea>
                        <input type="hidden" name="published_date" value="<?= date('Y-m-d') ?>">
                        <input type="hidden" name="sport_id" value="<?= $sport->sport_id ?>">
                        <button type="submit">Add News</button>
                        </form>   
                </div>
            </aside>
        </div>
    </main>
	<script src="<?=ROOT?>/assets/js/vidusha/sportprofile.js"></script>
</body>
</html>
