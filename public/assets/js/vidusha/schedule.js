document.addEventListener("DOMContentLoaded", () => {
  const slots = document.querySelectorAll(".day-slot");

  // Toggle selection for slots and mark the activity type (match or practice)
  slots.forEach(slot => {
    slot.addEventListener("click", () => {
      slot.classList.toggle("selected");
      // Toggle color based on the type (match or practice)
      if (slot.classList.contains("selected")) {
        if (slot.getAttribute("data-type") === "match") {
          slot.style.backgroundColor = "red";  // Red for match
        } else if (slot.getAttribute("data-type") === "practice") {
          slot.style.backgroundColor = "green";  // Green for practice
        }
      } else {
        slot.style.backgroundColor = "";  // Remove the color when deselected
      }
    });
  });
  // Temporarily pre-select some slots when the page loads
  function preselectSlots() {
    const preselectedSlots = [
      { day: "Monday", time: "10:00 AM", type: "match" },
      { day: "Tuesday", time: "2:00 PM", type: "practice" },
      { day: "Wednesday", time: "4:00 PM", type: "match" }
    ];

    preselectedSlots.forEach(preselectedSlot => {
      const slot = Array.from(slots).find(s => 
        s.getAttribute("data-day") === preselectedSlot.day &&
        s.getAttribute("data-time") === preselectedSlot.time &&
        s.getAttribute("data-type") === preselectedSlot.type
      );
      
      if (slot) {
        slot.classList.add("selected");
        if (slot.getAttribute("data-type") === "match") {
          slot.style.backgroundColor = "red";  // Red for match
        } else if (slot.getAttribute("data-type") === "practice") {
          slot.style.backgroundColor = "green";  // Green for practice
        }
      }
    });
  }
  preselectSlots();

  // Save button action
  document.getElementById("save-btn").addEventListener("click", () => {
    const selectedSlots = [];
    document.querySelectorAll(".day-slot.selected").forEach(slot => {
      selectedSlots.push({
        day: slot.getAttribute("data-day"),
        time: slot.getAttribute("data-time"),
        type: slot.getAttribute("data-type")  // Include the type (match/practice)
      });
    });

    if (selectedSlots.length > 0) {
      console.log("Selected Slots:", selectedSlots);
      alert("Schedule saved successfully!");
    } else {
      alert("No slots selected. Please select at least one time slot.");
    }
  });

  // Handle make, update, and cancel actions
  document.getElementById("make-booking-btn").addEventListener("click", () => {
    const selectedSlots = document.querySelectorAll(".day-slot.selected");
    if (selectedSlots.length > 0) {
      alert("Booking has been made for selected slots!");
    } else {
      alert("Please select at least one slot to make a booking.");
    }
  });

  document.getElementById("update-booking-btn").addEventListener("click", () => {
    const selectedSlots = document.querySelectorAll(".day-slot.selected");
    if (selectedSlots.length > 0) {
      alert("Booking has been updated for selected slots!");
    } else {
      alert("Please select at least one slot to update the booking.");
    }
  });

  document.getElementById("cancel-booking-btn").addEventListener("click", () => {
    const selectedSlots = document.querySelectorAll(".day-slot.selected");
    if (selectedSlots.length > 0) {
      alert("Booking has been canceled for selected slots!");
    } else {
      alert("Please select at least one slot to cancel the booking.");
    }
  });
});
