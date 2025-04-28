<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event</title>
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .calendar-container {
            width: 100%;
            max-width: 1200px;
            padding: 0px 10px 0px 30px;
            box-sizing: border-box;
            max-height: calc(100vh - 10px);
            margin-left: 220px;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        h1.month-year {
            text-align: center;
            margin: 0;
            font-size: 24px;
        }

        .calendar-nav {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }

        .calendar-nav button {
            padding: 10px 20px;
            background-color: #ccb3d9;
            border: none;
            border-radius: 10px;
            font-size: 1em;
            cursor: pointer;
        }

        /* Calendar table styling */
        .calendar {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .calendar th, .calendar td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: center;
            vertical-align: top;
            height: 80px;
            font-size: 14px;
        }

        .calendar th {
            background-color: #ccb3d9;
            height: 50px;
            vertical-align: middle;
            font-size: 16px;
        }

        td.day:hover {
            background-color: #f0f0f0;
        }

        .day {
            cursor: pointer;
            position: relative;
        }

        /* Event styling */
        .day div {
            font-size: 12px;
            background-color: #ccb3d9;
            border-radius: 4px;
            padding: 2px;
            margin-top: 5px;
        }

        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal.show {
            display: flex; /* Only show when 'show' class is added */
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        /* Close button inside modal */
        .close {
            color: #aaa;
            float: right;
            font-size: 20px;
            cursor: pointer;
        }

        .close:hover, .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Event reservation form */
        .modal-content h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .modal-content input[type="text"],
        .modal-content input[type="time"],
        .modal-content input[type="date"],
        .modal-content select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            box-sizing: border-box;
        }

        .modal-content .buttons {
            text-align: center;
        }

        .modal-content .buttons button {
            padding: 10px 20px;
            background-color: #ccb3d9;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .calendar th, .calendar td {
                height: 60px;
                font-size: 12px;
                padding: 3px;
            }

            .calendar-nav button {
                font-size: 12px;
                padding: 6px 10px;
            }

            .modal-content {
                width: 90%;
            }

            .modal-content input[type="text"],
            .modal-content input[type="time"],
            .modal-content input[type="date"],
            .modal-content select {
                padding: 8px;
            }

            .modal-content .buttons button {
                padding: 8px 15px;
            }
        }

        @media (max-width: 480px) {
            .calendar th, .calendar td {
                height: 50px;
                font-size: 10px;
                padding: 2px;
            }

            .calendar-nav button {
                font-size: 10px;
                padding: 5px 8px;
            }

            .modal-content input[type="text"],
            .modal-content input[type="time"],
            .modal-content input[type="date"],
            .modal-content select {
                padding: 6px;
            }

            .modal-content .buttons button {
                padding: 6px 10px;
            }
        }

        .event-name {
            font-weight: bold;
            margin-top: 5px;
        }

        .event-venue {
            font-style: italic;
            margin-top: 2px;
        }

        .event-time {
            color: #888;
            margin-top: 2px;
            font-size: 0.9em;
        }


 

        /* ---- DROP DOWN---- */
        #venue-container {
    display: flex;
    justify-content: center;  /* Horizontally center the dropdown */
    align-items: center;
    margin-top: 20px;
margin-bottom: 25px;      /* Vertically center the dropdown */
         /* Full height of the viewport */
}
        #venue {
            
    background-color: #eee6f3; /* Purple background */
    color: black; /* White text color */
    border: 2px solid #8e44ad; /* Slightly darker purple border */
    border-radius: 5px; /* Rounded corners */
    padding: 10px; /* Padding inside the select box */
    font-size: 16px; /* Font size */
    font-family: Arial, sans-serif; /* Font family */
}

#venue option {
    background-color: #eee6f3; /* Same purple background for options */
    color: black; /* White text for options */
    padding: 10px; /* Padding inside each option */
}

#venue option:hover {
    background-color: #8e44ad;
    color:white; /* Darker purple when hovering over an option */
}

#venue option:checked {
    background-color: #8e44ad;
    color:white; /* Darker purple when an option is selected */
}


    </style>
</head>
<body>
    <?php include 'nav.view.php';?>

    
    <div class="calendar-container">
    
        <h1>Event Calendar</h1>

        <div id="venue-container">
    <select id="venue">
        <option value="">Select Venue</option>
        <option value="Ground">Ground</option>
        <option value="Indoor Stadium">Indoor Stadium</option>
        <option value="Basket ball court">Basket ball court</option>
        <option value="Tennis court">Tennis court</option>
    </select>
