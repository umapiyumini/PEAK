

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

    // Add empty cells for days before the first of the month
    for (let i = 0; i < firstDay.getDay(); i++) {
        grid.appendChild(document.createElement('div'));
    }

    // Add days of the month
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

function displayBookings(dateString) {
    const container = document.getElementById('bookingsContainer');
    container.innerHTML = '';

    // const bookingsForDate = bookings.filter(b => b.booking_date === dateString);
    const bookingsForDate = bookings.filter(b => {
        const bookingDate = new Date(b.booking_date).toISOString().slice(0, 10);
        return bookingDate === dateString;
    });

    console.log(bookingsForDate);

    if (!bookingsForDate || bookingsForDate.length === 0) {
        container.innerHTML = '<p>No bookings for this date</p>';
        return;
    }

    bookingsForDate.forEach(booking => {
        const bookingElement = document.createElement('div');
        bookingElement.className = 'booking-item';
        
        bookingElement.innerHTML = `
            <div>
                <strong>${booking.name}</strong> (ID: ${booking.user_id})
                <span>Time: ${booking.booking_time}</span>
            </div>
            <button class="btn btn-delete" onclick="cancelBooking('${dateString}', ${booking.id})">Cancel</button>
        `;
        container.appendChild(bookingElement);
    });
}
// Initialize calendar
const today = new Date();
generateCalendar(today.getFullYear(), today.getMonth());
selectDate('2024-11-27');
function cancelBooking(bookingId) {
    if (confirm('Are you sure you want to cancel this booking?')) {
        window.location.href = `pool/cancelBooking/${bookingId}`;
    }
}