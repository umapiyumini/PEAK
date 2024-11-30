<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Full Calendar</title>
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
	padding-top: 80px;
	display: flex;
  	justify-content: space-between;
  	margin: 0 30px;
}



/*calendar style*/
.content{
    display: flex;
    justify-content: center;
    align-items: center;
	flex-direction: column;
    padding: 30px 30px;
	margin: 20px;
	background-color: white;
}
section.content {
  flex: 1; 
  padding-right: 30px;
	display: flex;
	flex-direction: column;
	align-content: center;
	justify-content: flex-start;
}

aside.upcoming-events {
  flex: 0 0 300px; 
  margin:20px;
 
}


.calendar {
  width: 50%;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  padding: 20px;
  margin:30px 10px 10px 230px;
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
  margin-bottom: 20px;
}
.content img{
	width: 150px;
	height: 170px;
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

        .notice_board h1 {
            
            margin: 210px;
            color: #333333;
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
  </style>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    


</head>
<body>

 <main>

 <?php include 'nav.view.php';?>


 
	 
			 
    <section class="calendar">
      <div class="calendar-header">
        <span id="prev" class="nav_cal"><i class="uil uil-arrow-left"></i></span>
        <span id="month-year"></span>
        <span id="next" class="nav_cal"><i class="uil uil-arrow-right"></i></span>
      </div>

		
      <div class="calendar-body">
        <div class="days">
          <div>Mon</div>
          <div>Tue</div>
          <div>Wed</div>
          <div>Thu</div>
          <div>Fri</div>
          <div>Sat</div>
          <div>Sun</div>
        </div>
        <div class="dates" id="dates"></div>
      </div>
		<a href="home_calendar.php">View full calendar</a>
		</section>
	
    <aside class="upcoming-events">
      <h2>Upcoming Events</h2>
      <div class="events-grid">
        <a href="#" class="event-card">
          <h3>Annual meeting</h3>
          <p>Date: 15th April 2024</p>
          <p>Time: 9:00 AM - 11:00 AM</p>
          <p>Venue: PED</p>
        </a>
        <a href="#" class="event-card">
          <h3>Fitness Challenge</h3>
          <p>Date: 1st June 2024</p>
          <p>Time: 4:00 PM - 7:00 PM</p>
          <p>Venue: University Gymnasium</p>
        </a>
      </div>
    
    </aside>
  </main>
	

  <script>
    const monthYear = document.getElementById('month-year');
const datesElement = document.getElementById('dates');
const prev = document.getElementById('prev');
const next = document.getElementById('next');

const months = [
  'January', 'February', 'March', 'April', 'May', 'June', 'July', 
  'August', 'September', 'October', 'November', 'December'
];

let currentDate = new Date();

// Function to update previous and next month labels dynamically
function updateMonthLabels() {
  const currentMonth = currentDate.getMonth();
  
  // Calculate previous and next month indexes
  const prevMonthIndex = (currentMonth - 1 + 12) % 12;
  const nextMonthIndex = (currentMonth + 1) % 12;

  // Update the text for previous and next months with arrow icons and no year
   prev.innerHTML = `<i class="uil uil-arrow-left"></i> ${months[prevMonthIndex]}`;
  next.innerHTML = `${months[nextMonthIndex]} <i class="uil uil-arrow-right"></i>`;
}

// Function to render the calendar
function renderCalendar() {
  // Get year, month, and first day of the month
  const year = currentDate.getFullYear();
  const month = currentDate.getMonth();
  const firstDay = new Date(year, month, 1).getDay() - 1;  // Adjust for Monday start

  // Update the header for the current month and year
  monthYear.textContent = `${months[month]} ${year}`;

  // Clear any existing dates
  datesElement.innerHTML = '';

  // Get number of days in the current month
  const daysInMonth = new Date(year, month + 1, 0).getDate();

  // Fill in previous month's blank spaces
  for (let i = 0; i < (firstDay < 0 ? 6 : firstDay); i++) {
    datesElement.innerHTML += `<div class="date"></div>`;
  }

  // Fill in dates of the current month
  for (let i = 1; i <= daysInMonth; i++) {
    const dateClass = i === currentDate.getDate() && 
                      month === new Date().getMonth() && 
                      year === new Date().getFullYear() ? 'active' : '';
    datesElement.innerHTML += `<div class="date ${dateClass}">${i}</div>`;
  }

  // Update the previous and next month labels
  updateMonthLabels();
}

// Event listeners for previous and next month navigation
prev.addEventListener('click', () => {
  currentDate.setMonth(currentDate.getMonth() - 1);
  renderCalendar();
});

next.addEventListener('click', () => {
  currentDate.setMonth(currentDate.getMonth() + 1);
  renderCalendar();
});

// Initialize the calendar on page load
renderCalendar();

//notice board
 let notices = [];
        let editingIndex = null;

        function addOrUpdateNotice() {
            const title = document.getElementById('noticeTitle').value;
            const content = document.getElementById('noticeContent').value;
            if (title && content) {
                const notice = {
                    title,
                    content,
                    date: new Date().toLocaleString()
                };
                if (editingIndex !== null) {
                    notices[editingIndex] = notice;
                    editingIndex = null;
                } else {
                    notices.push(notice);
                }
                document.getElementById('noticeTitle').value = '';
                document.getElementById('noticeContent').value = '';
                document.querySelector('.notice-form button').textContent = 'Add Notice';
                renderNotices();
            }
        }

        function deleteNotice(index) {
            notices.splice(index, 1);
            renderNotices();
        }

        function editNotice(index) {
            const notice = notices[index];
            document.getElementById('noticeTitle').value = notice.title;
            document.getElementById('noticeContent').value = notice.content;
            document.querySelector('.notice-form button').textContent = 'Update Notice';
            editingIndex = index;
        }

        function renderNotices() {
            const container = document.getElementById('noticesContainer');
            container.innerHTML = '';
            notices.forEach((notice, index) => {
                const noticeElement = document.createElement('div');
                noticeElement.className = 'notice';
                noticeElement.innerHTML = `
                    <h2>${notice.title}</h2>
                    <p>${notice.content}</p>
                    <p class="notice-date">Posted on: ${notice.date}</p>
                    <div class="notice-actions">
                        <button onclick="editNotice(${index})">Edit</button>
                        <button onclick="deleteNotice(${index})">Delete</button>
                    </div>
                `;
                container.appendChild(noticeElement);
            });
        }

        renderNotices();






  </script>
</body>
</html>

