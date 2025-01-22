<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pool Booking - Student Portal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            background-color: #2196F3;
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .student-info {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .booking-section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .date-picker {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .available-day {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .available-day.full {
            background-color: #f5f5f5;
            color: #999;
        }

        .capacity-indicator {
            font-size: 14px;
            color: #666;
        }

        .e-pass {
            background: #4CAF50;
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .e-pass h2 {
            margin-bottom: 10px;
        }

        .e-pass-details {
            background: white;
            color: #333;
            padding: 15px;
            border-radius: 4px;
            margin-top: 10px;
        }

        .qr-code {
            background: white;
            padding: 20px;
            width: 150px;
            height: 150px;
            margin: 10px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #666;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #2196F3;
            color: white;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            background-color: #1976D2;
        }

        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .my-bookings {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .booking-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .error-message {
            color: #f44336;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Pool Booking Portal</h1>
            <div class="student-info-mini">
                <span id="studentName">John Doe</span>
                <span id="studentId">#12345</span>
            </div>
        </div>

        <div class="student-info">
            <h2>Welcome, John Doe!</h2>
            <p>Pool Hours: 5:00 PM - 7:00 PM daily</p>
            <p>Daily student limit: 20 students</p>
        </div>

        <div id="activeEPass" style="display: none;" class="e-pass">
            <h2>Your Pool E-Pass</h2>
            <div class="e-pass-details">
                <p><strong>Date:</strong> <span id="ePassDate">November 30, 2024</span></p>
                <p><strong>Time:</strong> 5:00 PM - 7:00 PM</p>
                <p><strong>Student ID:</strong> #12345</p>
            </div>
            <div class="qr-code">
                [QR Code Placeholder]
            </div>
            <button onclick="cancelBooking()">Cancel Booking</button>
        </div>

        <div class="booking-section">
            <h2>Available Pool Days</h2>
            <div id="availableDays">
                <!-- Available days will be populated here -->
            </div>
        </div>

        <div class="my-bookings">
            <h2>My Booking History</h2>
            <div id="bookingHistory">
                <!-- Booking history will be populated here -->
            </div>
        </div>
    </div>

    <script>
        // Sample data
        let studentLimit = 20;
        let bookings = {
            '2024-11-30': 15,
            '2024-12-01': 20,
            '2024-12-02': 5
        };
        let myBooking = null;

        // Initialize available days
        function initializeAvailableDays() {
            const container = document.getElementById('availableDays');
            container.innerHTML = '';
            
            const today = new Date();
            for(let i = 0; i < 7; i++) {
                const date = new Date();
                date.setDate(today.getDate() + i);
                const dateString = date.toISOString().split('T')[0];
                const currentBookings = bookings[dateString] || 0;
                const isFull = currentBookings >= studentLimit;

                const dayElement = document.createElement('div');
                dayElement.className = available-day ${isFull ? 'full' : ''};
                dayElement.innerHTML = `
                    <div>
                        <strong>${date.toLocaleDateString('en-US', { weekday: 'long', month: 'long', day: 'numeric' })}</strong>
                        <div class="capacity-indicator">
                            ${currentBookings}/${studentLimit} slots booked
                        </div>
                    </div>
                    ${isFull ? 
                        '<button disabled>Full</button>' : 
                        <button onclick="bookPool('${dateString}')">Book Pool</button>
                    }
                `;
                container.appendChild(dayElement);
            }
        }

        // Book pool for a specific date
        function bookPool(date) {
            if (myBooking) {
                alert('You already have an active booking!');
                return;
            }

            // Simulate booking
            myBooking = {
                date: date,
                studentId: '#12345',
                ePassId: Math.random().toString(36).substr(2, 9)
            };

            // Update UI
            showEPass();
            initializeAvailableDays();
        }

        // Show E-Pass
        function showEPass() {
            if (!myBooking) return;

            const ePassElement = document.getElementById('activeEPass');
            document.getElementById('ePassDate').textContent = new Date(myBooking.date).toLocaleDateString('en-US', { 
                weekday: 'long', 
                month: 'long', 
                day: 'numeric' 
            });
            ePassElement.style.display = 'block';
        }

        // Cancel booking
        function cancelBooking() {
            if (confirm('Are you sure you want to cancel your booking?')) {
                myBooking = null;
                document.getElementById('activeEPass').style.display = 'none';
                initializeAvailableDays();
            }
        }

        // Initialize the UI
        initializeAvailableDays();
        if (myBooking) showEPass();
    </script>
</body>
</html>