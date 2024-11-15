<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/main.css">
</head>
<body>
    
    <section class="header">
        <nav>
            <a href="index.view.html"><img src="<?=ROOT?>/assets/images/logo.png"></a>
            <div class="nav-links" id="navLinks">
                <span onclick="hidenav()" class="close-btn">&#215;</span> <!-- Move this line -->
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="<?=ROOT?>/login">Log In</a></li>
                    
            
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
            <img class="facility" id="facility2" src="<?=ROOT?>/assets/images/tennis.jpg">
            <h3> Top tier Tennis court</h3>
            <p>Our tennis courts offer a pristine playing surface for enthusiasts and professionals. 
                Well-maintained and equipped with the latest amenities, they provide an excellent 
                environment for both practice and competitive matches</p>
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
                <div class="feed-col facility" id="facility1">
                    <img src="<?=ROOT?>/assets/images/user1.jpg">
                    <div> 
                        <p>
                            "The facilities are top-notch! The Tennis court was well-maintained, 
                            and our team loved the atmosphere. We had an amazing time during our session"</p>
                           <h3>M H M Hamdi</h3> 
                           <span class="star"> &#9733;</span>
                           <span class="star"> &#9733;</span>
                           <span class="star"> &#9733;</span>
                           <span class="star"> &#9733;</span>
                           <span class="star"> &#9733;</span>
                       
                    </div>
                </div>

                <div class="feed-col facility" id="facility2">
                    <img src="<?=ROOT?>/assets/images/user2.jpg">
                    <div> 
                        <p>
                            "The ground  was ideal for our sports day event. It was spacious, clean, 
                            and the perfect setting for our activities. All our participants had a blast!"</p>
                           <h3>Amantha Sirikantha</h3> 

                           <span class="star"> &#9733;</span>
                           <span class="star"> &#9733;</span>
                           <span class="star"> &#9733;</span>
                           <span class="star"> &#9733;</span>
                           <span class="star"> &#9734;</span>
                       
                    </div>
                </div>
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



    <!-- JavaScript for toggle menu -->
    <script src="<?=ROOT?>/assets/js/landing.js"></script>
       
    
</body>
</html>




