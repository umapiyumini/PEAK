
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
