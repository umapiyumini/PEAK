<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pool Booking System</title>
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
      width: 80%;
      max-width: 800px;
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
    .booking-section {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 15px;
      background-color: #e1bee7;
      border-radius: 5px;
    }
    .book-btn {
      background-color: #6a1b9a;
      color: white;
      border: none;
      padding: 12px 30px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      font-weight: bold;
    }
    .book-btn:hover {
      background-color: #4a148c;
    }
    #epass {
      display: none;
      background-color: white;
      padding: 15px;
      border: 2px dashed #6a1b9a;
      margin-top: 20px;
    }
    #status-message {
      text-align: center;
      margin-top: 15px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 style="color: #4a148c; text-align: center;">Pool Booking System</h1>

    <!-- Welcome Card -->
    <div class="card">
      <div class="card-title">Welcome to Pool Booking</div>
      <p>Pool Hours: 9:00 AM - 6:00 PM</p>
      <p>Booking Limit: 20 students</p>
    </div>

    <!-- Booking Card -->
    <div class="card">
      <div class="card-title">Book Pool Access</div>
      <div class="booking-section">
        <button class="book-btn" id="booking-button" onclick="bookPool()">Book Now</button>
      </div>
      <p id="status-message"></p>
    </div>

    <!-- E-Pass Card -->
    <div class="card" id="epass">
      <div class="card-title">E-Pass for Pool Access</div>
      <div id="epass-details">
        <p><strong>Student Name:</strong> <span id="student-name">Student</span></p>
        <p><strong>Date:</strong> <span id="epass-date"></span></p>
        <p><strong>Time:</strong> <span id="epass-time"></span></p>
        <p><strong>Pass ID:</strong> <span id="epass-id"></span></p>
        <p><strong>Status:</strong> <span style="color: green; font-weight: bold;">CONFIRMED</span></p>
      </div>
    </div>
  </div>

  <script>
    let hasBooked = false;
    
    function bookPool() {
      const bookingButton = document.getElementById('booking-button');
      const statusMessage = document.getElementById('status-message');
      
      // In a real implementation, you would check with the backend if booking is possible
      // For simplicity, we're toggling between booked and not booked states
      
      if (!hasBooked) {
        // Make a booking
        hasBooked = true;
        
        bookingButton.textContent = 'Cancel Booking';
        statusMessage.textContent = 'You have successfully booked pool access.';
        statusMessage.style.color = 'green';
        
        generateEPass();
      } else {
        // Cancel booking
        hasBooked = false;
        
        bookingButton.textContent = 'Book Now';
        statusMessage.textContent = 'Your booking has been cancelled.';
        statusMessage.style.color = 'red';
        
        document.getElementById('epass').style.display = 'none';
      }
    }

    function generateEPass() {
      const now = new Date();
      
      // Set student name - in a real app, this would come from user data
      document.getElementById('student-name').textContent = 'Student';
      
      // Set date and time
      document.getElementById('epass-date').textContent = now.toLocaleDateString();
      document.getElementById('epass-time').textContent = now.toLocaleTimeString();
      
      // Generate random pass ID
      document.getElementById('epass-id').textContent = 'POOL-' + Math.random().toString(36).substr(2, 8).toUpperCase();
      
      // Show the e-pass
      document.getElementById('epass').style.display = 'block';
    }
  </script>
</body>
</html>