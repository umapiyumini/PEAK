<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sports Facility Reservation</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/rese.css">
</head>
<body>

<div class="header">
  <h1>Sports Facility Reservation</h1>
</div>

<div class="tabs">
  <button class="tab active" onclick="showTab('new-reservation')">New Reservation</button>
  <button class="tab" onclick="showTab('previous-reservations')">Previous Reservations</button>
</div>

<!-- New Reservation Tab -->
<div id="new-reservation-tab">
  <div class="container">
    <div class="section">
      <h2>Make a Reservation</h2>
      <form id="reservation-form" action="<?=ROOT?>/sportscaptain/reservation/addreservation" method="POST">
        <input type="hidden" name="courtid" value="<?= htmlspecialchars($courtname->courtid) ?>">

        <div>
          <label for="facility">Facility:</label>
          <input type="text" id="facility" name="name" value="<?= htmlspecialchars($courtname->name) ?>" readonly>
        </div>

        <div>
          <label for="bookingFor">Booking For:</label>
          <select id="bookingFor" name="event" required>
            <option value="" disabled selected>Select</option>
            <option value="practice">Practice</option>
            <option value="tournament">Tournament</option>
          </select>
        </div>

        <div>
          <label for="date">Date:</label>
          <input type="date" id="date" name="date" min="<?= date('Y-m-d') ?>" onchange="updateTimeSlots()">
        </div>

        <div>
          <label for="duration">Duration:</label>
          <select id="duration" name="duration" onchange="updateTimeSlots()" required>
            <option value="" disabled selected>Select Duration</option>
            <option value="half">Half Day</option>
            <option value="full">Full Day</option>
            <option value="2 hour">2 Hours</option>
          </select>
        </div>

        <!-- Full Day Option -->
        <div id="fullDayOptions" style="display: none;">
          <label>Choose Time Slot:</label>
          <div>
            <label><input type="radio" name="time" value="08:00"> 08:00 - 18:00</label>
          </div>
        </div>

        <!-- Half Day Options -->
        <div id="halfDayOptions" style="display: none;">
          <label>Choose Time Slot:</label>
          <div>
            <label><input type="radio" name="time" value="08:00"> 08:00 - 13:00</label>
            <label><input type="radio" name="time" value="13:00"> 13:00 - 18:00</label>
          </div>
        </div>

        <!-- Two Hour Options -->
        <div id="twoHoursOptions" style="display: none;">
          <label>Choose Time Slot:</label>
          <div id="two-hour-slots"></div>
        </div>

        <div>
          <label for="participants">Number of Participants:</label>
          <input type="number" id="participants" name="numberof_participants" min="1" max="50" required>
        </div>

        <input type="hidden" name="status" value="pending">

        <button type="submit">Submit Reservation</button>
      </form>
    </div>

    <!-- Availability Checker -->
    <div class="section">
      <h2>Check Availability</h2>
      <div>
        <label for="facility-check">Facility:</label>
        <input type="text" id="facility-check" value="<?= htmlspecialchars($courtname->name) ?>" readonly>
      </div>
      <div>
        <label for="date-check">Date:</label>
        <input type="date" id="date-check" min="<?= date('Y-m-d') ?>">
      </div>
      <button onclick="checkAvailability()">Check Availability</button>
      <div id="availability-results"></div>
    </div>
  </div>
</div>

<!-- Previous Reservations Tab -->
<div id="previous-reservations-tab" style="display: none;">
  <div class="container">
    <div class="section">
      <h2>Your Previous Reservations</h2>
      <div class="reservation-list">
        <?php if (!empty($data['allreservations'])): ?>
          <?php foreach ($data['allreservations'] as $item): ?>
            <div class="reservation-item">
              <div class="reservation-header">
                <span class="reservation-date"><?= htmlspecialchars($item->date); ?></span>
                <span class="reservation-status status-<?= strtolower($item->status); ?>"><?= htmlspecialchars($item->status); ?></span>
              </div>
              <div class="reservation-details">
                <div>Facility: <?= htmlspecialchars($item->name); ?></div>
                <div>Time: <?= htmlspecialchars($item->time); ?></div>
                <div>Participants: <?= htmlspecialchars($item->numberof_participants); ?></div>
                <div>Reason: <?= htmlspecialchars($item->event); ?></div>
                <button class="edit-button" id="edit-btn" onclick="editReservation(<?= htmlspecialchars($item->reservationid); ?>)">Edit</button>
                <button class="delete-button" id="delete-btn" onclick="deleteReservation(<?= htmlspecialchars($item->reservationid); ?>)">Cancel</button>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No previous reservations found.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <!-- Edit Reservation Modal -->
