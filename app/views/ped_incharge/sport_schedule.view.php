<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sports Practice Schedule</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/hockeyschedule.css">
</head>
<body>

<?php $current_page = 'sports'; include 'sidebar.view.php'?>
<div class="main-content">  
<div class="navbar" style="border-radius:8px;">
  <a href="hockey">Home</a>
            <a href="hockeyattendance">Attendance</a>
            <a href="hockeyteam">Team</a>
            <a href="hockeycoaches">Coaches</a>
            <a href="hockeyschedule">Schedule</a>
            <a href="hockeysportrecords">Records</a>
</div>
  <div class="schedule-container">
    <h1>Weekly Practice Schedule</h1>
    <div class="schedule-grid">
      <div class="day-header">Time</div>
      <div class="day-header">Monday</div>
      <div class="day-header">Tuesday</div>
      <div class="day-header">Wednesday</div>
      <div class="day-header">Thursday</div>
      <div class="day-header">Friday</div>
      <div class="day-header">Saturday</div>
      <div class="day-header">Sunday</div>

      <!-- Time Slots -->
      <div class="time-slot">3:00 PM - 4:00 PM</div>
      <div class="day-slot" data-day="Monday" data-time="9:00 AM"></div>
      <div class="day-slot" data-day="Tuesday" data-time="9:00 AM"></div>
      <div class="day-slot" data-day="Wednesday" data-time="9:00 AM"></div>
      <div class="day-slot" data-day="Thursday" data-time="9:00 AM"></div>
      <div class="day-slot" data-day="Friday" data-time="9:00 AM"></div>
      <div class="day-slot" data-day="Saturday" data-time="9:00 AM"></div>
      <div class="day-slot" data-day="Sunday" data-time="9:00 AM"></div>

      <div class="time-slot">4:00 PM - 5:00 PM</div>
      <div class="day-slot" data-day="Monday" data-time="9:00 AM"></div>
      <div class="day-slot" data-day="Tuesday" data-time="9:00 AM"></div>
      <div class="day-slot" data-day="Wednesday" data-time="9:00 AM"></div>
      <div class="day-slot" data-day="Thursday" data-time="9:00 AM"></div>
      <div class="day-slot" data-day="Friday" data-time="9:00 AM"></div>
      <div class="day-slot" data-day="Saturday" data-time="9:00 AM"></div>
      <div class="day-slot" data-day="Sunday" data-time="9:00 AM"></div>

      <div class="time-slot">5:00 PM - 6:00 PM</div>
      <div class="day-slot" data-day="Monday" data-time="9:00 AM"></div>
      <div class="day-slot" data-day="Tuesday" data-time="9:00 AM"></div>
      <div class="day-slot" data-day="Wednesday" data-time="9:00 AM"></div>
      <div class="day-slot" data-day="Thursday" data-time="9:00 AM"></div>
      <div class="day-slot" data-day="Friday" data-time="9:00 AM"></div>
      <div class="day-slot" data-day="Saturday" data-time="9:00 AM"></div>
      <div class="day-slot" data-day="Sunday" data-time="9:00 AM"></div>
      
      <!-- Add more time slots as needed -->
    </div>
    <!-- <button id="save-btn">Save Schedule</button> -->
  </div>
  </div>
  <script src="<?=ROOT?>/assets/js/ped_incharge/hockeyschedule.js"></script>
</body>
</html>
