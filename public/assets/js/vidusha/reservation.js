// Reserved time slots (example data)
const reservedTimeSlots = {
  "2023-10-15": ["08:00", "13:00"], // Example: Reserved slots for October 15, 2023
  "2023-10-16": ["10:00"]           // Example: Reserved slots for October 16, 2023
};

// All possible time slots
const allSlots = {
  "2 hour": [
    { value: "08:00", display: "08:00 - 10:00" },
    { value: "10:00", display: "10:00 - 12:00" },
    { value: "13:00", display: "13:00 - 15:00" },
    { value: "15:00", display: "15:00 - 17:00" }
  ]
};

// Function to switch tabs
function showTab(tabId) {
  document.getElementById('new-reservation-tab').style.display = (tabId === 'new-reservation') ? 'block' : 'none';
  document.getElementById('previous-reservations-tab').style.display = (tabId === 'previous-reservations') ? 'block' : 'none';

  document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
  document.querySelector(`.tab[onclick*="${tabId}"]`).classList.add('active');
}

// Function to update time slots based on date and duration
function updateTimeSlots() {
  const date = document.getElementById("date").value;
  const duration = document.getElementById("duration").value;

  // Hide all duration-specific sections
  document.getElementById("fullDayOptions").style.display = "none";
  document.getElementById("halfDayOptions").style.display = "none";
  document.getElementById("twoHoursOptions").style.display = "none";

  if (!date || !duration) return;

  const reserved = reservedTimeSlots[date] || [];

  if (duration === "full") {
    document.getElementById("fullDayOptions").style.display = reserved.includes("08:00") ? "none" : "block";
    if (!reserved.includes("08:00")) {
      document.querySelector('#fullDayOptions input[type="radio"]').checked = true;
    }
  } else if (duration === "half") {
    document.getElementById("halfDayOptions").style.display = "block";
    const radioButtons = document.querySelectorAll("#halfDayOptions input");

    let hasAvailable = false;
    radioButtons.forEach(input => {
      input.disabled = reserved.includes(input.value);
      input.checked = false; // Uncheck all initially

      if (!input.disabled) {
        hasAvailable = true;
        if (!document.querySelector('#halfDayOptions input:checked')) {
          input.checked = true; // Auto-select first available
        }
      }
    });

    if (!hasAvailable) {
      document.getElementById("halfDayOptions").innerHTML = "<p>No available half-day slots.</p>";
    }
  } else if (duration === "2 hour") {
    const container = document.getElementById("two-hour-slots");
    container.innerHTML = ""; // Clear previous slots
    document.getElementById("twoHoursOptions").style.display = "block";

    let hasAvailable = false;
    allSlots["2 hour"].forEach(slot => {
      if (!reserved.includes(slot.value)) {
        hasAvailable = true;
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

        if (!document.querySelector('#two-hour-slots input:checked')) {
          input.checked = true; // Auto-select first available
        }
      }
    });

    if (!hasAvailable) {
      container.innerHTML = "<p>No available 2-hour slots.</p>";
    }
  }
}

// Function to check availability of slots for a specific date
function checkAvailability() {
  const date = document.getElementById("date-check").value;
  const resultsDiv = document.getElementById("availability-results");
  const courtName = document.getElementById("facility-check").value;

  if (!date) {
    resultsDiv.innerHTML = "<p>Please select a valid date.</p>";
    return;
  }

  const formattedDate = new Date(date).toLocaleDateString();
  const reserved = reservedTimeSlots[date] || [];

  let html = `<h3>${courtName} - ${formattedDate}</h3>`;

  if (reserved.length === 0) {
    html += "<p>All time slots are available!</p>";
  } else {
    html += "<p>Available time slots:</p>";

    // Check 2-hour slots
    html += "<p><strong>2-Hour Slots:</strong></p><ul>";
    const twoHourSlots = allSlots["2 hour"];
    let hasTwoHourSlots = false;
    twoHourSlots.forEach(slot => {
      if (!reserved.includes(slot.value)) {
        hasTwoHourSlots = true;
        html += `<li>${slot.display}</li>`;
      }
    });
    if (!hasTwoHourSlots) html += "<li>None available</li>";
    html += "</ul>";

    // Check half-day slots
    html += "<p><strong>Half-Day Slots:</strong></p><ul>";
    if (!reserved.includes("08:00")) {
      html += "<li>Morning (08:00 - 12:00)</li>";
    }
    if (!reserved.includes("13:00")) {
      html += "<li>Afternoon (13:00 - 18:00)</li>";
    }
    if (reserved.includes("08:00") && reserved.includes("13:00")) {
      html += "<li>None available</li>";
    }
    html += "</ul>";

    // Check full-day slot
    html += "<p><strong>Full-Day Slot:</strong></p><ul>";
    if (!reserved.includes("08:00")) {
      html += "<li>Full Day (08:00 - 18:00)</li>";
    } else {
      html += "<li>Not available</li>";
    }
    html += "</ul>";
  }

  resultsDiv.innerHTML = html;
}

// Attach event listeners
document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("date").addEventListener("change", updateTimeSlots);
  document.getElementById("duration").addEventListener("change", updateTimeSlots);

  document.getElementById("date-check").addEventListener("change", checkAvailability);
  document.getElementById("facility-check").addEventListener("change", checkAvailability);
});