<div id="editReservationModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeEditModal()">&times;</span>
    <h2>Edit Reservation</h2>
    <form id="edit-reservation-form" action="<?=ROOT?>/sportscaptain/reservation/editreservation" method="POST">
      <input type="hidden" name="reservationid" id="edit-reservationid" value="<?= $reservationId ?>">
      <input type="hidden" name="courtid" id="edit-courtid">

      <div>
        <label for="edit-facility">Facility:</label>
        <input type="text" id="edit-facility" name="name" readonly>
      </div>

      <div>
        <label for="edit-bookingFor">Booking For:</label>
        <select id="edit-bookingFor" name="event" required>
          <option value="practice">Practice</option>
          <option value="tournament">Tournament</option>
        </select>
      </div>

      <div>
        <label for="edit-date">Date:</label>
        <input type="date" id="edit-date" name="date" min="<?= date('Y-m-d') ?>" onchange="updateEditTimeSlots()" required>
      </div>

      <div>
        <label for="edit-duration">Duration:</label>
        <select id="edit-duration" name="duration" onchange="updateEditTimeSlots()" required>
          <option value="half">Half Day</option>
          <option value="full">Full Day</option>
          <option value="2 hour">2 Hours</option>
        </select>
      </div>

      <!-- Full Day Option -->
      <div id="edit-fullDayOptions" style="display: none;">
        <label>Choose Time Slot:</label>
        <div>
          <label><input type="radio" name="time" value="08:00"> 08:00 - 18:00</label>
        </div>
      </div>

      <!-- Half Day Options -->
      <div id="edit-halfDayOptions" style="display: none;">
        <label>Choose Time Slot:</label>
        <div>
          <label><input type="radio" name="time" value="08:00"> 08:00 - 13:00</label>
          <label><input type="radio" name="time" value="13:00"> 13:00 - 18:00</label>
        </div>
      </div>

      <!-- Two Hour Options -->
      <div id="edit-twoHoursOptions" style="display: none;">
        <label>Choose Time Slot:</label>
        <div id="edit-two-hour-slots"></div>
      </div>

      <div>
        <label for="edit-participants">Number of Participants:</label>
        <input type="number" id="edit-participants" name="numberof_participants" min="1" max="50" required>
      </div>

      <input type="hidden" name="status" value="pending">

      <div class="form-buttons">
        <button type="button" onclick="closeEditModal()">Cancel</button>
        <button type="submit">Update Reservation</button>
      </div>
    </form>
  </div>
</div>
</div>

<script>
  const reservedTimeSlots = <?= $reservedTimeSlots ?>;

  const allSlots = {
    "2 hour": [
      { value: "08:00", display: "08:00 - 10:00" },
      { value: "10:00", display: "10:00 - 12:00" },
      { value: "12:00", display: "12:00 - 14:00" },
      { value: "14:00", display: "14:00 - 16:00" },
      { value: "16:00", display: "16:00 - 18:00" }
    ]
  };

  function showTab(tabId) {
    document.getElementById('new-reservation-tab').style.display = (tabId === 'new-reservation') ? 'block' : 'none';
    document.getElementById('previous-reservations-tab').style.display = (tabId === 'previous-reservations') ? 'block' : 'none';

    document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
    document.querySelector(`.tab[onclick*="${tabId}"]`).classList.add('active');
  }

  function updateTimeSlots() {
  const date = document.getElementById("date").value;
  const duration = document.getElementById("duration").value;

  document.getElementById("fullDayOptions").style.display = "none";
  document.getElementById("halfDayOptions").style.display = "none";
  document.getElementById("twoHoursOptions").style.display = "none";

  if (!date || !duration) return;

  const reserved = reservedTimeSlots[date] || [];

  if (duration === "full") {
    document.getElementById("fullDayOptions").style.display = reserved.includes("08:00") ? "none" : "block";
    // If available, pre-select the radio button
    if (!reserved.includes("08:00")) {
      document.querySelector('#fullDayOptions input[type="radio"]').checked = true;
    }
  } else if (duration === "half") {
    document.getElementById("halfDayOptions").style.display = "block";
    const radioButtons = document.querySelectorAll("#halfDayOptions input");
    
    radioButtons.forEach(input => {
      input.disabled = reserved.includes(input.value);
      // Uncheck disabled options
      if (reserved.includes(input.value)) {
        input.checked = false;
      }
    });
    
    // Auto-select first available option
    const firstAvailable = Array.from(radioButtons).find(input => !input.disabled);
    if (firstAvailable) {
      firstAvailable.checked = true;
    }
  } else if (duration === "2 hour") {
    const container = document.getElementById("two-hour-slots");
    container.innerHTML = "";
    document.getElementById("twoHoursOptions").style.display = "block";

    let hasAvailable = false;
    let firstAdded = null;
    
    allSlots["2 hour"].forEach(slot => {
      if (!reserved.includes(slot.value)) {
        const label = document.createElement('label');
        const input = document.createElement('input');
        input.type = 'radio';
        input.name = 'time';
        input.value = slot.value;
        input.required = true;
        
        label.appendChild(input);
        label.appendChild(document.createTextNode(' ' + slot.display));
        container.appendChild(label);
        container.appendChild(document.createElement('br'));
        
        if (!firstAdded) firstAdded = input;
        hasAvailable = true;
      }
    });

    if (!hasAvailable) {
      container.innerHTML = "<p>No available slots for selected date.</p>";
    } else if (firstAdded) {
      // Auto-select first available option
      firstAdded.checked = true;
    }
  }
}


