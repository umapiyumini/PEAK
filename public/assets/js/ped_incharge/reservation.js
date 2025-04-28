let selectedTimeSlot = null;
let selectedVenue = null;

// Modal elements
const modal = document.getElementById('reservationModal');
const reservationDetailsModal = document.getElementById('reservationDetailsModal');
const closeButton = document.querySelector('.close-button');
const reservationDetailsCloseButton = reservationDetailsModal.querySelector('.close-button');
const reservationForm = document.getElementById('reservationForm');
const reservationTitle = document.getElementById('reservation-title');
const reservationDescription = document.getElementById('reservation-description');

// Single event listener for handling both new and existing reservations
document.querySelectorAll('.time-slot').forEach(slot => {
    slot.addEventListener('click', function(e) {
        // First check if clicking on an existing reservation
        const reservationSlot = e.target.closest('.reservation-slot');
        
        if (reservationSlot) {
            // Handle existing reservation click
            const title = reservationSlot.querySelector('strong').textContent;
            const description = reservationSlot.title;
            const type = Array.from(reservationSlot.classList)
                .find(className => ['external', 'sports', 'special'].includes(className));
            const time = reservationSlot.textContent.split('\n')[1].trim();
            const venue = reservationSlot.closest('.day-column').querySelector('.day').textContent;

            // Display the details in the modal
            reservationTitle.innerHTML = `
                <span class="reservation-type ${type}">${type.charAt(0).toUpperCase() + type.slice(1)}</span>
                <h2>${title}</h2>
                <div class="reservation-metadata">
                    <span><i class="uil uil-clock"></i> ${time}</span>
                    <span><i class="uil uil-location-point"></i> ${venue}</span>
                </div>
            `;
            reservationDescription.textContent = description || 'No description provided';

            // Open details modal
            reservationDetailsModal.style.display = 'block';
        } else {
            // Handle new reservation
            const timeIndex = Array.from(slot.parentElement.children).indexOf(slot);
            const venue = slot.parentElement.querySelector('.day').textContent;
            const timeElement = document.querySelectorAll('.time')[timeIndex];
            const time = timeElement.textContent;
            
            selectedTimeSlot = {
                element: slot,
                time: time,
                venue: venue
            };
            
            modal.style.display = 'block';
        }
    });
});

// Modal control functions
function openModal() {
    modal.style.display = 'block';
}

function closeModal() {
    modal.style.display = 'none';
    reservationForm.reset();
}

// Event listeners for closing modals
closeButton.addEventListener('click', closeModal);
reservationDetailsCloseButton.addEventListener('click', () => {
    reservationDetailsModal.style.display = 'none';
});

window.addEventListener('click', (e) => {
    if (e.target === modal) {
        closeModal();
    }
    if (e.target === reservationDetailsModal) {
        reservationDetailsModal.style.display = 'none';
    }
});

// Keyboard support for closing modals
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        if (modal.style.display === 'block') {
            closeModal();
        }
        if (reservationDetailsModal.style.display === 'block') {
            reservationDetailsModal.style.display = 'none';
        }
    }
});

// Handle form submission
reservationForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (!selectedTimeSlot) return;
    
    const title = document.getElementById('title').value;
    const type = document.getElementById('type').value;
    const description = document.getElementById('description').value;
    
    // Create reservation slot
    const reservationSlot = document.createElement('div');
    reservationSlot.className = `reservation-slot ${type}`;
    reservationSlot.innerHTML = `
        <strong>${title}</strong><br>
        ${selectedTimeSlot.time}
    `;
    
    // Add tooltip with description
    reservationSlot.title = description;
    
    // Clear any existing reservations in the time slot
    selectedTimeSlot.element.innerHTML = '';
    selectedTimeSlot.element.appendChild(reservationSlot);
    
    // Store reservation data if needed
    const reservationData = {
        title,
        type,
        description,
        time: selectedTimeSlot.time,
        venue: selectedTimeSlot.venue
    };
    
    // Close modal
    closeModal();
});

