const calendarDates = document.getElementById('dates');
const timeSlotsContainer = document.getElementById('time-slots');
const reservationModal = document.getElementById('reservationModal');
const closeModalButton = document.querySelector('.close-button');
const selectedDateInput = document.getElementById('selectedDate');
const selectedTimeInput = document.getElementById('selectedTime');
const reservationForm = document.getElementById('reservationForm');
const reservationList = document.getElementById('reservation-list');
let selectedDate = null;

// Sample time slots for demonstration
const timeSlots = [
    '09:00 AM - 10:00 AM',
    '10:00 AM - 11:00 AM',
    '11:00 AM - 12:00 PM',
    '01:00 PM - 02:00 PM',
    '02:00 PM - 03:00 PM',
    '03:00 PM - 04:00 PM',
    '04:00 PM - 05:00 PM',
];

// Store reservations by date
const reservations = {
    "2024-11-25": [
        { time: "09:00 AM - 10:00 AM", reason: "Football Match", description: "Friendly match with local teams", id: 1 },
        { time: "02:00 PM - 03:00 PM", reason: "Practice", description: "Team practice session", id: 2 }
    ],
};

// Show previous reservations with dates
function showPreviousReservations() {
    reservationList.innerHTML = '';
    Object.keys(reservations).forEach(date => {
        // Create a header with the date for each reservation
        const dateHeader = document.createElement('div');
        dateHeader.classList.add('reservation-date-header');
        dateHeader.textContent = `Reservations for ${date}`;
        reservationList.appendChild(dateHeader);

        // For each reservation, display the time, reason, description, and edit/cancel buttons
        reservations[date].forEach(reservation => {
            const reservationDiv = document.createElement('div');
            reservationDiv.classList.add('reservation-item');
            reservationDiv.innerHTML = `
                <div>
                    <strong>${reservation.time}</strong><br>
                    <span>${reservation.reason}</span><br>
                    <span>${reservation.description}</span>
                </div>
                <div>
                    <button class="edit-button" onclick="editReservation(${reservation.id}, '${date}')">Edit</button>
                    <button onclick="cancelReservation(${reservation.id}, '${date}')">Cancel</button>
                </div>
            `;
            reservationList.appendChild(reservationDiv);
        });
    });
}

let currentReservationId = null; // To store the ID of the reservation being edited

// Edit reservation
function editReservation(reservationId, date) {
    const reservation = reservations[date].find(r => r.id === reservationId);
    currentReservationId = reservationId; // Set the ID of the reservation being edited
    selectedDate = date;
    selectedDateInput.value = selectedDate;
    selectedTimeInput.value = reservation.time;
    document.getElementById('title').value = reservation.reason;
    document.getElementById('description').value = reservation.description;

    // Disable the date and time inputs to prevent editing
    selectedDateInput.disabled = true;
    selectedTimeInput.disabled = true;

    openModal();
}

// Handle reservation form submit
reservationForm.addEventListener('submit', (e) => {
    e.preventDefault();

    // Collect form data
    const title = document.getElementById('title').value;
    const description = document.getElementById('description').value;
    const time = selectedTimeInput.value;

    if (currentReservationId) {
        // If editing an existing reservation
        const reservationIndex = reservations[selectedDate].findIndex(
            r => r.id === currentReservationId
        );
        if (reservationIndex > -1) {
            // Update the reservation details
            reservations[selectedDate][reservationIndex].reason = title;
            reservations[selectedDate][reservationIndex].description = description;
        }
    } else {
        // Add a new reservation
        if (!reservations[selectedDate]) {
            reservations[selectedDate] = [];
        }
        const newReservation = {
            time,
            reason: title,
            description,
            id: new Date().getTime(), // Unique ID based on current timestamp
        };
        reservations[selectedDate].push(newReservation);
    }

    // Update the displayed reservations
    showPreviousReservations();
    showAvailableTimeSlots(selectedDate);

    // Clear the form fields
    clearFormFields();

    // Reset edit mode
    currentReservationId = null;

    // Enable the date and time inputs for future use
    selectedDateInput.disabled = false;
    selectedTimeInput.disabled = false;

    // Close the modal
    reservationModal.style.display = 'none';
});

