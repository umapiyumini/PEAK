<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Amalgamated Club</title>
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
    background-color:  #E6E6FA;
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
}


/* Footer Styling */










/*calendar style*/
.content{
    display: flex;
    justify-content: center;
    align-items: center;
	flex-direction: column;
    padding: 30px 30px;
	margin-left: 210px;
	background-color: #D8BFD8;
}
section.content {
  flex: 1; 
  padding-right: 30px;
	display: flex;
	flex-direction: column;
	align-content: center;
	justify-content: flex-start;
}

aside.calendar {
  flex: 0 0 300px; 
    max-width: 100%;
    gap: 20px;
 
}


.calendar {
  max-width: 100%;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  padding: 20px;
    
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
  margin-bottom: 20px;
}
.content img{
	width: 30%;
	height: 50%;
	margin-bottom: 30px;
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


/* full calendar styles */
.calendar-container {
    max-width: 100%;
    margin: 5rem;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border-radius: 8px;
    background-color: white;
}

.fullCalendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background-color: white;
    border-radius: 8px;

}

.month-year {
    font-size: 24px;
    font-weight: bold;
}

.calendar-controls {
    display: flex;
    gap: 10px;
}

.calendar-controls button {
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    background-color: #3E034A;
    color: white;
    cursor: pointer;
}

.calendar-controls button:hover {
    background: #59056a;
}

.calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    border: 1px solid white;
    border-radius: 8px;

}

.calendar-header-cell {
    padding: 10px;
    text-align: center;
    background: white;
    border-bottom: 1px solid #e0e0e0;
    font-weight: bold;
}

.calendar-cell {
    min-height: 120px;
    padding: 10px;
    border-right: 1px solid #e0e0e0;
    border-bottom: 1px solid #e0e0e0;
    position: relative;
}

.calendar-cell:last-child {
    border-right: none;
}

.date-number {
    position: absolute;
    top: 5px;
    right: 5px;
    color: #666;
}

.prev-month, .next-month {
    color: #ccc;
}

.events-list {
    margin-top: 25px;
    font-size: 12px;
}

.event {
    background: #3498db;
    color: white;
    padding: 2px 4px;
    border-radius: 3px;
    margin-bottom: 2px;
    cursor: pointer;
    font-size: 11px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
}

.modal-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    padding: 20px;
    border-radius: 8px;
    width: 90%;
    max-width: 400px;
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
    background: #59056a;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.submit-btn:hover {
    background: #3E034A;
}

.today {
    background: #d1d3d4c1;
}

.notice-container {
    display: flex; /* Use flexbox for layout */
    flex-direction: column; /* Allow wrapping for smaller screens */
    max-width: 100%; /* Add space between items */
    margin: 0 auto;
    gap: 20px;
    
}


.notice {
   width:100%;/* Each notice takes 50% width minus the gap */
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
  
</style>

</head>
<body>

<?php include 'nav.view.php';?>


	
 <main>
 
	 <section class="content">
		 <h1>Amalgamated Club</h1>
		 <h1>University Of Colombo</h1>
		 <img src="Amal.png" alt="uni logo">
		 <!--div class="year_plan"><a href="#">Year Plan</a></div-->
</setion>
		 
     <h1>Notices</h1>
     <div class="notice-container">
          <div class="notice">
            <h2>Interfaculty Freshers Tournament</h2>
            <p><strong>Date:</strong> January 15, 2025</p>
            <p><strong>Venue:</strong> Main Sports Ground , Indoor </p>
            <p><strong>Details:</strong> All faculties are invited to participate. Registration closes on December 31, 2024.</p>
          </div>
          <div class="notice">
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
        </div>
      
      </main>
      </body>
      </html>
	