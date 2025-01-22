<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>External customers</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/external_customers.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <?php $current_page = 'externalcustomers'; include 'sidebar.view.php'?>
    <div class="main-content">
        <div class="header">
            
            <h1>Customer Data</h1>  
            <button class="bell-icon"><i class="uil uil-bell"></i></button>
            <!-- <div class="notifications-dropdown">
                <div class="notifications-header">
                    <h3>Notifications</h3>
                    <span class="clear-all">Clear All</span>
                </div>
                <div class="notifications-list">
                    <ul id="notificationsList"></ul>
                </div>
              </div> -->
            <button class="bell-icon"><i class="uil uil-signout"></i></button>
        </div>
        <main>
            <div class="controls">
                <div class="search-bar">
                    <input type="text" id="searchInput" placeholder="Search customers...">
                    <i class="uil uil-search"></i>
                </div>
            </div>
            <div>
                <div class="customer-table">
                    <table id="customerTable">
                        <thead>
                            <tr>
                                <th>Customer ID</th>
                                <th>Name</th>
                                <th>Company</th>
                                <th>NIC</th>
                                <th>Email</th>
                                <th>Contact number</th>
                                <th>Address</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <section class="feedbacks">
                <h2>Customer Feedbacks</h2>
            
                <div class="row">
                    <div class="feed-col facility" id="facility1">
                        <img src="<?=ROOT?>/assets/images/ped_incharge/user1.jpg">
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
                            <div class="feedback-date">12.07.2024</div>
                        </div>
                    </div>

                    <div class="feed-col facility" id="facility2">
                        <img src="<?=ROOT?>/assets/images/ped_incharge/user2.jpg">
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
                        <div class="feedback-date">12.08.2024</div>
                        </div>
                    </div>

                    <div class="feed-col facility" id="facility2">
                        <img src="<?=ROOT?>/assets/images/ped_incharge/user2.jpg">
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
                        <div class="feedback-date">12.08.2024</div>
                        </div>
                    </div>

                    <div class="feed-col facility" id="facility2">
                        <img src="#">
                        <div> 
                            <p>
                                "The ground  was ideal for our sports day event. It was spacious, clean, 
                                and the perfect setting for our activities. All our participants had a blast!"</p>
                            <h3>Emma</h3> 

                            <span class="star"> &#9733;</span>
                            <span class="star"> &#9733;</span>
                            <span class="star"> &#9733;</span>
                            <span class="star"> &#9733;</span>
                            <span class="star"> &#9734;</span>
                        <div class="feedback-date">12.08.2024</div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
           

    
	<script src="<?=ROOT?>/assets/js/ped_incharge/external_customers.js"></script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>