function checkAvailability() {
  const date = document.getElementById("date-check").value;
  const resultsDiv = document.getElementById("availability-results");
  const courtName = document.getElementById("facility-check").value;

  if (!date) {
    resultsDiv.innerHTML = "<p>Please select a date.</p>";
    return;
  }

  // Format date for display
  const formattedDate = new Date(date).toLocaleDateString();
  
  // Get reserved slots
  const reserved = reservedTimeSlots[date] || [];
  
  // Define all possible time slots
  const allTimeSlots = {
    "2 hours": ["08:00 - 10:00", "10:00 - 12:00", "12:00 - 14:00", "14:00 - 16:00", "16:00 - 18:00"],
    "Half Day": ["Morning (08:00 - 13:00)", "Afternoon (13:00 - 18:00)"],
    "Full Day": ["Full Day (08:00 - 18:00)"]
  };
  
  // Start building HTML
  let html = `<h3>${courtName} - ${formattedDate}</h3>`;
  
  // Check if any slots are reserved
  if (reserved.length === 0) {
    html += "<p>All time slots are available!</p>";
  } else {
    html += "<p>Available time slots:</p>";
  }
  
  // Add available 2-hour slots
  html += "<p><strong>2-Hour Slots:</strong></p><ul>";
  for (let slot of allTimeSlots["2 hours"]) {
    const startTime = slot.split(" - ")[0];
    if (!reserved.includes(startTime)) {
      html += `<li>${slot}</li>`;
    }
  }
  html += "</ul>";
  
  // Add available half-day slots
  html += "<p><strong>Half-Day Slots:</strong></p><ul>";
  if (!reserved.includes("08:00")) {
    html += "<li>Morning (08:00 - 13:00)</li>";
  }
  if (!reserved.includes("13:00")) {
    html += "<li>Afternoon (13:00 - 18:00)</li>";
  }
  html += "</ul>";
  
  // Add available full-day slot
  html += "<p><strong>Full-Day Slot:</strong></p><ul>";
  if (!reserved.includes("08:00")) {
    html += "<li>Full Day (08:00 - 18:00)</li>";
  } else {
    html += "<li>Not available</li>";
  }
  html += "</ul>";
  
  resultsDiv.innerHTML = html;
}

function editReservation(reservationId) {
  // Find the reservation data from the PHP-rendered JSON
  const reservations = JSON.parse('<?php echo json_encode($data["allreservations"] ?? []); ?>');
  const reservation = reservations.find(r => r.reservationid == reservationId);

  if (!reservation) {
    alert("Reservation data not found.");
    return;
  }

  // Set form fields
  document.getElementById("edit-reservationid").value = reservation.reservationid;
  document.getElementById("edit-courtid").value = reservation.courtid;
  document.getElementById("edit-facility").value = reservation.name;
  document.getElementById("edit-bookingFor").value = reservation.event;
  document.getElementById("edit-date").value = reservation.date;
  document.getElementById("edit-duration").value = reservation.duration;
  document.getElementById("edit-participants").value = reservation.numberof_participants;

  // Show relevant time options based on duration
  updateEditTimeSlots();

  // Set the appropriate time radio button (with a small delay to ensure slots are rendered)
  setTimeout(() => {
    const timeRadios = document.querySelectorAll('#editReservationModal input[name="time"]');
    timeRadios.forEach(radio => {
      if (radio.value === reservation.time) {
        radio.checked = true;
      }
    });
  }, 100);

  // Show the modal
  document.getElementById("editReservationModal").style.display = "block";
}

