<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/home.css">
	
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">


</head>
<body>
	<header>
        <div class="header-container">
            <div class="logo">
                <img src="<?=ROOT?>/assets/images/ped_incharge/logo.png" alt="PEAK Logo">
            </div>
			<button class="hamburger" onclick="toggleMenu()">&#9776;</button>
            <nav>
                <ul>
                    <li><a href="#" class="active">Home</a></li>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#" >About</a></li>
                </ul>
            </nav>
			<button class="bell-icon">
                <i class="uil uil-bell"></i>
            </button>
            <div class="profile-icon">
                <img src="<?=ROOT?>/assets/images/ped_incharge/pro_icon.png" alt="Profile Icon">
            </div>
        </div>
		
		<div class="dropdown-menu" id="dropdownMenu">
            <ul>
                <li><a href="#"><i class="uil uil-user"></i> My Profile</a></li>
                <li><a href="#"><i class="uil uil-signout"></i> Log out</a></li>
            </ul>
		</div>
    </header>


 <div class="calendar-container">
        <div class="fullCalendar-header">
            <div class="month-year" id="monthYear"></div>
            <div class="calendar-controls">
                <button id="prevMonth">&lt;</button>
                <button id="today">Today</button>
                <button id="nextMonth">&gt;</button>
            </div>
        </div>
        <div class="calendar-grid" id="calendar"></div>
    </div>

    <div class="modal" id="eventModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add Event</h2>
                <button class="close-modal">&times;</button>
            </div>
            <form id="eventForm" method="POST" action="<?=ROOT?>/ped_incharge/home_calendar/addEvent">
                <div class="form-group">
                    <label for="eventTitle">Event Title</label>
                    <input type="text" id="eventTitle" name="title" required>
                </div>
                <div class="form-group">
                    <label for="eventTime">Time</label>
                    <input type="time" id="eventTime" name="time" required>
                </div>
                <div class="form-group">
                    <label for="eventVenue">Venue</label>
                    <input type="text" id="eventVenue" name="venue">
                </div>
                <input type="hidden" id="eventDate" name="eventDate">
                <button type="submit" class="submit-btn">Save</button>
                <button type="button" id="deleteEventBtn" class="delete-btn">Delete</button>
            </form>
        </div>
    </div>



	<footer class="footer">
    <div class="footer-container">
		<div class="footer-column">
    <img src="<?=ROOT?>/assets/images/ped_incharge/logo.png" alt="PEAK Logo">
    </div>
        <div class="footer-column">
            <h3>Contact Us</h3>
            <ul>
                <li><i class="uil uil-phone"></i> +94 987 657 976</li>
                <li><i class="uil uil-envelope"></i> support@peak.com</li>
                <li><i class="uil uil-map-marker"></i> University of Colombo</li>
            </ul>
        </div>
		<div class="footer-column">
            <h3>Privacy</h3>
            <ul>
                <li> Privcay Policy</li>
                <li>Terms & conditions</li>
            </ul>
        </div>

        <div class="footer-column">
            <h3>Follow Us</h3>
            <ul class="social-media">
                <li><a href="#"><i class="uil uil-facebook"></i></a></li>
                <li><a href="#"><i class="uil uil-twitter"></i></a></li>
				<li><a href="#"><i class="uil uil-instagram"></i></a></li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2024 University of Colombo.All Rights Reserved.</p>
    </div>
  </footer>
  

  <script>
 
     const serverEvents = <?= json_encode($events) ?>;


     class Calendar {
                constructor() {
                this.today = new Date();
                this.currentDate = new Date();
                this.events = this.loadEventsFromServer();
                this.selectedDate = null;

                this.initializeCalendar();
                this.setupEventListeners();
            }

            
                loadEventsFromServer() {
                    const eventMap = {};

                    serverEvents.forEach(event => {
                        const date = event.date;
                        if (!eventMap[date]) {
                            eventMap[date] = [];
                        }
                        eventMap[date].push({
                            title: event.title,
                            time: event.time,
                            venue: event.venue
                        });
                    });

                    return eventMap;
                }

            initializeCalendar() {
                const calendar = document.getElementById('calendar');
                const monthYear = document.getElementById('monthYear');
                
                // Add day headers
                const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                days.forEach(day => {
                    const headerCell = document.createElement('div');
                    headerCell.className = 'calendar-header-cell';
                    headerCell.textContent = day;
                    calendar.appendChild(headerCell);
                });

                this.renderCalendar();
            }

            renderCalendar() {
                const calendar = document.getElementById('calendar');
                const monthYear = document.getElementById('monthYear');
                
                // Clear existing dates
                while (calendar.children.length > 7) {
                    calendar.removeChild(calendar.lastChild);
                }

                // Update month and year display
                const months = ['January', 'February', 'March', 'April', 'May', 'June', 
                              'July', 'August', 'September', 'October', 'November', 'December'];
                monthYear.textContent = `${months[this.currentDate.getMonth()]} ${this.currentDate.getFullYear()}`;

                // Get first day of month and total days
                const firstDay = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth(), 1);
                const lastDay = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1, 0);
                
                // Get previous month's days to display
                const prevMonthLastDay = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth(), 0);
                let prevMonthDays = prevMonthLastDay.getDate() - firstDay.getDay() + 1;

                // Previous month's days
                for (let i = 0; i < firstDay.getDay(); i++) {
                    this.createDateCell(prevMonthDays, true);
                    prevMonthDays++;
                }

                // Current month's days
                for (let day = 1; day <= lastDay.getDate(); day++) {
                    this.createDateCell(day, false);
                }

                // Next month's days
                let nextMonthDays = 1;
                const remainingCells = 42 - (firstDay.getDay() + lastDay.getDate());
                for (let i = 0; i < remainingCells; i++) {
                    this.createDateCell(nextMonthDays, true);
                    nextMonthDays++;
                }

                
            }

            createDateCell(day, isOtherMonth) {
                const calendar = document.getElementById('calendar');
                const cell = document.createElement('div');
                cell.className = 'calendar-cell';
                
                if (isOtherMonth) {
                    cell.classList.add('other-month');
                }

                const dateNumber = document.createElement('div');
                dateNumber.className = 'date-number';
                dateNumber.textContent = day;
                cell.appendChild(dateNumber);

                const eventsList = document.createElement('div');
                eventsList.className = 'events-list';
                cell.appendChild(eventsList);

                // Check if it's today
                const cellDate = new Date(this.currentDate.getFullYear(), 
                                       this.currentDate.getMonth() + (isOtherMonth ? (day > 15 ? -1 : 1) : 0), 
                                       day);
                
                if (this.isToday(cellDate)) {
                    cell.classList.add('today');
                }

                // Add events if they exist
                const dateString = this.formatDate(cellDate);
                if (this.events[dateString]) {
                    this.events[dateString].forEach(event => {
                        const eventElement = document.createElement('div');
                        eventElement.className = 'event';
                        eventElement.textContent = `${event.time} ${event.title} ${event.venue}`;
                        eventElement.onclick = () => this.showDeleteModal(dateString, index);
                        eventsList.appendChild(eventElement);
                    });
                }

                cell.addEventListener('click', () => this.openEventModal(cellDate));
                calendar.appendChild(cell);
            }

            setupEventListeners() {
                document.getElementById('prevMonth').addEventListener('click', () => {
                    this.currentDate.setMonth(this.currentDate.getMonth() - 1);
                    this.renderCalendar();
                });

                document.getElementById('nextMonth').addEventListener('click', () => {
                    this.currentDate.setMonth(this.currentDate.getMonth() + 1);
                    this.renderCalendar();
                });

                document.getElementById('today').addEventListener('click', () => {
                    this.currentDate = new Date();
                    this.renderCalendar();
                });

                const modal = document.getElementById('eventModal');
                const closeBtn = document.querySelector('.close-modal');
                const eventForm = document.getElementById('eventForm');

                closeBtn.addEventListener('click', () => {
                    modal.style.display = 'none';
                });

                window.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        modal.style.display = 'none';
                    }
                });

                // eventForm.addEventListener('submit', (e) => {
                //     e.preventDefault();
                //     this.addEvent();
                // });
            }

            openEventModal(date) {
                this.selectedDate = date;
                document.getElementById('eventDate').value = this.formatDate(date);
                document.getElementById('eventModal').style.display = 'block';
            }

            formatDate(date) {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            }

            isToday(date) {
                return this.formatDate(date) === this.formatDate(this.today);
            }
        }




        // Initialize calendar when page loads
        document.addEventListener('DOMContentLoaded', () => {
            new Calendar();
        });
  </script>
  
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>

