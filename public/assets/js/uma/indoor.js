document.addEventListener('DOMContentLoaded', () => {
    const durationDropdown = document.getElementById('duration');
    const dateInput = document.getElementById('date');
    const timeSlotsContainer = document.getElementById('timeSlots');
    const priceInput = document.getElementById('price');
    const discountPriceInput = document.getElementById('disprice');
    const eventSelect = document.getElementById('bookingFor');

    // Restrict dates to two weeks in advance
    const today = new Date();
    const maxDate = new Date(today);
    maxDate.setDate(today.getDate() + 14);

    dateInput.min = today.toISOString().split('T')[0];
    dateInput.max = maxDate.toISOString().split('T')[0];

    // Predefined unavailable slots (example data, customize as needed)
    const unavailableSlots = {
        '2024-11-25': ['08:00-10:00', '14:00-16:00'],
        '2024-11-26': ['12:00-14:00']
    };

    // Show time slots only after selecting a date
    dateInput.addEventListener('change', () => {
        generateTimeSlots();
    });

    // Fetch price dynamically based on event and duration
    function fetchPrice() {
        const event = eventSelect.value;
        const duration = durationDropdown.value;

        if (!event || !duration) return; // Ensure both fields are selected

        // Make the AJAX call to fetch price from server
        fetch("<?=ROOT?>/external/getprice", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `event=${event}&duration=${duration}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const basePrice = parseFloat(data.price);
                priceInput.value = `${basePrice} LKR`; // Display base price
                calculateDiscount(basePrice); // Calculate discount price
            } else {
                priceInput.value = 'N/A';
                discountPriceInput.value = 'N/A';
            }
        })
        .catch(error => {
            console.error('Error fetching price:', error);
        });
    }

    // Function to calculate the discounted price
    function calculateDiscount(basePrice) {
        const discountRate = 0.1; // Example: 10% discount
        const discountedPrice = basePrice - basePrice * discountRate;
        discountPriceInput.value = `${discountedPrice.toFixed(2)} LKR`; // Display discounted price
    }

    // Trigger price fetch when event or duration changes
    eventSelect.addEventListener('change', fetchPrice);
    durationDropdown.addEventListener('change', fetchPrice);

    // Generate time slots based on duration and date
    function generateTimeSlots() {
        const duration = durationDropdown.value;
        const selectedDate = dateInput.value;

        if (!selectedDate || duration === '') {
            timeSlotsContainer.innerHTML = '<p>Please select a valid date and duration.</p>';
            return;
        }

        timeSlotsContainer.innerHTML = ''; // Clear previous slots

        if (duration === 'fullDay') {
            timeSlotsContainer.innerHTML = `<div>Full Day: 08:00 - 18:00</div>`;
        } else if (duration === 'halfDay') {
            timeSlotsContainer.innerHTML = `
                ${generateButton(selectedDate, '08:00-13:00')}
                ${generateButton(selectedDate, '13:00-18:00')}
            `;
        } else if (duration === 'twoHours') {
            for (let i = 8; i < 18; i += 2) {
                const start = `${i.toString().padStart(2, '0')}:00`;
                const end = `${(i + 2).toString().padStart(2, '0')}:00`;
                timeSlotsContainer.innerHTML += generateButton(selectedDate, `${start}-${end}`);
            }
        }
    }

    // Helper function to generate a time slot button
    function generateButton(date, slot) {
        const isUnavailable = unavailableSlots[date]?.includes(slot);
        const disabledClass = isUnavailable ? 'disabled' : '';
        const disabledAttr = isUnavailable ? 'disabled' : '';

        return `<button class="slot ${disabledClass}" ${disabledAttr} data-slot="${slot}" data-date="${date}">${slot}</button>`;
    }

    // Add event listener for time slots
    timeSlotsContainer.addEventListener('click', function (event) {
        if (event.target.classList.contains('slot') && !event.target.classList.contains('disabled')) {
            event.preventDefault(); // Prevent page refresh on click
            const selectedSlot = event.target;
            const selectedDate = selectedSlot.getAttribute('data-date');
            const slot = selectedSlot.getAttribute('data-slot');

            // Toggle selected class on the clicked slot
            document.querySelectorAll('.slot').forEach((btn) => btn.classList.remove('selected'));
            selectedSlot.classList.add('selected'); // Make clicked slot dark purple

            // Optionally, store the selected slot for later use
            document.getElementById('selectedTimeSlot').value = slot;
        }
    });
});

// -----------modal-------------------
document.addEventListener('DOMContentLoaded', () => {
    const reservationForm = document.getElementById('reservationForm');
    const modal = document.getElementById('reservationSummaryModal');
    const closeModal = document.querySelector('.close');
    const confirmReservation = document.getElementById('confirmReservation');
    const backToForm = document.getElementById('backToForm');

    reservationForm.addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent form submission

        // Get form values
        const area = document.getElementById('area').value;
        const reason = document.getElementById('reason').value;
        const date = document.getElementById('date').value;
        const duration = document.getElementById('duration').value;
        const timeSlot = document.querySelector('.slot.selected')?.textContent || 'N/A';
        const price = document.getElementById('price').value;
        const discountPrice = document.getElementById('disprice').value;

        // Populate the summary modal
        document.getElementById('summaryArea').textContent = area;
        document.getElementById('summaryReason').textContent = reason;
        document.getElementById('summaryDate').textContent = date;
        document.getElementById('summaryDuration').textContent = duration;
        document.getElementById('summaryTimeSlot').textContent = timeSlot;
        document.getElementById('summaryPrice').textContent = price;
        document.getElementById('summaryDiscountPrice').textContent = discountPrice;

        // Calculate total
        const total = discountPrice ? discountPrice : price;
        document.getElementById('summaryTotal').textContent = total;

        // Show modal
        modal.style.display = 'block';
    });

    // Close modal
    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Back button functionality
    backToForm.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Confirm reservation
    confirmReservation.addEventListener('click', () => {
        alert('Reservation request Sent. you will be notified soon!');
        modal.style.display = 'none';
        window.location.href = 'http://localhost/PEAK/public/external/reservations';
        // Optionally, submit the form data to the server here
    });

    // Close modal on outside click
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const durationSelect = document.getElementById('duration');
    const halfDayOptions = document.getElementById('halfDayOptions');

    durationSelect.addEventListener('change', () => {
        if (durationSelect.value === 'halfDay') {
            halfDayOptions.style.display = 'block';
        } else {
            halfDayOptions.style.display = 'none';
        }
    });
});
