  // Sample data structure for bookings
  let bookings = {
    '2024-11-27': [
        { id: 1, studentId: '2022/IS/34', studentName: 'Kevin Liam', time: '17:00' },
        { id: 2, studentId: '2020/s/321', studentName: 'Jane Smith', time: '17:00' }
    ]
};

let settings = {
    studentLimit: 20,
    startTime: '17:00',
    endTime: '19:00'
};

// Calendar generation
function generateCalendar(year, month) {
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const grid = document.getElementById('calendarGrid');
    grid.innerHTML = '';

    // Add day headers
    const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    days.forEach(day => {
        const dayHeader = document.createElement('div');
        dayHeader.textContent = day;
        dayHeader.style.fontWeight = 'bold';
        grid.appendChild(dayHeader);
    });

    // Add empty cells for days before first of month
    for (let i = 0; i < firstDay.getDay(); i++) {
        grid.appendChild(document.createElement('div'));
    }

    // Add days of month
    for (let day = 1; day <= lastDay.getDate(); day++) {
        const dayElement = document.createElement('div');
        dayElement.className = 'calendar-day';
        dayElement.textContent = day;

        const dateString = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        if (bookings[dateString]) {
            dayElement.classList.add('has-bookings');
            const count = document.createElement('span');
            count.className = 'booking-count';
            count.textContent = bookings[dateString].length;
            dayElement.appendChild(count);
        }

        dayElement.onclick = () => selectDate(dateString);
        grid.appendChild(dayElement);
    }
}

function selectDate(dateString) {
    document.querySelectorAll('.calendar-day').forEach(day => day.classList.remove('selected'));
    const selectedDay = Array.from(document.querySelectorAll('.calendar-day'))
        .find(day => day.textContent.trim() === new Date(dateString).getDate().toString());
    if (selectedDay) selectedDay.classList.add('selected');

    document.getElementById('selectedDate').textContent = new Date(dateString).toLocaleDateString();
    displayBookings(dateString);
}

function displayBookings(dateString) {
    const container = document.getElementById('bookingsContainer');
    container.innerHTML = '';

    if (!bookings[dateString]) {
        container.innerHTML = '<p>No bookings for this date</p>';
        return;
    }

    bookings[dateString].forEach(booking => {
        const bookingElement = document.createElement('div');
        bookingElement.className = 'booking-item';
        bookingElement.innerHTML = `
            <div>
                <strong>${booking.studentName}</strong> (ID: ${booking.studentId})
                <span>Time: ${booking.time}</span>
            </div>
            <button class="btn btn-delete" onclick="cancelBooking('${dateString}', ${booking.id})">Cancel</button>
        `;
        container.appendChild(bookingElement);
    });
}

function saveSettings() {
    settings.studentLimit = document.getElementById('studentLimit').value;
    settings.startTime = document.getElementById('startTime').value;
    settings.endTime = document.getElementById('endTime').value;
    alert('Settings saved successfully!');
}

function cancelBooking(dateString, bookingId) {
    if (confirm('Are you sure you want to cancel this booking?')) {
        bookings[dateString] = bookings[dateString].filter(b => b.id !== bookingId);
        displayBookings(dateString);
        generateCalendar(new Date().getFullYear(), new Date().getMonth());
    }
}

function previousMonth() {
    const currentMonth = document.getElementById('currentMonth').textContent;
    const [month, year] = currentMonth.split(' ');
    const date = new Date(`${month} 1, ${year}`);
    date.setMonth(date.getMonth() - 1);
    document.getElementById('currentMonth').textContent = 
        date.toLocaleString('default', { month: 'long', year: 'numeric' });
    generateCalendar(date.getFullYear(), date.getMonth());
}

function nextMonth() {
    const currentMonth = document.getElementById('currentMonth').textContent;
    const [month, year] = currentMonth.split(' ');
    const date = new Date(`${month} 1, ${year}`);
    date.setMonth(date.getMonth() + 1);
    document.getElementById('currentMonth').textContent = 
        date.toLocaleString('default', { month: 'long', year: 'numeric' });
    generateCalendar(date.getFullYear(), date.getMonth());
}

// Initialize calendar
generateCalendar(new Date().getFullYear(), new Date().getMonth());
selectDate('2024-11-27');