function closeEditModal() {
  document.getElementById("editReservationModal").style.display = "none";
}

function updateEditTimeSlots() {
  const date = document.getElementById("edit-date").value;
  const duration = document.getElementById("edit-duration").value;
  
  // Hide all time slot options first
  document.getElementById("edit-fullDayOptions").style.display = "none";
  document.getElementById("edit-halfDayOptions").style.display = "none";
  document.getElementById("edit-twoHoursOptions").style.display = "none";
  
  if (!date || !duration) return;
  
  // Get reserved slots for the selected date
  // Exclude the current reservation's time slot from reserved slots
  const reservationId = document.getElementById("edit-reservationid").value;
  const reservations = JSON.parse('<?php echo json_encode($data["allreservations"] ?? []); ?>');
  const currentReservation = reservations.find(r => r.reservationid == reservationId);
  
  let reserved = reservedTimeSlots[date] || [];
  
  // If editing an existing reservation for the same date, don't consider its own time as reserved
  if (currentReservation && currentReservation.date === date) {
    reserved = reserved.filter(time => time !== currentReservation.time);
  }
  
  if (duration === "full") {
    document.getElementById("edit-fullDayOptions").style.display = "block";
    // Disable if already reserved
    const fullDayInput = document.querySelector('#edit-fullDayOptions input[type="radio"]');
    fullDayInput.disabled = reserved.includes("08:00");
    if (!fullDayInput.disabled) {
      fullDayInput.checked = true;
    }
  } 
  else if (duration === "half") {
    document.getElementById("edit-halfDayOptions").style.display = "block";
    const radioButtons = document.querySelectorAll("#edit-halfDayOptions input");
    
    radioButtons.forEach(input => {
      input.disabled = reserved.includes(input.value);
      if (input.disabled) {
        input.checked = false;
      }
    });
    
    // Auto-select first available option
    const firstAvailable = Array.from(radioButtons).find(input => !input.disabled);
    if (firstAvailable) {
      firstAvailable.checked = true;
    }
  } 
  else if (duration === "2 hour") {
    const container = document.getElementById("edit-two-hour-slots");
    container.innerHTML = "";
    document.getElementById("edit-twoHoursOptions").style.display = "block";
    
    let hasAvailable = false;
    let firstAdded = null;
    
    allSlots["2 hour"].forEach(slot => {
      if (!reserved.includes(slot.value)) {
        const label = document.createElement('label');
        const input = document.createElement('input');
        input.type = 'radio';
        input.name = 'time';
        input.value = slot.value;
        input.required = true;
        
        label.appendChild(input);
        label.appendChild(document.createTextNode(' ' + slot.display));
        container.appendChild(label);
        container.appendChild(document.createElement('br'));
        
        if (!firstAdded) firstAdded = input;
        hasAvailable = true;
      }
    });
    
    if (!hasAvailable) {
      container.innerHTML = "<p>No available slots for selected date.</p>";
    } else if (firstAdded) {
      firstAdded.checked = true;
    }
  }
}
// Define ROOT for JavaScript use
const ROOT = "<?=ROOT?>";

function deleteReservation(reservationId) {
  // Show confirmation dialog
  if (confirm("Are you sure you want to cancel this reservation? This action cannot be undone.")) {
    // Show loading indicator (optional)
    const loadingDiv = document.createElement('div');
    loadingDiv.className = 'loading-overlay';
    loadingDiv.innerHTML = '<div class="spinner"></div><p>Cancelling reservation...</p>';
    document.body.appendChild(loadingDiv);
    
    // Redirect to the delete endpoint
    window.location.href = `${ROOT}/sportscaptain/reservation/deletereservation/${reservationId}`;
  }
}




function closeModal() {
  document.querySelectorAll('.modal').forEach(modal => modal.classList.add('hidden'));
  document.querySelector('.modal-overlay').classList.add('hidden');
}

</script>

</body>
</html>