// Function to clear the reservation form details
function clearFormFields() {
    document.getElementById('title').value = '';
    document.getElementById('description').value = '';
    selectedTimeInput.value = '';
}

// Cancel reservation
function cancelReservation(reservationId, date) {
    // Find the reservation and remove it from the reservations list
    const index = reservations[date].findIndex(r => r.id === reservationId);
    if (index > -1) {
        reservations[date].splice(index, 1); // Remove the reservation

        // Update reservation list
        showAvailableTimeSlots(date);
        showPreviousReservations();
    }
}

// Open reservation modal
function openModal() {
    reservationModal.style.display = 'flex';
}

// Close reservation modal
closeModalButton.addEventListener('click', () => {
    reservationModal.style.display = 'none';
});

// Populate calendar with dates
function populateCalendar() {
    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
    const monthYearDiv = document.getElementById('month-year');
    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    monthYearDiv.textContent = `${monthNames[currentMonth]} ${currentYear}`;
    calendarDates.innerHTML = '';

    const today = new Date();
    const todayDate = today.toISOString().split('T')[0];

    for (let day = 1; day <= daysInMonth; day++) {
        const dateDiv = document.createElement('div');
        const formattedDate = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        dateDiv.textContent = day;
        dateDiv.classList.add('date');
        dateDiv.dataset.date = formattedDate;

        // Add today’s date styling
        if (formattedDate === todayDate) {
            dateDiv.classList.add('today');
        }

        // Add selected date styling
        if (formattedDate === selectedDate) {
            dateDiv.classList.add('selected-date');
        }

        dateDiv.addEventListener('click', () => {
            selectedDate = formattedDate;
            selectedDateInput.value = selectedDate;
            showAvailableTimeSlots(formattedDate);

            // Update styling for selected date
            document.querySelectorAll('.date').forEach(date => date.classList.remove('selected-date'));
            dateDiv.classList.add('selected-date');
        });

        calendarDates.appendChild(dateDiv);
    }
}

// Show available time slots for a selected date, excluding reserved slots
function showAvailableTimeSlots(date) {
    selectedDate = date;
    selectedDateInput.value = date;
    timeSlotsContainer.innerHTML = '';

    // Get the reserved time slots for the selected date
    const reservedTimes = reservations[date]?.map(reservation => reservation.time) || [];

    timeSlots.forEach(slot => {
        // Only show the time slot if it's not reserved
        if (!reservedTimes.includes(slot)) {
            const slotDiv = document.createElement('div');
            slotDiv.classList.add('time-slot');
            slotDiv.textContent = slot;
            slotDiv.addEventListener('click', () => {
                selectedTimeInput.value = slot;
                openModal();
            });
            timeSlotsContainer.appendChild(slotDiv);
        }
    });
}

// Initialize calendar
let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();
populateCalendar();

// Set today's date and show today's available time slots
const today = new Date();
const todayDate = today.toISOString().split('T')[0];
selectedDate = todayDate;
selectedDateInput.value = todayDate;
showAvailableTimeSlots(todayDate);

// Calendar navigation
document.getElementById('prev').addEventListener('click', () => {
    currentMonth--;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }
    populateCalendar();
});
document.getElementById('next').addEventListener('click', () => {
    currentMonth++;
    if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    populateCalendar();
});

document.querySelectorAll('.category-button').forEach(button => {
    button.addEventListener('click', () => {
        document.querySelectorAll('.category-button').forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
        const category = button.dataset.category;
        loadTimeSlots(category);  // Function to dynamically load time slots
    });
});

function loadTimeSlots(category) {
    // Fetch and populate time slots based on the selected category
}


// Show previous reservations
showPreviousReservations();