</div>

        <div class="calendar-nav">
            <button id="prevMonth">Previous</button>
            <h1 id="month-year"></h1>
            <button id="nextMonth">Next</button>
        </div>
        <table class="calendar">
            <thead>
                <tr>
                    <th>Sunday</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                </tr>
            </thead>
            <tbody id="calendar-body">
                <!-- Calendar will be generated here -->
            </tbody>
        </table>
    </div>

    <!-- Modal for adding events -->
    <div id="eventModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add Event</h2>
            <input type="text" id="eventName" placeholder="Event Name">
            <input type="text" id="eventDescription" placeholder="Event Description">
            
            <input type="date" id="eventDate">
           <p style="text-align:left"> start time:</p>  
            <input type="time" id="startTime">
            
           <p style="text-align:left">  End time:</p> 
            <input type="time" id="endTime">
            <div class="buttons">
                <button id="saveEvent">Save Event</button>    
            </div>
        </div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
          const daysContainer = document.getElementById('calendar-body');
          const monthYearDisplay = document.getElementById('month-year');
          const prevMonthButton = document.getElementById('prevMonth');
          const nextMonthButton = document.getElementById('nextMonth');
          const modal = document.getElementById('eventModal'); // Modal container
          let currentDay = null;

          // Calendar control variables
          let currentDate = new Date();
          let currentMonth = currentDate.getMonth();
          let currentYear = currentDate.getFullYear();

          // List of month names
          const monthNames = [
              'January', 'February', 'March', 'April', 'May', 'June',
              'July', 'August', 'September', 'October', 'November', 'December'
          ];

          // Function to render the calendar for a given month and year
          function renderCalendar(month, year) {
              const firstDay = new Date(year, month).getDay();
              const daysInMonth = new Date(year, month + 1, 0).getDate();
              daysContainer.innerHTML = ''; // Clear previous calendar cells
              monthYearDisplay.textContent = ${monthNames[month]} ${year}; // Update month-year display

              // Create blank cells for days before the start of the month
              let row = document.createElement('tr');
              for (let i = 0; i < firstDay; i++) {
                  let cell = document.createElement('td');
                  row.appendChild(cell);
              }

              // Create cells for each day in the month
              for (let day = 1; day <= daysInMonth; day++) {
                  if (row.children.length === 7) {
                      daysContainer.appendChild(row);
                      row = document.createElement('tr');
                  }

                  let cell = document.createElement('td');
                  cell.classList.add('day');
                  cell.textContent = day;
                  cell.dataset.date = ${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')};
                  row.appendChild(cell);

                  // Add event listener to open modal for adding events
                  cell.addEventListener('click', function () {
                      currentDay = this;
                      modal.classList.add('show'); // Show the modal
                      document.getElementById('eventDate').value = this.dataset.date; // Auto-fill the date

                      // Clear any previous event input
                      document.getElementById('eventName').value = ''; 
                      document.getElementById('venue').value = '';
                      document.getElementById('startTime').value = '';
                      document.getElementById('eventDescription').value = ''; // Clear description input
                  });
              }

              // Append the final row to the calendar
              daysContainer.appendChild(row);
          }

          // Event listener for saving the event
          document.getElementById('saveEvent').addEventListener('click', function () {
              const eventName = document.getElementById('eventName').value;
              const eventVenue = document.getElementById('venue').value;
              const eventTime = document.getElementById('startTime').value;
              const eventDescription = document.getElementById('eventDescription').value;

              if (eventName !== '' && currentDay) {
                  let eventDiv = document.createElement('div');
                  eventDiv.textContent = ${eventName} at ${eventVenue} (${eventTime}) - ${eventDescription};
                  currentDay.appendChild(eventDiv);
                  modal.style.display = 'none'; // Hide modal after saving
              }
          });

          // Event listener for closing the modal
          const closeModal = document.getElementsByClassName('close')[0];
          closeModal.addEventListener('click', function () {
              modal.classList.remove('show');
          });

          // Event listeners for changing months
          prevMonthButton.addEventListener('click', function () {
              currentMonth--;
              if (currentMonth < 0) {
                  currentMonth = 11;
                  currentYear--;
              }
              renderCalendar(currentMonth, currentYear);
          });

          nextMonthButton.addEventListener('click', function () {
              currentMonth++;
              if (currentMonth > 11) {
                  currentMonth = 0;
                  currentYear++;
              }
              renderCalendar(currentMonth, currentYear);
          });

          // Initial render for the current month and year
          renderCalendar(currentMonth, currentYear);
      });
  </script>
</body>
</html>