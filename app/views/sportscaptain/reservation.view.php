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
            <label><input type="radio" name="time" value="08:00"> 08:00 - 12:00</label>
            <label><input type="radio" name="time" value="13:00"> 13:00 - 17:00</label>
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

        <input type="hidden" name="status" value="confirmed">

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
<div id="editReservationModal" class="modal" style="display: none;">
  <div class="modal-content">
    <span class="close" onclick="closeEditModal()">&times;</span>
    <h2>Edit Reservation</h2>
    <form id="edit-reservation-form" action="<?=ROOT?>/sportscaptain/reservation/editreservation" method="POST">
      <input type="hidden" name="reservationid" id="edit-reservationid">
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
          <label><input type="radio" name="time" value="08:00"> 08:00 - 12:00</label>
          <label><input type="radio" name="time" value="13:00"> 13:00 - 17:00</label>
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
      { value: "13:00", display: "13:00 - 15:00" },
      { value: "15:00", display: "15:00 - 17:00" }
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
    
    // Get reserved slots for selected date
    const reserved = reservedTimeSlots[date] || [];
    const reservedTimes = reserved.map(r => r.time);
    
    // Clear containers
    document.getElementById("fullDayOptions").innerHTML = "";
    document.getElementById("halfDayOptions").innerHTML = "";
    document.getElementById("two-hour-slots").innerHTML = "";
    
    // First, determine all unavailable times from any source
    let blockedTimes = [...reservedTimes]; // Start with system-reserved times
    
    // Get all selected times across all duration types
    const selectedTime = document.querySelector('input[name="time"]:checked');
    if (selectedTime) {
        const selectedValue = selectedTime.value;
        
        // If a time is selected, block appropriate conflicting times
        if (selectedValue === 'full-day') {
            // Full day blocks all other options
            blockedTimes = [...blockedTimes, "08:00", "10:00", "13:00", "15:00"];
        } 
        else if (selectedValue === '08:00') {
            // Morning half-day blocks full day and morning 2-hour slots
            blockedTimes = [...blockedTimes, "08:00", "10:00", "full-day"];
        } 
        else if (selectedValue === '13:00') {
            // Afternoon half-day blocks full day and afternoon 2-hour slots
            blockedTimes = [...blockedTimes, "13:00", "15:00", "full-day"];
        }
        else {
            // If a 2-hour slot is selected
            const timeValue = selectedValue;
            
            // Block full day regardless of which 2-hour slot is selected
            blockedTimes.push("full-day");
            
            // Block the appropriate half-day depending on time
            if (["08:00", "10:00"].includes(timeValue)) {
                blockedTimes.push("08:00"); // Block morning half-day
            }
            if (["13:00", "15:00"].includes(timeValue)) {
                blockedTimes.push("13:00"); // Block afternoon half-day
            }
        }
    }
    
    // Now render options based on current selection and blocked times
    if (duration === "full") {
        const container = document.getElementById("fullDayOptions");
        
        if (!blockedTimes.includes("full-day")) {
            const label = document.createElement('label');
            const input = document.createElement('input');
            input.type = 'radio';
            input.name = 'time';
            input.value = 'full-day';
            label.appendChild(input);
            label.appendChild(document.createTextNode(' Full Day (8:00 - 17:00)'));
            container.appendChild(label);
        }
    } 
    else if (duration === "half") {
        const container = document.getElementById("halfDayOptions");
        
        // Morning option
        if (!blockedTimes.includes("08:00")) {
            const morningLabel = document.createElement('label');
            const morningInput = document.createElement('input');
            morningInput.type = 'radio';
            morningInput.name = 'time';
            morningInput.value = '08:00';
            morningLabel.appendChild(morningInput);
            morningLabel.appendChild(document.createTextNode(' Morning (8:00 - 12:00)'));
            container.appendChild(morningLabel);
            container.appendChild(document.createElement('br'));
        }
        
        // Afternoon option
        if (!blockedTimes.includes("13:00")) {
            const afternoonLabel = document.createElement('label');
            const afternoonInput = document.createElement('input');
            afternoonInput.type = 'radio';
            afternoonInput.name = 'time';
            afternoonInput.value = '13:00';
            afternoonLabel.appendChild(afternoonInput);
            afternoonLabel.appendChild(document.createTextNode(' Afternoon (13:00 - 17:00)'));
            container.appendChild(afternoonLabel);
        }
    } 
    else if (duration === "2 hour") {
        const container = document.getElementById("two-hour-slots");
        
        // Only show 2-hour slots that aren't blocked
        allSlots["2 hour"].forEach(slot => {
            if (!blockedTimes.includes(slot.value)) {
                const label = document.createElement('label');
                const input = document.createElement('input');
                input.type = 'radio';
                input.name = 'time';
                input.value = slot.value;
                label.appendChild(input);
                label.appendChild(document.createTextNode(' ' + slot.display));
                container.appendChild(label);
                container.appendChild(document.createElement('br'));
            }
        });
    }
    
    // Add event listeners to all time slot inputs
    document.querySelectorAll('input[name="time"]').forEach(input => {
        // Remove existing listeners first to prevent duplicates
        input.removeEventListener('change', updateTimeSlots);
        // Add new listener
        input.addEventListener('change', updateTimeSlots);
    });
}

