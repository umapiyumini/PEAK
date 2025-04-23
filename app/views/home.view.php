<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/main.css">
</head>
<body>
<div id="preloader">
        <img src="<?=ROOT?>/assets/images/logo.png" alt="PEAK Logo" class="logoo">
    </div>
    <div  id="main-content" style="display: none;">
        <section class="header">
        <nav>
            <a href="index.view.html"><img src="<?=ROOT?>/assets/images/logo.png"></a>
            <div class="nav-links" id="navLinks">
                <span onclick="hidenav()" class="close-btn">&#215;</span> <!-- Move this line -->
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="<?=ROOT?>/signup">Signup</a></li>
                    <li><a href="<?=ROOT?>/login" class=button>Log In</a></li>
                    
            
                </ul>
               
            </div>
            <span onclick="shownav()" class="menu-btn">&#9776;</span>
        </nav>

        <div class="textbox">
            <h1>Welcome to PEAK</h1>
            <p>Your gateway to seamless interaction within the Physical Education 
                Department of the University of Colombo. Whether you're here to book 
                our state-of-the-art facilities or engage with our vibrant sports community, 
                we’ve got you covered.</p>
            <a href="<?=ROOT?>/login"" class="herobutton">Make a Reservation now!</a>
        </div>
        </section>
       


        <section class="offer">
        <h2>What We Offer</h2>
        <div class="row">
            
            <div class="col text-col">
                <h3> At Peak...</h3>
                <p> we offer top-notch sports facilities including a spacious ground, 
                    a modern indoor stadium, and well-maintained tennis courts. Our venues are 
                    perfect for training, competitions, and recreational activities, ensuring an 
                    optimal experience for all users.</p>
                   
            </div>
            <div class="col slider-col">
                <div class="slidercontainer">
                <div class="slider">
                    <img src="<?=ROOT?>/assets/images/basketball.jpg"  >
                    <img src="<?=ROOT?>/assets/images/ground.jpg">
                    <img src="<?=ROOT?>/assets/images/indoor.jpg">
                    <img src="<?=ROOT?>/assets/images/tennis.jpg">
                </div>
            </div>
        </div>   
        </section>


        <section class="facilities">
        <h2> Our Facilities</h2>
        <p>At Peak, we offer a range of exceptional sports facilities, each designed 
            for optimal performance and versatility. From spacious outdoor areas to 
            modern indoor arenas, our venues are carefully maintained and equipped to 
            meet the needs of athletes, providing a high-quality experience for both
             training and competitions.</p>

       <div class="row">
        <div class="f-col">
            <img class="facility" id="facility1" src="<?=ROOT?>/assets/images/ground.jpg">
            <h3> Multi-functional Ground</h3>
            <p>Our ground features a well-maintained, expansive area perfect
                for various sports and events. Equipped with quality turf and 
                state-of-the-art facilities, it provides an excellent environment 
                for athletes to train and compete.</p>
        </div>

        <div class="f-col">
            <img class="facility" id="facility2" src="<?=ROOT?>/assets/images/uma/hall.jpg">
            <h3> Top tier Strength hall</h3>
            <p> Our strength hall is a modern, fully-equipped facility designed for athletes and fitness enthusiasts of all levels. Featuring a wide range of high-quality equipment and ample space, it provides the perfect environment for strength training, conditioning, and personal development. Whether you're focused on building muscle, improving endurance, or enhancing overall fitness, our strength hall supports your goals in a safe and motivating setting. </p>
        </div>

        <div class="f-col">
            <img class="facility" id="facility3" src="<?=ROOT?>/assets/images/indoor.jpg">
            <h3> State-of-the-art Indoor stadium</h3>
            <p>Our indoor stadium is a versatile facility designed to host a wide range of 
                sports and events. With modern amenities, ample seating, and high-quality courts,
                 it ensures a top-notch experience for athletes and spectators alike.</p>
            </div>
       </div>

     
        </section>

        
        <section class="feedbacks">
    <h2>Community Highlights</h2>
    <p>See what others have to say about their experience with our facilities! Here's some feedback
        from past users who made reservations and enjoyed our top-quality venues.</p>

    <div class="row">
        <?php if(!empty($feedbacks)): ?>
            <?php foreach($feedbacks as $feedback): ?>
    <div class="feed-col facility">
        <?php
            // If image exists, use it; otherwise, use a default image
            $imgSrc = isset($feedback->user_image) && $feedback->user_image
                ? LINKROOT . "/uploads/profile_pictures/" . $feedback->user_image
                : LINKROOT . "/assets/images/default-user.jpg";
        ?>
        <img src="<?=$imgSrc?>" alt="User profile picture" style="width:70px;height:70px;border-radius:50%;">
        <div>
            <p><?=htmlspecialchars($feedback->content)?></p>
            <h3><?=htmlspecialchars($feedback->user_name)?></h3>
            <?php
                $rating = (int)$feedback->rating;
                for($i=0; $i<5; $i++){
                    echo $i < $rating ? '<span class="star">&#9733;</span>' : '<span class="star">&#9734;</span>';
                }
            ?>
        </div>
    </div>
<?php endforeach; ?>

        <?php else: ?>
            <p>No feedback yet!</p>
        <?php endif; ?>
    </div>
</section>


        <section class="footer">
        <h4>About Us</h4>
        <p>© 2024 Physical Education Department, University of Colombo. All rights reserved. 
            We are committed to fostering a vibrant community that promotes health, wellness, 
            and physical activity through a wide range of sports and recreational programs.
             Join us in our efforts to enhance your physical and mental well-being. <br>
             For any inquiries or further information, please contact us</p>
             <div class="icons">
                <img src="<?=ROOT?>/assets/images/Instagram-128.webp">
                <img src="<?=ROOT?>/assets/images/facebook.webp">
                <img src="<?=ROOT?>/assets/images/phone.webp">
                <img src="<?=ROOT?>/assets/images/thefreeforty_location-128.webp">
             </div>
        </section>
    </div>


    <!-- JavaScript for toggle menu -->
    <script src="<?=ROOT?>/assets/js/landing.js"></script>
       
    
</body>
</html>




