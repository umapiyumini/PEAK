const calendarDates = document.getElementById('dates');
const timeSlotsContainer = document.getElementById('time-slots');
const reservationModal = document.getElementById('reservationModal');
const closeModalButton = document.querySelector('.close-button');
const selectedDateInput = document.getElementById('selectedDate');
const selectedTimeInput = document.getElementById('selectedTime');
const reservationForm = document.getElementById('reservationForm');
const reservationList = document.getElementById('reservation-list');
const categoryField = document.getElementById('category');
let selectedDate = null;

// Sample time slots for each category
const categoryTimeSlots = {
    cricket: ['09:00 AM - 10:00 AM', '10:00 AM - 11:00 AM', '11:00 AM - 12:00 PM', '01:00 PM - 02:00 PM', '02:00 PM - 03:00 PM', '03:00 PM - 04:00 PM', '04:00 PM - 05:00 PM'],
    hockey: ['09:00 AM - 10:00 AM', '10:00 AM - 11:00 AM', '11:00 AM - 12:00 PM', '01:00 PM - 02:00 PM', '02:00 PM - 03:00 PM', '03:00 PM - 04:00 PM', '04:00 PM - 05:00 PM'],
    rugger: ['09:00 AM - 10:00 AM', '10:00 AM - 11:00 AM', '11:00 AM - 12:00 PM', '01:00 PM - 02:00 PM', '02:00 PM - 03:00 PM', '03:00 PM - 04:00 PM', '04:00 PM - 05:00 PM'],
    elle: ['09:00 AM - 10:00 AM', '10:00 AM - 11:00 AM', '11:00 AM - 12:00 PM', '01:00 PM - 02:00 PM', '02:00 PM - 03:00 PM', '03:00 PM - 04:00 PM', '04:00 PM - 05:00 PM'],
    fullground: ['09:00 AM - 10:00 AM', '10:00 AM - 11:00 AM', '11:00 AM - 12:00 PM', '01:00 PM - 02:00 PM', '02:00 PM - 03:00 PM', '03:00 PM - 04:00 PM', '04:00 PM - 05:00 PM'],
};

// Store reservations by date
const reservations = {
    "2024-12-05": [
        { time: "09:00 AM - 10:00 AM", reason: "Football Match", category: "Rugger/Football Court", description: "Friendly match with local teams", id: 1 },
        { time: "02:00 PM - 03:00 PM", reason: "Practice", category: "Hockey Court", description: "Team practice session", id: 2 }
    ],
};

