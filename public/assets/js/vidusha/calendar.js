const calendar = document.getElementById("calendar");
const weekDisplay = document.getElementById("week-display");
const prevWeekBtn = document.getElementById("prev-week");
const nextWeekBtn = document.getElementById("next-week");
const modal = document.getElementById("modal");
const modalContent = document.getElementById("modal-content");
const closeModal = document.getElementById("close-modal");

// Mock data for booking
const timeSlots = [
   "6:00 AM - 8:00 AM",
    "8:00 AM - 10:00 AM",
    "11:00 AM - 1:00 AM",
    "1:00 AM - 3:00 AM",
    "3:00 AM - 5:00 AM",
    "5:00 AM - 7:00 PM",
];

// Generate mock bookings with random details
const generateBookings = () =>
    timeSlots.map(() => ({
        booked: Math.floor(Math.random() * 21),
        members: Array.from({ length: Math.floor(Math.random() * 21) }, (_, i) => `Member ${i + 1}`),
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

    // Create table structure
    let table = `<table>
        <thead>
            <tr>
                <th>Time Slots</th>`;
    
    // Add each day of the week to the header
    for (let i = 0; i < 7; i++) {
        const date = new Date(startOfWeek);
        date.setDate(startOfWeek.getDate() + i);
        table += `<th>${formatDate(date)}</th>`;
    }
    table += `</tr></thead><tbody>`;

    // Add rows for each time slot
    for (let i = 0; i < timeSlots.length; i++) {
        table += `<tr>
            <td class="time-slot">${timeSlots[i]}</td>`;
        
        for (let j = 0; j < 7; j++) {
            const booking = weeklyBookings[j][i];
            table += `
                <td class="booked-slot ${booking.booked >= 20 ? "booked-full" : ""}" 
                    onclick="showBookingDetails(weeklyBookings[${j}][${i}], '${timeSlots[i]}')">
                    ${booking.booked} / 20
                </td>`;
        }

        table += `</tr>`;
    }

    table += `</tbody></table>`;
    calendar.innerHTML = table;
}

// Show modal with booking details
function showBookingDetails(slot, time) {
    modalContent.innerHTML = `
        <strong>Time Slot:</strong> ${time}<br>
        <strong>Booked Members:</strong><br>
        ${slot.members.length > 0 ? slot.members.join("<br>") : "No members booked"}
    `;
    modal.style.display = "block";
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
