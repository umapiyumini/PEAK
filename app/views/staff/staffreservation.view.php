<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/todo.css">
    <style>
        .slot-container {
    display: flex;
    margin-left: 70px;
    gap: 15px;
    margin-top: 20px;
    justify-content: center;

    
}

.time-slot {
    padding: 12px 20px;
    border-radius: 12px;
    font-weight: 600;
    min-width: 120px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    cursor: default;
    font-family: 'Segoe UI', sans-serif;
    font-size: 16px;
}

/* Hover effect for both */
.time-slot:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
}

/* Available slot style */
.time-slot.available {
    background-color: #4b0a4a;
    color:rgb(255, 255, 255);
    border: 1px solid #c8e6c9;
}

/* Reserved slot style */
.time-slot.reserved {
    background-color: #ffeaea;
    color: #b71c1c;
    border: 1px solid #ffcdd2;
}

    </style>
    <title>Staff Reservation Dashboard</title>
</head>
<body>
<div class="container">
    <div class="reservations">
        <h2>View Reservations</h2>

        <label for="facility">Select Facility:</label>
        <select id="facility">
            <option value="" disabled selected>Select...</option>
            <?php if(isset($staffType) && $staffType == 'indoor'): ?>
                <option value="1">Badminton</option>
                <option value="2">Table Tennis</option>
                <option value="3">Volleyball</option>
                <option value="4">Karate</option>
                <option value="5">Wrestling</option>
                <option value="6">Sports Center</option>
            <?php elseif(isset($staffType) && $staffType == 'ground'): ?>
                <option value="7">Baseball</option>
                <option value="8">Hockey</option>
                <option value="9">Cricket</option>
                <option value="10">Cricket Turf</option>
                <option value="11">Elle</option>
                <option value="12">Tennis</option>
                <option value="13">Basketball</option>
                <option value="14">Football</option>
                <option value="15">Netball</option>
                <option value="16">Rugby</option>
                <option value="17">Tennis</option>
                <option value="18">Volleyball</option>
            <?php endif; ?>
        </select>

        <div id="dateNavigation">
            <button id="prevDate">&lt;</button>
            <span id="currentDate"></span>
            <button id="nextDate">&gt;</button>
        </div>

        <div id="timeSlots" class="time-slots"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const facilitySelect = document.getElementById('facility');
    const currentDateElement = document.getElementById('currentDate');
    const prevDateButton = document.getElementById('prevDate');
    const nextDateButton = document.getElementById('nextDate');
    const timeSlotsContainer = document.getElementById('timeSlots');

    let currentDate = new Date();
    updateDateDisplay();

    prevDateButton.addEventListener('click', () => {
        currentDate.setDate(currentDate.getDate() - 1);
        updateDateDisplay();
        if (facilitySelect.value) {
            loadReservations(facilitySelect.value, formatDate(currentDate));
        }
    });

    nextDateButton.addEventListener('click', () => {
        currentDate.setDate(currentDate.getDate() + 1);
        updateDateDisplay();
        if (facilitySelect.value) {
            loadReservations(facilitySelect.value, formatDate(currentDate));
        }
    });

    function updateDateDisplay() {
        currentDateElement.textContent = formatDate(currentDate);
    }

    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    facilitySelect.addEventListener('change', function () {
        const selectedFacility = this.value;
        if (selectedFacility) {
            loadReservations(selectedFacility, formatDate(currentDate));
        } else {
            timeSlotsContainer.innerHTML = '';
        }
    });

    function loadReservations(facility, date) {
    timeSlotsContainer.innerHTML = '<p>Loading reservations...</p>';

    fetch(`<?=ROOT?>/staff/Staffreservation/getReservations?facility=${facility}&date=${date}`)
        .then(response => {
            if (!response.ok) throw new Error('Network error');
            return response.text(); // raw HTML
        })
        .then(html => {
            timeSlotsContainer.innerHTML = `<div class="slot-container">${html}</div>`;
        })
        .catch(error => {
            console.error('Error:', error);
            timeSlotsContainer.innerHTML = `<p class="error">${error.message}</p>`;
        });
}

    function displayReservations(slots) {
        if (slots.length === 0) {
            timeSlotsContainer.innerHTML = '<p>No time slots found.</p>';
            return;
        }

        let html = '<div class="slot-container">';
        slots.forEach(slot => {
            html += `
                <div class="time-slot ${slot.reserved ? 'reserved' : 'available'}">
                    ${slot.time} - ${getEndTime(slot.time)}
                </div>
            `;
        });
        html += '</div>';

        timeSlotsContainer.innerHTML = html;
    }

    function getEndTime(start) {
        const [h, m] = start.split(':').map(Number);
        const end = new Date(0, 0, 0, h + 2, m);
        return `${String(end.getHours()).padStart(2, '0')}:${String(end.getMinutes()).padStart(2, '0')}`;
    }
});
</script>
</body>
</html>
