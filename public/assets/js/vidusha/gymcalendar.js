document.addEventListener('DOMContentLoaded', function() {
    // Global variables
    const calendar = document.getElementById('calendar');
    const weekDisplay = document.getElementById('week-display');
    const modal = document.getElementById('modal');
    const modalContent = document.getElementById('modal-content');
    const bookingForm = document.getElementById('booking-form');
    const sportidInput = document.getElementById('sportid');
    const dateInput = document.getElementById('date');
    const startTimeInput = document.getElementById('starttime');
    const endTimeInput = document.getElementById('endtime');
    
    let currentDate = new Date();
    let currentWeekStart = getWeekStart(currentDate);
    
    // Initialize calendar
    updateWeekDisplay();
    renderCalendar();
    
    // Event listeners
    document.getElementById('prev-week').addEventListener('click', () => {
        currentWeekStart.setDate(currentWeekStart.getDate() - 7);
        updateWeekDisplay();
        renderCalendar();
    });
    
    document.getElementById('next-week').addEventListener('click', () => {
        currentWeekStart.setDate(currentWeekStart.getDate() + 7);
        updateWeekDisplay();
        renderCalendar();
    });
    
    document.getElementById('close-modal').addEventListener('click', closeModal);
    document.getElementById('cancel-booking').addEventListener('click', closeModal);
    
    bookingForm.addEventListener('submit', function(e) {
        e.preventDefault();
        saveBooking();
    });
    
    // Helper functions
    function getWeekStart(date) {
        const result = new Date(date);
        const day = result.getDay();
        result.setDate(result.getDate() - day + (day === 0 ? -6 : 1)); // Adjust to Monday
        return result;
    }
    
    function updateWeekDisplay() {
        const weekEnd = new Date(currentWeekStart);
        weekEnd.setDate(weekEnd.getDate() + 6);
        
        const formatDate = (date) => {
            return date.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });
        };
        
        weekDisplay.textContent = `${formatDate(currentWeekStart)} - ${formatDate(weekEnd)}`;
    }
    
    function renderCalendar() {
        // Clear calendar
        calendar.innerHTML = '';
        
        // Create table
        const table = document.createElement('table');
        const thead = document.createElement('thead');
        const tbody = document.createElement('tbody');
        
        // Create header row with days
        const headerRow = document.createElement('tr');
        const timeHeader = document.createElement('th');
        timeHeader.textContent = 'Time';
        headerRow.appendChild(timeHeader);
        
        // Add days to header
        for (let i = 0; i < 7; i++) {
            const day = new Date(currentWeekStart);
            day.setDate(day.getDate() + i);
            
            const th = document.createElement('th');
            const isToday = isSameDay(day, new Date());
            
            // Format: Monday, Aug 15
            th.innerHTML = `${day.toLocaleDateString('en-US', { weekday: 'short' })}<br>${
                day.toLocaleDateString('en-US', { month: 'short', day: 'numeric' })}`;
            
            if (isToday) {
                th.innerHTML += '<br><span class="today-marker">TODAY</span>';
                th.classList.add('today-header');
            }
            
            headerRow.appendChild(th);
        }
        
        thead.appendChild(headerRow);
        
        // Create only the 3-6 PM time slots
        const timeSlots = [15, 16, 17]; // 3 PM, 4 PM, 5 PM in 24-hour format
        
        for (let hour of timeSlots) {
            const timeRow = document.createElement('tr');
            
            // Time column
            const timeCell = document.createElement('td');
            const nextHour = hour + 1;
            timeCell.textContent = `${hour % 12 || 12}:00 - ${nextHour % 12 || 12}:00 ${hour < 12 ? 'AM' : 'PM'}`;
            timeCell.classList.add('time-cell');
            timeRow.appendChild(timeCell);
            
            // Create cells for each day
            for (let i = 0; i < 7; i++) {
                const day = new Date(currentWeekStart);
                day.setDate(day.getDate() + i);
                day.setHours(hour, 0, 0, 0);
                
                const isToday = isSameDay(day, new Date());
                
                const cell = document.createElement('td');
                cell.classList.add('time-slot');
                if (isToday) cell.classList.add('today');
                
                cell.dataset.date = day.toISOString().split('T')[0];
                cell.dataset.time = `${hour}:00`;
                cell.dataset.endTime = `${nextHour}:00`;
                
                // Add click event to book
                cell.addEventListener('click', () => openBookingModal(day, hour, nextHour));
                
                timeRow.appendChild(cell);
            }
            
            tbody.appendChild(timeRow);
        }
        
        table.appendChild(thead);
        table.appendChild(tbody);
        calendar.appendChild(table);
        
        // Load existing bookings
        loadBookings();
    }
    
    function isSameDay(date1, date2) {
        return date1.getDate() === date2.getDate() &&
               date1.getMonth() === date2.getMonth() &&
               date1.getFullYear() === date2.getFullYear();
    }
    
    function openBookingModal(date, startHour, endHour) {
        const formattedDate = date.toISOString().split('T')[0];
        
        // Format time for input type="time"
        const startTimeFormatted = `${startHour.toString().padStart(2, '0')}:00`;
        const endTimeFormatted = `${endHour.toString().padStart(2, '0')}:00`;
        
        modalContent.textContent = `Book gym for ${date.toLocaleDateString()} from ${startHour % 12 || 12}:00 ${startHour < 12 ? 'AM' : 'PM'} to ${endHour % 12 || 12}:00 ${endHour < 12 ? 'AM' : 'PM'}`;
        
        // Set form values
        sportidInput.value = '1'; // Default sport ID
        dateInput.value = formattedDate;
        startTimeInput.value = startTimeFormatted;
        endTimeInput.value = endTimeFormatted;
        
        // Show modal
        modal.style.display = 'block';
    }
    
    function closeModal() {
        modal.style.display = 'none';
    }
    
    function saveBooking() {
        // Show saving indicator
        const submitBtn = bookingForm.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Saving...';
        submitBtn.disabled = true;
        
        // Get form data
        const formData = new FormData(bookingForm);
        
        // Send data to server using fetch
        fetch('/save-booking', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('Booking saved successfully!', 'success');
                closeModal();
                renderCalendar(); // Refresh calendar
            } else {
                showNotification('Error: ' + (data.message || 'Could not save booking'), 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Network error. Please try again.', 'error');
        })
        .finally(() => {
            // Reset button
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        });
    }
    
    function loadBookings() {
        // Calculate date range for the current week view
        const startDate = currentWeekStart.toISOString().split('T')[0];
        const endDate = new Date(currentWeekStart);
        endDate.setDate(endDate.getDate() + 6);
        const endDateStr = endDate.toISOString().split('T')[0];
        
        
        // Fetch bookings from the server
        fetch(`/get-bookings?start=${startDate}&end=${endDateStr}`)
        .then(response => response.json())
        .then(bookings => {
           
            
            // Filter bookings to only show those in our time range (3-6 PM)
            const filteredBookings = bookings.filter(booking => {
                const hour = parseInt(booking.start_time.split(':')[0]);
                return hour >= 15 && hour < 18; // 3 PM to 6 PM
            });
            
            // Display bookings on the calendar
            filteredBookings.forEach(booking => {
                const bookingDate = booking.date;
                const startHour = parseInt(booking.start_time.split(':')[0]);
                
                // Find the cell for this booking
                const cells = document.querySelectorAll('.time-slot');
                cells.forEach(cell => {
                    if (cell.dataset.date === bookingDate && 
                        parseInt(cell.dataset.time.split(':')[0]) === startHour) {
                        
                        // Mark as booked
                        cell.classList.add('booked');
                        
                        // Add booking info
                        const bookingInfo = document.createElement('div');
                        bookingInfo.classList.add('booking-info');
                        bookingInfo.textContent = `${booking.sport_name || 'Gym Session'}`;
                        cell.appendChild(bookingInfo);
                    }
                });
            });
        })
        
    }
    
    
});