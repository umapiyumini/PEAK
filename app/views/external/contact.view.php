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
                        <div class="map"> <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.925484609458!2d79.8577050799264!3d6.899515375307876!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2594b270676fb%3A0xd825b0c233a3f0c!2sDepartment%20of%20Physical%20Education%2C%20University%20of%20Colombo!5e0!3m2!1sen!2slk!4v1732535302717!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" 
                            width="600" 
                            height="450" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy"></iframe></div>
                        </div>
                   
                        <div class="contactform">
                            
                            <form action="<?= ROOT ?>/external/contact/sendMessage" method="POST">
                              <h2>Send a Message</h2>
                                <div class="inputbox">
                                <input type="hidden" name="userid" value="123"> 
                                </div>

                                <div class="inputbox">
                                    <textarea name="content" required="required"></textarea>
                                    <span>Type Your Message</span>
                                </div>

                                <div class="inputbox">
                                    <input type="submit" value="send">
                                </div>
                            </form>



                        </div>
</div>

               
                <!-- Feedback Popup -->
                <div id="feedbackModal" class="fwrapper" style="display: none;">
                    <h3>Leave us your feedback here! Thank you for your time</h3>
                    <form id="feedbackForm" action="<?= ROOT ?>/external/contact/sendFeedback" method="POST"> <!-- Ensure the form has an ID -->
                        <div class="rating">
                            <input type="number" name="rating" hidden id="rating">
                            <span class="star" data-value="1">&#9734;</span>
                            <span class="star" data-value="2">&#9734;</span>
                            <span class="star" data-value="3">&#9734;</span>
                            <span class="star" data-value="4">&#9734;</span>
                            <span class="star" data-value="5">&#9734;</span>
                        </div>
                        <textarea name="content" cols="30" rows="5" placeholder="Your Comment..."></textarea>
                        <div class="btn-group">
                            <button type="submit" class="fbtn submit">Submit</button>
                            <button type="button" class="fbtn cancel" id="closeFeedbackModal">Cancel</button>
                        </div>
                    </form>


       <!-- thankyou modal-->
                    <div id="feedbackThankYou" style="display:none; text-align:center; margin-top:20px;">
                        <h3>Thank you for your feedback!</h3>
                    </div>

</div>

                                
                    
                </div>
                </section>   


        </div>

        <!-- Add this right before the closing </body> tag in your contact.view.php file -->
<div id="messageModal" class="popup" style="display:none;">
    <div class="popup-content">
        <span class="close-icon" onclick="closeMessageModal()">&times;</span>
        <h3>Message Sent</h3>
        <p>Thank you for your message. We will get back to you as soon as possible.</p>
        <div class="popup-buttons">
            <button type="button" class="confirm-btn" onclick="closeMessageModal()">OK</button>
        </div>
    </div>
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
const feedbackForm = document.getElementById('feedbackForm'); // Get the form element

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


feedbackForm.addEventListener('submit', function(e) {
    e.preventDefault();

    // Check if rating is provided before submitting
    if (!ratingInput.value) {
        alert('Please select a rating.');
        return;
    }

    // Prepare form data
    const formData = new FormData(feedbackForm);

    // Send AJAX request
    fetch(feedbackForm.action, {
        method: 'POST',
        body: formData,
        credentials: 'same-origin'
    })
    .then(response => response.text())
    .then(data => {
        // Hide the form
        feedbackForm.style.display = 'none';
        // Show thank you message
        document.getElementById('feedbackThankYou').style.display = 'block';

        // Optionally, close the modal after a delay
        setTimeout(() => {
            feedbackModal.style.display = 'none';
            document.body.style.overflow = '';
            // Reset form for next use
            feedbackForm.reset();
            feedbackForm.style.display = 'block';
            document.getElementById('feedbackThankYou').style.display = 'none';
            // Reset stars color
            document.querySelectorAll('.star').forEach(s => s.style.color = 'gray');
        }, 2000);
    })
    .catch(error => {
        alert('Error submitting feedback. Please try again.');
        console.error(error);
    });
});

// Set rating when star is clicked
document.querySelectorAll('.star').forEach(star => {
    star.addEventListener('click', function() {
        let rating = this.getAttribute('data-value');
        ratingInput.value = rating; // Set the rating value to the hidden input
        document.querySelectorAll('.star').forEach(s => {
            s.style.color = s.getAttribute('data-value') <= rating ? 'gold' : 'gray';
        });
    });
});

// Check for success message in session and show popup
document.addEventListener('DOMContentLoaded', function() {
    <?php if(isset($_SESSION['success_message'])): ?>
        showMessageModal();
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>
});

function showMessageModal() {
    document.getElementById('messageModal').style.display = 'flex';
    setTimeout(() => {
        document.querySelector('#messageModal .popup-content').classList.add('active');
    }, 10);
}

function closeMessageModal() {
    document.querySelector('#messageModal .popup-content').classList.remove('active');
    setTimeout(() => {
        document.getElementById('messageModal').style.display = 'none';
    }, 300);
}

    </script>
</html>