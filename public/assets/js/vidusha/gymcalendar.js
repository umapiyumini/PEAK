const calendar = document.getElementById("calendar");
const weekDisplay = document.getElementById("week-display");
const prevWeekBtn = document.getElementById("prev-week");
const nextWeekBtn = document.getElementById("next-week");
const modal = document.getElementById("modal");
const closeModal = document.getElementById("close-modal");
const confirmBookingBtn = document.getElementById("confirm-booking");
const numMembersInput = document.getElementById("num-members");

// Mock data for booking
const timeSlots = [
    "6:00 AM - 8:00 AM",
    "8:00 AM - 10:00 AM",
    "10:00 AM - 12:00 PM",
    "12:00 PM - 2:00 PM",
    "2:00 PM - 4:00 PM",
    "4:00 PM - 6:00 PM",
];

// Generate mock bookings with random details
const generateBookings = () =>
    timeSlots.map(() => ({
        booked: Math.floor(Math.random() * 21),
    }));

// Weekly booking data
let weeklyBookings = Array.from({ length: 7 }, generateBookings);

// Current date for the week
let currentDate = new Date();

// Get the start of the week (Sunday)
function getStartOfWeek(date) {
    const start = new Date(date);
    start.setDate(date.getDate() - date.getDay());
    return start;
}

// Format date as "DD-MM-YYYY"
function formatDate(date) {
    return `${date.getDate()}-${date.getMonth() + 1}-${date.getFullYear()}`;
}

// Render the calendar
function renderCalendar() {
    calendar.innerHTML = "";

    const startOfWeek = getStartOfWeek(currentDate);
    weekDisplay.innerText = `Week of ${formatDate(startOfWeek)}`;

    let table = `<table>
        <thead>
            <tr>
                <th>Time Slots</th>`;

    for (let i = 0; i < 7; i++) {
        const date = new Date(startOfWeek);
        date.setDate(startOfWeek.getDate() + i);
        table += `<th>${formatDate(date)}</th>`;
    }
    table += `</tr></thead><tbody>`;

    for (let i = 0; i < timeSlots.length; i++) {
        table += `<tr>
            <td class="time-slot">${timeSlots[i]}</td>`;

        for (let j = 0; j < 7; j++) {
            const booking = weeklyBookings[j][i];
            table += `
                <td class="booked-slot ${booking.booked >= 20 ? "booked-full" : ""}" 
                    onclick="showBookingModal(weeklyBookings[${j}][${i}], '${timeSlots[i]}')">
                    ${booking.booked} / 20
                </td>`;
        }

        table += `</tr>`;
    }

    table += `</tbody></table>`;
    calendar.innerHTML = table;
}

// Show modal for booking
function showBookingModal(slot, time) {
    const modalContent = document.getElementById("modal-content");
    modalContent.innerHTML = `
        <strong>Time Slot:</strong> ${time}<br>
        <label for="num-members">Number of Members:</label><br>
        <input type="number" id="num-members" name="num-members" min="1" placeholder="Enter number of members" required>
        <button id="confirm-booking">Confirm Booking</button>
    `;

    // Attach listener to the new Confirm button dynamically added
    document.getElementById("confirm-booking").addEventListener("click", function () {
        const numMembers = parseInt(document.getElementById("num-members").value.trim(), 10);
        if (!isNaN(numMembers) && numMembers > 0 && slot.booked + numMembers <= 20) {
            slot.booked += numMembers;
            alert(`Booking confirmed for ${numMembers} member(s) at ${time}`);
            modal.style.display = "none"; // Close modal
            renderCalendar(); // Refresh calendar
        } else if (slot.booked + numMembers > 20) {
            alert("This time slot cannot accommodate the requested number of members.");
        } else {
            alert("Please enter a valid number of members.");
        }
    });

    modal.style.display = "block"; // Display the modal
}


// Close the modal
closeModal.addEventListener("click", () => {
    modal.style.display = "none";
});

// Navigation for weeks
prevWeekBtn.addEventListener("click", () => {
    currentDate.setDate(currentDate.getDate() - 7);
    weeklyBookings = Array.from({ length: 7 }, generateBookings);
    renderCalendar();
});

nextWeekBtn.addEventListener("click", () => {
    currentDate.setDate(currentDate.getDate() + 7);
    weeklyBookings = Array.from({ length: 7 }, generateBookings);
    renderCalendar();
});

// Initial rendering
renderCalendar();
