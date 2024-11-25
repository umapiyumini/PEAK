<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-1.0">
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/contact.css">
        <title>External User Dashboard</title>
    </head>


    <body>
        <!-- navigation bar -->
        <?php include 'enav.view.php'; ?>
        <div class="main">
        <?php include 'top.view.php'; ?>

        <section class="contact">
                <div class="content"> 
                    <h2> Get in touch with us for any inquiries or leave your <a href=""><span id="feedbackBtn">feedback</span><a><br>we’d love to hear from you!
                    </h2>
                </div>
                <div class="contain">
                    <div class="contactinfo">
                    
                            <div class="box">
                            <div class="icon"><img src="<?=ROOT?>/assets/images/phone.webp"></div>
                            <div class="text">
                                <h3>Phone Number</h3>
                                <p>+94 112 502 405</p>
                                
                            </div>
                        </div>
                        <div class="box">
                            <div class="icon"><img src="<?=ROOT?>/assets/images/email.png"></div>
                            <div class="text">
                                <h3>Email</h3>
                                <p>info@ped.cmb.ac.lk</p>
                                
                            </div>
                        </div>
                        <div class="box">
                            <div class="icon"><img src="<?=ROOT?>/assets/images/thefreeforty_location-128.webp"></div>
                            <div class="text">
                                <h3>Adress</h3>
                                    <p> Department of Physical Education,<br>University of Colombo,<br> 94, Cumaratunga Munidasa Mw,<br>Colombo 03,<br> Sri Lanka</p>
                                   



                            </div>
                        </div>
                        <div class="map"> <img src="<?=ROOT?>/assets/images/map.png"></div>
                    </div>
                
                    
                        <div class="contactform">
                            <form>
                                <h2> Send Message</h2>
                                <div class="inputbox">
                                    <input type="text" name="" required="required">
                                    <span>Full name</span>
                                </div>
                
                                <div class="inputbox">
                                    <input type="text" name="" required="required">
                                    <span>Email</span>
                                </div>
                
                                <div class="inputbox">
                                    <textarea required="required"></textarea>
                                    <span>Type Your Message</span>
                                </div>
                
                                <div class="inputbox">
                                    <input type="submit" name="" value="send">
                                </div>
                            </form>
                
                        </div>
                
                
                    <!-- Feedback Popup -->
            <div id="feedbackModal" class="fwrapper" style="display: none;">
                <h3>Leave us your feedback here! Thank you for your time</h3>
                <form action="#">
                    <div class="rating">
                        <input type="number" name="rating" hidden> <!-- Hidden rating field -->
                        <span class="star">&#9734;</span> 
                        <span class="star">&#9734;</span> 
                        <span class="star">&#9734;</span> 
                        <span class="star">&#9734;</span> 
                        <span class="star">&#9734;</span> 
                    </div>
                    <textarea name="opinion" cols="30" rows="5" placeholder="Your Comment..."></textarea>
                    <div class="btn-group">
                        <button type="submit" class="fbtn submit">Submit</button>
                        <button type="button" class="fbtn cancel" id="closeFeedbackModal">Cancel</button>
                    </div>
                </form>
            </div>

                                
                    
                </div>
                </section>   


        </div>
      
    </body>
    <script>
    // JavaScript to handle feedback form popup and rating functionality
const feedbackBtn = document.getElementById('feedbackBtn');
const feedbackModal = document.getElementById('feedbackModal');
const closeFeedbackModal = document.getElementById('closeFeedbackModal');
const submitBtn = document.querySelector('.fbtn.submit'); // Select the submit button

const allStar = document.querySelectorAll('.rating .star');
const ratingInput = document.querySelector('input[name="rating"]'); // Hidden input for rating

// Open the feedback modal when clicking the feedback button
feedbackBtn.addEventListener('click', function(e) {
    e.preventDefault();
    feedbackModal.style.display = 'flex'; // Show the modal
    document.body.style.overflow = 'hidden'; // Disable scrolling on the page
});

// Close the feedback modal when clicking the cancel button
closeFeedbackModal.addEventListener('click', function() {
    feedbackModal.style.display = 'none'; // Hide the modal
    document.body.style.overflow = ''; // Enable scrolling back on the page
});

// Close the feedback modal when clicking the submit button
submitBtn.addEventListener('click', function(e) {
    e.preventDefault(); // Prevent form submission (so the page doesn't reload)
    feedbackModal.style.display = 'none'; // Hide the modal
    document.body.style.overflow = ''; // Enable scrolling back on the page
    // You can add form submission logic here, if needed.
});

// Handle star rating
allStar.forEach((item, idx) => {
    item.addEventListener('click', function() {
        // Update the stars
        allStar.forEach((star, i) => {
            if (i <= idx) {
                star.innerHTML = '&#9733;'; // Filled star
            } else {
                star.innerHTML = '&#9734;'; // Empty star
            }
        });

        // Set the rating value in the hidden input
        ratingInput.value = idx + 1; // Rating is 1-indexed (1 to 5)
    });
});




    </script>
</html>