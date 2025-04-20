<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/rese.css">
  <title>Sports Facility Reservation</title>
</head>
<body>
  <div class="header">
    <h1>Sports Facility Reservation</h1>
  </div>

  <div class="tabs">
    <button class="tab active" onclick="showTab('new-reservation')">New Reservation</button>
    <button class="tab" onclick="showTab('previous-reservations')">Previous Reservations</button>
  </div>

  <div id="new-reservation-tab">
    <div class="container">
      <!-- Left side: New Reservation Form -->
      <div class="section">
        <h2>Make a Reservation</h2>
        <form id="reservation-form">
          <div>
            <label for="facility">Select Facility Area:</label>
            <select id="facility" onchange="updateTimeSlots()">
              <option value="">Select a facility...</option>
              <option value="indoor-court">Indoor Basketball Court</option>
              <option value="outdoor-field">Outdoor Football Field</option>
              <option value="swimming-pool">Swimming Pool</option>
              <option value="tennis-court">Tennis Court</option>
              <option value="gym">Gymnasium</option>
            </select>
          </div>
          
          <div>
            <label for="date">Date:</label>
            <input type="date" id="date" onchange="updateTimeSlots()">
          </div>
          
          <div>
            <label>Available Time Slots:</label>
            <div class="time-slots" id="time-slots">
              <!-- Time slots will be populated dynamically -->
              <div class="time-slot available" onclick="selectTimeSlot(this)">8:00 - 9:00</div>
              <div class="time-slot available" onclick="selectTimeSlot(this)">9:00 - 10:00</div>
              <div class="time-slot unavailable">10:00 - 11:00</div>
              <div class="time-slot available" onclick="selectTimeSlot(this)">11:00 - 12:00</div>
              <div class="time-slot available" onclick="selectTimeSlot(this)">12:00 - 13:00</div>
              <div class="time-slot unavailable">13:00 - 14:00</div>
              <div class="time-slot available" onclick="selectTimeSlot(this)">14:00 - 15:00</div>
              <div class="time-slot available" onclick="selectTimeSlot(this)">15:00 - 16:00</div>
              <div class="time-slot available" onclick="selectTimeSlot(this)">16:00 - 17:00</div>
            </div>
          </div>
          
          <div>
            <label for="participants">Number of Participants:</label>
            <input type="number" id="participants" min="1" max="50">
          </div>
          
          <div>
            <label for="reason">Reason for Reservation:</label>
            <textarea id="reason" rows="3" placeholder="Team practice, tournament preparation, etc."></textarea>
          </div>
          
          <button type="submit">Submit Reservation</button>
        </form>
      </div>
      
      <!-- Right side: Facility Status -->
      <div class="section">
      <div id="facility-status" class="tab-content">
            <h2>Facility Availability</h2>
            <div class="form-group">
                <label for="facility-check">Select Facility</label>
                <select id="facility-check">
                    <option value="">All Facilities</option>
                    <option value="basketball1">Basketball Court 1</option>
                    <option value="basketball2">Basketball Court 2</option>
                    <option value="soccer1">Soccer Field Main</option>
                    <option value="soccer2">Soccer Field Practice</option>
                    <option value="volleyball">Volleyball Court</option>
                    <option value="tennis1">Tennis Court 1</option>
                    <option value="tennis2">Tennis Court 2</option>
                    <option value="swimming">Swimming Pool</option>
                </select>
            </div>

            <div class="form-group">
                <label for="date-check">Date</label>
                <input type="date" id="date-check">
            </div>

            <button type="button" onclick="checkAvailability()">Check Availability</button>

            <div id="availability-results" style="margin-top: 20px;">
                <div class="reservation-card">
                    <h3>Basketball Court 1</h3>
                    <p><strong>Date:</strong> April 22, 2025</p>
                    <p><strong>Available Slots:</strong></p>
                    <ul>
                        <li>8:00 AM - 10:00 AM</li>
                        <li>10:00 AM - 12:00 PM</li>
                        <li>2:00 PM - 4:00 PM</li>
                        <li><span style="color: #dc2626;">4:00 PM - 6:00 PM (Reserved)</span></li>
                        <li>6:00 PM - 8:00 PM</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <h3>Today's Schedule</h3>
        <div class="reservation-list">
          <div class="reservation-item">
            <div class="reservation-header">
              <span class="reservation-date">Outdoor Field</span>
              <span class="reservation-status status-upcoming">Reserved</span>
            </div>
            <div class="reservation-details">
              <div>
                <div class="detail-label">Time</div>
                <div>10:00 - 11:00</div>
              </div>
              <div>
                <div class="detail-label">Team</div>
                <div>Football Team A</div>
              </div>
            </div>
          </div>
          
          <div class="reservation-item">
            <div class="reservation-header">
              <span class="reservation-date">Tennis Court</span>
              <span class="reservation-status status-upcoming">Reserved</span>
            </div>
            <div class="reservation-details">
              <div>
                <div class="detail-label">Time</div>
                <div>13:00 - 14:00</div>
              </div>
              <div>
                <div class="detail-label">Team</div>
                <div>Tennis Club</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="previous-reservations-tab" style="display: none;">
    <div class="container">
      <div class="section" style="width: 100%;">
        <h2>Your Previous Reservations</h2>
        
        <div class="reservation-list">
          <div class="reservation-item">
            <div class="reservation-header">
              <span class="reservation-date">April 15, 2025</span>
              <span class="reservation-status status-completed">Completed</span>
            </div>
            <div class="reservation-details">
              <div>
                <div class="detail-label">Facility</div>
                <div>Indoor Basketball Court</div>
              </div>
              <div>
                <div class="detail-label">Time</div>
                <div>14:00 - 16:00</div>
              </div>
              <div>
                <div class="detail-label">Participants</div>
                <div>15 players</div>
              </div>
              <div>
                <div class="detail-label">Reason</div>
                <div>Basketball team practice</div>
              </div>
            </div>
          </div>
          
          <div class="reservation-item">
            <div class="reservation-header">
              <span class="reservation-date">April 10, 2025</span>
              <span class="reservation-status status-completed">Completed</span>
            </div>
            <div class="reservation-details">
              <div>
                <div class="detail-label">Facility</div>
                <div>Outdoor Football Field</div>
              </div>
              <div>
                <div class="detail-label">Time</div>
                <div>9:00 - 11:00</div>
              </div>
              <div>
                <div class="detail-label">Participants</div>
                <div>22 players</div>
              </div>
              <div>
                <div class="detail-label">Reason</div>
                <div>Football match preparation</div>
              </div>
            </div>
          </div>
          
          <div class="reservation-item">
            <div class="reservation-header">
              <span class="reservation-date">April 5, 2025</span>
              <span class="reservation-status status-completed">Completed</span>
            </div>
            <div class="reservation-details">
              <div>
                <div class="detail-label">Facility</div>
                <div>Swimming Pool</div>
              </div>
              <div>
                <div class="detail-label">Time</div>
                <div>15:00 - 17:00</div>
              </div>
              <div>
                <div class="detail-label">Participants</div>
                <div>12 swimmers</div>
              </div>
              <div>
                <div class="detail-label">Reason</div>
                <div>Swimming team training</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Function to show selected tab
    function showTab(tabId) {
      if (tabId === 'new-reservation') {
        document.getElementById('new-reservation-tab').style.display = 'block';
        document.getElementById('previous-reservations-tab').style.display = 'none';
        document.querySelectorAll('.tab')[0].classList.add('active');
        document.querySelectorAll('.tab')[1].classList.remove('active');
      } else {
        document.getElementById('new-reservation-tab').style.display = 'none';
        document.getElementById('previous-reservations-tab').style.display = 'block';
        document.querySelectorAll('.tab')[0].classList.remove('active');
        document.querySelectorAll('.tab')[1].classList.add('active');
      }
    }
    
    // Function to select time slot
    function selectTimeSlot(element) {
      // Remove selection from all time slots
      document.querySelectorAll('.time-slot').forEach(slot => {
        if (!slot.classList.contains('unavailable')) {
          slot.classList.remove('selected');
        }
      });
      
      // Add selection to clicked element
      if (!element.classList.contains('unavailable')) {
        element.classList.add('selected');
      }
    }
    
    // Function to update time slots based on facility and date
    function updateTimeSlots() {
      const facility = document.getElementById('facility').value;
      const date = document.getElementById('date').value;
      
      if (facility && date) {
        // In a real application, you would fetch available time slots from server
        console.log(`Updating time slots for ${facility} on ${date}`);
        // Simulate different availability for different facilities
        if (facility === 'indoor-court') {
          document.querySelectorAll('.time-slot')[2].classList.remove('unavailable');
          document.querySelectorAll('.time-slot')[2].classList.add('available');
          document.querySelectorAll('.time-slot')[5].classList.add('unavailable');
          document.querySelectorAll('.time-slot')[5].classList.remove('available');
        } else if (facility === 'outdoor-field') {
          document.querySelectorAll('.time-slot')[5].classList.remove('unavailable');
          document.querySelectorAll('.time-slot')[5].classList.add('available');
          document.querySelectorAll('.time-slot')[2].classList.add('unavailable');
          document.querySelectorAll('.time-slot')[2].classList.remove('available');
        }
      }
    }
    
    // Function to update facility status
    function updateFacilityStatus() {
      const date = document.getElementById('status-date').value;
      if (date) {
        // In a real application, you would fetch facility status from server
        console.log(`Updating facility status for ${date}`);
      }
    }
    
    // Form submission
    document.getElementById('reservation-form').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const facility = document.getElementById('facility').value;
      const date = document.getElementById('date').value;
      const participants = document.getElementById('participants').value;
      const reason = document.getElementById('reason').value;
      
      // Check if a time slot is selected
      const selectedTimeSlot = document.querySelector('.time-slot.selected');
      
      if (!facility || !date || !participants || !reason || !selectedTimeSlot) {
        alert('Please fill in all fields and select a time slot.');
        return;
      }
      
      // In a real application, you would send this data to the server
      alert(`Reservation submitted successfully!\n\nFacility: ${facility}\nDate: ${date}\nTime: ${selectedTimeSlot.textContent}\nParticipants: ${participants}\nReason: ${reason}`);
      
      // Reset form
      this.reset();
      document.querySelectorAll('.time-slot').forEach(slot => {
        slot.classList.remove('selected');
      });
    });
    
    // Initialize the page
    document.addEventListener('DOMContentLoaded', function() {
      // Set default date to today
      const today = new Date();
      const dateStr = today.toISOString().split('T')[0];
      document.getElementById('date').value = dateStr;
      document.getElementById('status-date').value = dateStr;
    });
  </script>
</body>
</html>