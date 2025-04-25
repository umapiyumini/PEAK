<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="home.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
  <style>
    @charset "utf-8";

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color:  #f1f1f1;
}

header {
    background-color:#3E034A;
    color: white;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
	position: fixed;
	top:0;
	left:0;
	width:100%;
	z-index: 1000;
}

.header-container {
    display: flex;
	height: 50px;
    width: 100%;
    justify-content: space-between;
    align-items: center;
	position: relative;
    gap:20px;
}

.logo img {
    max-height:70px;
	widows: auto;
}

nav ul {
    list-style: none;
    display: flex;
    gap: 30px;
	justify-content: flex-start;
	padding: 0;
	margin: 0;
}

nav{
	flex-grow: 1;
}

nav a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    padding: 5px 10px;
}

nav a.active {
  color:white;
  font-weight: bold;

}

.bell-icon, .profile-icon {
    cursor: pointer;
    justify-content: flex-end;

    
}

.bell-icon {
    background-color: transparent;
    border: none;
    font-size: 30px;
    color: #7f7f7f;
}
.bell-icon :hover{
    color: white;
}
.profile-icon img {
    height: 35px;
    border-radius: 50%;
    transition: border 0.3s ease;
}

.profile-icon img:hover {
    border: 2px solid #A87BBE;
}

.hamburger {
    display: none;
    font-size: 30px;
    background: none;
    border: none;
    color: black;
    cursor: pointer;
}

/* Dropdown Styling */
.dropdown-menu {
    position: absolute;
    top: 60px;
    right: 30px;
    background-color: white;
    border-radius: 8px;
    border: 1px solid black;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: none;
    width: 200px;
    z-index: 1001;
}

.dropdown-menu ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.dropdown-menu ul li {
    padding: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 16px;
}

.dropdown-menu ul li a {
    text-decoration: none;
    color: black;
}

.dropdown-menu ul li:hover {
    background-color: #F0F0F0;
}

.dropdown-menu.active {
    display: block;
}


/* body content styles */
main{
	display: flex;
  	justify-content: space-between;
  	margin: 0 30px;
}


/* Footer Styling */
.footer {
    background: #ecd8e9;
    color: #000000;
    padding: 30px 0px;
    text-align: center;
	
}

.footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    max-width:100%;
    margin: 0 auto;
}

.footer-column {
    flex: 1 1 200px;
    margin: 20px;
}

.footer-column h3 {
    font-size: 18px;
    margin-bottom: 20px;
    text-transform: uppercase;
}

.footer-column ul {
    list-style-type: none;
    padding: 0;
}

.footer-column ul li {
    margin-bottom: 10px;
}

.footer-column ul li a {
    color: #000000;
    text-decoration: none;
    font-size: 16px;
}

.footer-column ul li a:hover {
    text-decoration: underline;
}

.social-media li a {
    color: #000000;
}
.footer-column ul.social-media {
    display: flex;
    gap: 30px;
    justify-content: center;
    padding: 0;
}

.footer-column ul.social-media li {
    display: inline-block;
}
.footer-column ul.social-media li a i {
    font-size: 40px;
}



/* Footer Bottom */
.footer-bottom {
    border-top: 1px solid rgba(0,0,0,0.9);
    padding-top: 15px;
    margin-top: 20px;
}


/* Responsive Design */
@media (max-width: 768px) {
    .footer-container {
        flex-direction: column;
        align-items: center;
    }
    
    .footer-column {
        flex: 1 1 100%;
        text-align: center;
        margin: 20px 0;
    }
	.footer{
	background-position:center bottom; 
   
	}

}

    /*calendar style*/

    section.content {
        flex: 1; 
        border-radius: 10px;
        width: fit-content;
        padding: auto;
        display: flex;
        flex-direction: column;
        align-content: center;
        justify-content: flex-start;
        margin-left: 240px;

        
    }

    aside.calendar {
    flex: 0 0 300px; 
    
    }


    .calendar {
    width: 100%;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin: 20px;
    }

    .calendar-header {
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    }

    .nav_cal {
    color: rgba(62, 3, 74,0.9);
    cursor: pointer;
    font-size: 10px; 
    }
    .nav_cal i{
        font-size: 24px;
    }

    .days {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    text-align: center;
    font-weight: bold;
    padding-bottom: 10px;
    }

    .dates {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    text-align: center;
    }

    .date {
    padding: 10px;
    margin: 2px;
    cursor: pointer;
    }

    .date.active {
    background-color: rgba(62, 3, 74,0.7);
    color: white;
    border-radius: 50%;
    }

    .date:not(.active):hover {
    background-color: #e0e0e0;
    }

