<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/amar/pool.css">
  <title>Request a Pass</title>







    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }
        .container {
            width: 100%;
            margin-left:220px;
            background-color: white;
        }
        .card {
            background-color: #eee6f3;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .card-title {
            color: #4a148c;
            margin-bottom: 15px;
            font-size: 1.2em;
            font-weight: bold;
        }
        .day-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #e1bee7;
            border-radius: 5px;
        }
        .book-btn {
            background-color: #6a1b9a;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        #epass {
            display: none;
            background-color: white;
            padding: 15px;
        }
    </style>
</head>
<body>
<?php 
include 'nav.view.php';
?>

    <div class="container">
        <h1 style="color: #4a148c; text-align: center;">E-Pass Pool</h1>

        <!-- Welcome Card -->
        <div class="card">
            <div class="card-title">Welcome Amar</div>
            <p>Available Pool Days: Monday - Friday</p>
            <p>Limit: 20 people</p>
        </div>

        <!-- Booking Card -->
        <div class="card">
            <div class="card-title">Book Now</div>
            <div id="booking-section">
                <div class="day-row" id="monday-row">
                    <span>Monday</span>
                    <div>
                        <span id="monday-count">0/20</span>
                        <button class="book-btn" onclick="bookDay('monday')">Book Now</button>
                    </div>
                </div>
                <div class="day-row" id="tuesday-row">
                    <span>Tuesday</span>
                    <div>
                        <span id="tuesday-count">0/20</span>
                        <button class="book-btn" onclick="bookDay('tuesday')">Book Now</button>
                    </div>
                </div>
                <div class="day-row" id="wednesday-row">
                    <span>Wednesday</span>
                    <div>
                        <span id="wednesday-count">0/20</span>
                        <button class="book-btn" onclick="bookDay('wednesday')">Book Now</button>
                    </div>
                </div>
                <div class="day-row" id="thursday-row">
                    <span>Thursday</span>
                    <div>
                        <span id="thursday-count">0/20</span>
                        <button class="book-btn" onclick="bookDay('thursday')">Book Now</button>
                    </div>
                </div>
                <div class="day-row" id="friday-row">
                    <span>Friday</span>
                    <div>
                        <span id="friday-count">0/20</span>
                        <button class="book-btn" onclick="bookDay('friday')">Book Now</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- E-Pass Card -->
        <div class="card" id="epass">
            <div class="card-title">E-Pass</div>
            <div id="epass-details">
                <p>Name: Amar</p>
                <p>Day: <span id="epass-day"></span></p>
                <p>Date: <span id="epass-date"></span></p>
                <p>Time: <span id="epass-time"></span></p>
                <p>Pass ID: <span id="epass-id"></span></p>
            </div>
        </div>

        <!-- Booking History Card -->
        <div class="card">
            <div class="card-title">Booking History</div>
            <ul id="booking-history"></ul>
        </div>
    </div>

    <script>
        var bookingStatus = {
            monday: { booked: false, count: 0 },
            tuesday: { booked: false, count: 0 },
            wednesday: { booked: false, count: 0 },
            thursday: { booked: false, count: 0 },
            friday: { booked: false, count: 0 }
        };

        function bookDay(day) {
            var rowElement = document.getElementById(day + '-row');
            var countElement = document.getElementById(day + '-count');
            
            if (!bookingStatus[day].booked && bookingStatus[day].count < 20) {
                bookingStatus[day].booked = true;
                bookingStatus[day].count++;
                
                rowElement.style.backgroundColor = '#9c27b0';
                countElement.textContent = bookingStatus[day].count + '/20';
                
                generateEPass(day);
                addBookingHistory(day, 'Booked');
            } else if (bookingStatus[day].booked) {
                bookingStatus[day].booked = false;
                bookingStatus[day].count--;
                
                rowElement.style.backgroundColor = '#e1bee7';
                countElement.textContent = bookingStatus[day].count + '/20';
                
                clearEPass();
                addBookingHistory(day, 'Cancelled');
            }
        }

        function generateEPass(day) {
            var now = new Date();
            
            document.getElementById('epass-day').textContent = day.charAt(0).toUpperCase() + day.slice(1);
            document.getElementById('epass-date').textContent = now.toLocaleDateString();
            document.getElementById('epass-time').textContent = now.toLocaleTimeString();
            document.getElementById('epass-id').textContent = 'EP-' + Math.random().toString(36).substr(2, 9).toUpperCase();
            
            document.getElementById('epass').style.display = 'block';
        }

        function clearEPass() {
            document.getElementById('epass').style.display = 'none';
        }

        function addBookingHistory(day, status) {
            var historyList = document.getElementById('booking-history');
            var listItem = document.createElement('li');
            
            listItem.innerHTML = 
                day.charAt(0).toUpperCase() + day.slice(1) + 
                ' - ' + status + 
                ' at ' + new Date().toLocaleTimeString();
            
            historyList.insertBefore(listItem, historyList.firstChild);
        }
    </script>
</body>
</html>