// Show previous reservations
function showPreviousReservations() {
    reservationList.innerHTML = '';

    const reservationDates = Object.keys(reservations);
    if (reservationDates.length === 0) {
        const noReservationsMessage = document.createElement('p');
        noReservationsMessage.textContent = 'No previous reservations.';
        reservationList.appendChild(noReservationsMessage);
        return;
    }

    reservationDates.forEach(date => {
        const dateHeader = document.createElement('div');
        dateHeader.classList.add('reservation-date-header');
        dateHeader.textContent = `Reservations for ${date}`;
        reservationList.appendChild(dateHeader);

        reservations[date].forEach(reservation => {
            const reservationDiv = document.createElement('div');
            reservationDiv.classList.add('reservation-item');
            reservationDiv.innerHTML = `
                <div>
                    <strong>${reservation.time}</strong><br>
                    <span>${reservation.reason}</span><br>
                    <span>${reservation.category}</span><br>
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


let currentReservationId = null;

function editReservation(reservationId, date) {
    const reservation = reservations[date].find(r => r.id === reservationId);
    currentReservationId = reservationId;
    selectedDate = date;
    selectedDateInput.value = selectedDate;
    selectedTimeInput.value = reservation.time;
    document.getElementById('title').value = reservation.reason;
    document.getElementById('description').value = reservation.description;
    categoryField.value = reservation.category;

    selectedDateInput.disabled = true;
    selectedTimeInput.disabled = true;

    openModal();
}

reservationForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const title = document.getElementById('title').value;
    const description = document.getElementById('description').value;
    const time = selectedTimeInput.value;
    const category = categoryField.value;

    if (currentReservationId) {
        const reservationIndex = reservations[selectedDate].findIndex(
            r => r.id === currentReservationId
        );
        if (reservationIndex > -1) {
            reservations[selectedDate][reservationIndex].reason = title;
            reservations[selectedDate][reservationIndex].description = description;
        }
    } else {
        if (!reservations[selectedDate]) {
            reservations[selectedDate] = [];
        }
        const newReservation = {
            time,
            reason: title,
            description,
            category,
            id: new Date().getTime(),
        };
        reservations[selectedDate].push(newReservation);
    }

    showPreviousReservations();
    showAvailableTimeSlots(selectedDate);
    clearFormFields();
    currentReservationId = null;
    selectedDateInput.disabled = false;
    selectedTimeInput.disabled = false;
    reservationModal.style.display = 'none';
});

function clearFormFields() {
    document.getElementById('title').value = '';
    document.getElementById('description').value = '';
    selectedTimeInput.value = '';
}

function cancelReservation(reservationId, date) {
    const index = reservations[date].findIndex(r => r.id === reservationId);
    if (index > -1) {
        reservations[date].splice(index, 1);
        showAvailableTimeSlots(date);
        showPreviousReservations();
    }
}

function openModal() {
    reservationModal.style.display = 'flex';
}

closeModalButton.addEventListener('click', () => {
    reservationModal.style.display = 'none';
});

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

        if (formattedDate === todayDate) {
            dateDiv.classList.add('today');
        }

        if (formattedDate === selectedDate) {
            dateDiv.classList.add('selected-date');
        }

        dateDiv.addEventListener('click', () => {
            selectedDate = formattedDate;
            selectedDateInput.value = selectedDate;
            showAvailableTimeSlots(formattedDate);

            document.querySelectorAll('.date').forEach(date => date.classList.remove('selected-date'));
            dateDiv.classList.add('selected-date');
        });

        calendarDates.appendChild(dateDiv);
    }
}

function showAvailableTimeSlots(date) {
    selectedDate = date;
    selectedDateInput.value = date;
    timeSlotsContainer.innerHTML = '';

    const reservedTimes = reservations[date]?.map(reservation => reservation.time) || [];
    const category = document.querySelector('.category-button.active')?.dataset.category || 'cricket';
    const timeSlots = categoryTimeSlots[category] || [];

    timeSlots.forEach(slot => {
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

    if (timeSlots.length === 0) {
        timeSlotsContainer.innerHTML = '<p>No available time slots for this category.</p>';
    }
}

let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();
function showPreviousMonth() {
    if (currentMonth === 0) {
        currentMonth = 11;  // December
        currentYear--;  // Decrease the year
    } else {
        currentMonth--;  // Decrease the month
    }
    populateCalendar();  // Re-render the calendar for the previous month
}

// Add functionality to navigate to the next month
function showNextMonth() {
    if (currentMonth === 11) {
        currentMonth = 0;  // January
        currentYear++;  // Increase the year
    } else {
        currentMonth++;  // Increase the month
    }
    populateCalendar();  // Re-render the calendar for the next month
}

// Attach event listeners to the navigation buttons
const prevButton = document.getElementById('prev-month');
const nextButton = document.getElementById('next-month');

prevButton.addEventListener('click', showPreviousMonth);
nextButton.addEventListener('click', showNextMonth);

// Call the function to populate the calendar initially
populateCalendar();

const today = new Date();
const todayDate = today.toISOString().split('T')[0];
selectedDate = todayDate;
selectedDateInput.value = todayDate;
showAvailableTimeSlots(todayDate);

document.querySelectorAll('.category-button').forEach(button => {
    button.addEventListener('click', () => {
        document.querySelectorAll('.category-button').forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
        categoryField.value = button.dataset.category;
        showAvailableTimeSlots(selectedDate);
    });
});

function deleteOldReservations() {
    const today = new Date().toISOString().split('T')[0];

    Object.keys(reservations).forEach(date => {
        if (date < today) {
            delete reservations[date]; // Remove reservations for past dates
        }
    });

    showPreviousReservations(); // Refresh the reservation list
}