@media (max-width: 768px) {
  main {
    flex-direction: column;
  }

  aside.calendar {
    margin-left: 0;
    width: 100%; 
  }
}

.content h1 {
  text-align: center;
  width: 100%;  
  margin-top: 20px;
}
.content img{
    width: 100px;
	height: 150px;
	margin-bottom: 20px;
    margin-left:35%;
    margin-right: 25%;
    width: 30%;
       

}
.year_plan {
    background-color:white;
    padding: 20px;
    text-align: left;
	width: 100%;
    border-radius: 8px;
    transition: all 0.3s ease;
    border: 1px solid #000;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
}

.year_plan a {
    color: #333333;
    text-decoration: none;
    font-size: 20px;
    font-weight: bold;
}

.year_plan:hover {
    transform: translateY(-5px);
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
}

.styled-button {
      background-color:  #7a4bb8; /* Green */
      color: white; /* Text color */
      padding: 12px 20px; /* Spacing */
      border: none; /* No border */
      border-radius: 8px; /* Rounded corners */
      font-size: 16px; /* Font size */
      cursor: pointer; /* Pointer on hover */
      transition: background-color 0.3s ease, transform 0.2s ease; /* Smooth transition */
      margin: 10px;
      


    }

    .styled-button:hover {
      background-color: #7a4bb8; /* Slightly darker green */
      transform: scale(1.05); /* Slight zoom effect */
    }

    .styled-button:active {
      background-color: #7a4bb8; /* Even darker green */
      transform: scale(0.98); /* Slight press effect */
    }

    .styled-button a{
        text-decoration: none;  
    }

 .notice_board {
            width: 100%;
            margin-top:30px;
            background-color: white;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #000;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .notice_board h1 {
            text-align: left;
            margin: 10px;
            color: #333333;
        }
        .notice-form {
            margin-bottom: 20px;
        }
        .notice-form input, .notice-form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .notice-form button {
            background-color:rgba(62, 3, 74,0.9);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        .notice {
            border-bottom: 1px solid #eee;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
            max-width: 100%;
            
            
        }
        .notice h2 {
            margin-top: 0;
            margin-bottom: 10px;
        }
        .notice p {
            margin-top: 0;
            margin-bottom: 10px;
        }
        .notice-actions {
            text-align: right;
        }
        .notice-actions button {
            background: none;
            border: none;
            color: rgba(62, 3, 74,0.7);
            cursor: pointer;
            margin-left: 10px;
        }
        .notice-date {
            color: #666;
            font-size: 0.8em;
        }

        

.upcoming-events {
margin-top: 40px;
}
.upcoming-events h2{
	color: rgba(62, 3, 74,0.9);
}
.events-grid {
display: grid;
grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
grid-gap: 20px;
	margin-top: 25px;
}
.event-card {
background-color: #fff;
border-radius: 8px;
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
padding: 20px;
text-align: center;
text-decoration: none;
color: inherit;
transition: transform 0.3s, box-shadow 0.3s;
}
.event-card:hover {
transform: translateY(-5px);
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.event-card h3 {
margin-top: 0;
font-size: 1.2rem;
font-weight: 600;
}
.event-card p {
margin: 8px 0;
color: #666;
}
@media (max-width: 768px) {
.events-grid {
grid-template-columns: 1fr;
}
}



.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.close-modal {
    border: none;
    background: none;
    font-size: 20px;
    cursor: pointer;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
}

.form-group input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.submit-btn {
    width: 100%;
    padding: 10px;
    background: #5a2e8a;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.submit-btn:hover {
    background: #7a4bb8;
}

.today {
    background: #d1d3d4c1;
}

.notice-container {
    display: flex; /* Use flexbox for layout */
    flex-direction: column; /* Allow wrapping for smaller screens */
    max-width: 200%; /* Add space between items */
    gap: 20px;
    margin: 10px;
    text-align: center;
  
}


.notice {
    max-width:100%;/* Each notice takes 50% width minus the gap */
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: left;
    background-color: #fff;
    
}


  
  .notice h2 {
    margin: 0 0 10px 0;
    color: #000000;
    font-size:18px;
  }
  
  .notice p {
    font-size:14px;
    margin: 5px 0;
    color: #666;
  }

  .notice .view-btn {
  background-color: #7a4bb8; /* Green background */
  color: white; /* White text */
  font-size: 14px; /* Font size */
  font-weight: 600; /* Semi-bold text */
  padding: 8px 16px; /* Padding inside the button */
  border: none; /* Remove border */
  border-radius: 4px; /* Slightly rounded corners */
  cursor: pointer; /* Pointer cursor on hover */
  display: inline-block; /* Ensures proper button alignment */
  text-decoration: none; /* Remove underline if it's a link */
  box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2); /* Subtle shadow */
  transition: background-color 0.3s ease, transform 0.2s ease; /* Smooth transition */
  margin-top: 10px;
  
  
  
}

.notice .view-btn:hover {
  background-color: #7a4bb8; /* Change to purple on hover */
  transform: translateY(-2px); /* Slight lift on hover */
}

.notice .view-btn:active {
  background-color: #7a4bb8; /* Darker green for active state */
  transform: translateY(0); /* Reset lift on active state */
}


.notice .daten
{
    font-size:  10px;
    margin-bottom: 0;
}

.notice .contentn
{
    color: black;
    margin-top: 25px;
    margin-bottom: 20px;
}



 
  
  </style>


</head>
<body>
<?php 
include 'nav.view.php';
?>
	
 <main >
	 <section class="content">
		 <h1>Physical Education Administrative Kit</h1>
		 <h1>University Of Colombo</h1>
         <img src="<?=ROOT?>/assets/images/amar/A_logo.png" alt="Student Photo" id="studentPhoto">
  
		 <!--div class="year_plan"><a href="#">Year Plan</a></div-->
		 
     <h1>Notices</h1>
     <div >
     <button class="styled-button" type="submit" onclick='navigateToViewAddnotice();'>ADD NOTICES</button>
</div>
     <div class="notice-container">
    

          
            <?php if(!empty($noticeData)) : ?>
                <?php foreach($noticeData as $notice): ?>
                    <div class="notice">
                        
                        <h2><?= htmlspecialchars(is_array($notice) ? $notice['title'] : $notice->title) ?></h2>
                        
                        <p class="daten"><strong>Published Date:</strong><?= htmlspecialchars(is_array($notice) ? $notice['publishdate'] : $notice->publishdate) ?></p>
                        <p class="daten"><strong>Published Time:</strong><?= htmlspecialchars(is_array($notice) ? $notice['publishtime'] : $notice->publishtime) ?></p>
                
                        <p class="contentn"><strong></strong><?= htmlspecialchars(is_array($notice) ? $notice['content'] : $notice->content) ?></p>
                       
                        <button type='submit' class='view-btn' onclick="navigateToviewNotice('<?= is_array($notice) ? $notice['noticeid'] : $notice->noticeid ?>')">view</button>
                        <button type='submit' class='view-btn' onclick="navigateTodeleteNotice('<?= is_array($notice) ? $notice['noticeid'] : $notice->noticeid ?>')">Delete</button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
          <!-- <div class="notice">
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
        </div> -->
      
			 
		 
	 </section>
   




  </script>
	<script src="navbar.js"></script>
</body>
</html>