// Make sure to call updateTimeSlots when the duration changes
document.getElementById("duration").addEventListener('change', function() {
    // Clear any existing time selection when changing duration
    const selectedTime = document.querySelector('input[name="time"]:checked');
    if (selectedTime) {
        selectedTime.checked = false;
    }
    updateTimeSlots();
});

// Call initially to set up
updateTimeSlots();


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
  
  // Get reserved slots for the selected date, ensure it's an array
  let reserved = [];
  if (reservedTimeSlots[date]) {
    // If it's already an array
    if (Array.isArray(reservedTimeSlots[date])) {
      reserved = reservedTimeSlots[date];
    } 
    // If it's an object with section keys
    else if (typeof reservedTimeSlots[date] === 'object') {
      // Flatten all sections into a single array
      reserved = Object.values(reservedTimeSlots[date]).flat();
    }
  }
  
  // Extract just the start times from reserved slots safely
  const reservedStartTimes = [];
  if (Array.isArray(reserved)) {
    for (let i = 0; i < reserved.length; i++) {
      if (reserved[i] && reserved[i].time) {
        reservedStartTimes.push(reserved[i].time);
      }
    }
  }
  
  // Define all possible time slots
  const allTimeSlots = {
    "2 hours": [
      { start: "08:00", display: "08:00 - 10:00" },
      { start: "10:00", display: "10:00 - 12:00" },
      { start: "13:00", display: "13:00 - 15:00" },
      { start: "15:00", display: "15:00 - 17:00" }
    ],
    "Half Day": [
      { start: ["08:00", "10:00"], display: "Morning (08:00 - 12:00)" },
      { start: ["13:00", "15:00"], display: "Afternoon (13:00 - 17:00)" }
    ],
    "Full Day": {
      start: ["08:00", "10:00", "13:00", "15:00"],
      display: "Full Day (08:00 - 18:00)"
    }
  };
  
  // Start building HTML
  let html = `<h3>${courtName} - ${formattedDate}</h3>`;
  
  // Check if any slots are reserved
  if (reservedStartTimes.length === 0) {
    html += "<p>All time slots are available!</p>";
  } else {
    html += "<p>Some time slots are already reserved.</p>";
    html += "<p>Reserved times: " + reservedStartTimes.join(", ") + "</p>";
  }
  
  // Add available 2-hour slots
  html += "<p><strong>2-Hour Slots:</strong></p><ul>";
  let available2Hour = false;
  
  allTimeSlots["2 hours"].forEach(slot => {
    if (!reservedStartTimes.includes(slot.start)) {
      html += `<li>${slot.display}</li>`;
      available2Hour = true;
    }
  });
  
  if (!available2Hour) {
    html += "<li>No 2-hour slots available</li>";
  }
  html += "</ul>";
  
  // Add available half-day slots
  html += "<p><strong>Half-Day Slots:</strong></p><ul>";
  let halfDayAvailable = false;
  
  allTimeSlots["Half Day"].forEach(slot => {
    // Check if any of the times in this half-day slot are reserved
    const isSlotAvailable = !slot.start.some(time => reservedStartTimes.includes(time));
    
    if (isSlotAvailable) {
      html += `<li>${slot.display}</li>`;
      halfDayAvailable = true;
    }
  });
  
  if (!halfDayAvailable) {
    html += "<li>No half-day slots available</li>";
  }
  html += "</ul>";
  
  // Add available full-day slot
  html += "<p><strong>Full-Day Slot:</strong></p><ul>";
  
  // Check if any of the times required for a full day are reserved
  const isFullDayAvailable = !allTimeSlots["Full Day"].start.some(time => 
    reservedStartTimes.includes(time)
  );
  
  if (isFullDayAvailable) {
    html += `<li>${allTimeSlots["Full Day"].display}</li>`;
  } else {
    html += "<li>No full-day slots available</li>";
  }
  html += "</ul>";
  
  resultsDiv.innerHTML = html;
}
function editReservation(reservationId) {
    // Find the reservation data from the PHP-rendered JSON
    const reservations = JSON.parse('<?= json_encode($data['allreservations'] ?? []); ?>');
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

function updateTimeSlots() {
  const date = document.getElementById("date").value;
  const duration = document.getElementById("duration").value;

  // Hide all time slot options first
  document.getElementById("fullDayOptions").style.display = "none";
  document.getElementById("halfDayOptions").style.display = "none";
  document.getElementById("twoHoursOptions").style.display = "none";

  if (!date || !duration) return;

  // Get reserved slots for the selected date
  const reserved = reservedTimeSlots[date] || [];
  
  // Process available slots based on duration
  if (duration === "full") {
    // For full day booking, check if 8:00 AM is available
    document.getElementById("fullDayOptions").style.display = "block";
    const fullDayInput = document.querySelector('#fullDayOptions input[type="radio"]');
    fullDayInput.disabled = reserved.includes("08:00");
    
    if (!fullDayInput.disabled) {
      fullDayInput.checked = true;
    } else {
      fullDayInput.checked = false;
      document.getElementById("fullDayOptions").innerHTML = "<p>No full day slots available for selected date.</p>";
    }
  } 
  else if (duration === "half") {
    document.getElementById("halfDayOptions").style.display = "block";
    const morningInput = document.querySelector('#halfDayOptions input[value="08:00"]');
    const afternoonInput = document.querySelector('#halfDayOptions input[value="13:00"]');
    
    // Check if morning slot is available
    morningInput.disabled = reserved.includes("08:00");
    if (morningInput.disabled) {
      morningInput.checked = false;
    }
    
    // Check if afternoon slot is available
    afternoonInput.disabled = reserved.includes("13:00");
    if (afternoonInput.disabled) {
      afternoonInput.checked = false;
    }
    
    // Auto-select first available option
    if (!morningInput.disabled) {
      morningInput.checked = true;
    } else if (!afternoonInput.disabled) {
      afternoonInput.checked = true;
    }
    
    // If no slots available, show message
    if (morningInput.disabled && afternoonInput.disabled) {
      document.getElementById("halfDayOptions").innerHTML = "<p>No half day slots available for selected date.</p>";
    }
  } 
  else if (duration === "2 hour") {
    const container = document.getElementById("two-hour-slots");
    container.innerHTML = "";
    document.getElementById("twoHoursOptions").style.display = "block";
    
    let hasAvailable = false;
    let firstAdded = null;
    
    // Process each 2-hour slot
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
      container.innerHTML = "<p>No 2-hour slots available for selected date.</p>";
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
