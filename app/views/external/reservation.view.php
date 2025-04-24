<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-1.0">
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/reservations.css">
        <title>External User Dashboard</title>
    </head>

    <body>
        <!-- navigation bar -->
        <?php include 'enav.view.php'; ?>
        <div class="main">
        <?php include 'top.view.php'; ?>

        <section class="statusboard">
        <div class="container1">
            <div class="reservation-header">
                <h2>Active Reservations</h2>
                <a href="pickfacility" class="new-reservation-icon" title="New Reservation">
                    <img src="<?=ROOT?>/assets/images/booking.webp" alt="New Reservation">
                </a>
            </div>

            <div class="reservations-grid">
            <?php foreach ($active_reservations as $res) : ?>
                <div class="reservation-card" onclick="toggleExpand(this)">
                    <div class="card-header">
                        
                        <div class="card-title">
                            <h3><?= htmlspecialchars($res->courtname) ?></h3>
                            <span class="status-badge <?= strtolower(str_replace(' ', '', $res->status)) ?>">
                                <?= htmlspecialchars($res->status) ?>
                            </span>
                        </div>
                        <div class="expand-icon">
                            <i class="arrow-down"></i>
                        </div>
                    </div>
                    
                    <div class="card-details">
                        <div class="detail-row">
                            <div class="detail-item">
                                <span class="detail-label">ID:</span>
                                <span class="detail-value"><?= htmlspecialchars($res->reservationid) ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Event:</span>
                                <span class="detail-value"><?= htmlspecialchars($res->event) ?></span>
                            </div>
                        </div>
                        
                        <div class="detail-row">
                            <div class="detail-item">
                                <span class="detail-label">Date:</span>
                                <span class="detail-value"><?= htmlspecialchars($res->date) ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Time:</span>
                                <span class="detail-value"><?= htmlspecialchars($res->time) ?></span>
                            </div>
                        </div>
                        
                        <div class="detail-row">
                            <div class="detail-item">
                                <span class="detail-label">Price:</span>
                                <span class="detail-value">Rs.<?= htmlspecialchars($res->price) ?></span>
                            </div>
                        </div>
                        
                        <div class="card-actions">
                            <?php if (str_replace(' ', '', strtolower($res->status)) === 'topay') : ?>
                            <form method="POST" action="<?= ROOT ?>/external/pay">
                                <input type="hidden" name="reservationid" value="<?= htmlspecialchars($res->reservationid) ?>">
                                <input type="hidden" name="discountedprice" value="<?= htmlspecialchars($res->discountedprice) ?>">
                                <button class="action-btn pay-now-btn" type="submit">
                                    <!-- <img src="<?=ROOT?>/assets/images/payment-icon.png" alt="Pay"> -->
                                    Pay Now
                                </button>
                            </form>
                            <?php endif; ?>
                            
                                                        <a href="javascript:void(0);"
                            class="action-btn reschedule-btn"
                            onclick="openRescheduleModal(
                                '<?= htmlspecialchars($res->reservationid) ?>',
                                '<?= htmlspecialchars($res->courtname) ?>',
                                '<?= htmlspecialchars($res->event) ?>',
                                '<?= htmlspecialchars($res->date) ?>',
                                '<?= htmlspecialchars($res->time) ?>',
                                '<?= htmlspecialchars($res->duration) ?>',
                                '<?= htmlspecialchars($res->price) ?>',
                                '<?= htmlspecialchars($res->section) ?>' // ADD THIS
                            )">Reschedule</a>


                            
                            <a href="javascript:void(0);" onclick="event.stopPropagation(); openCancelPopup('<?= htmlspecialchars($res->reservationid) ?>', '<?= htmlspecialchars($_SESSION['username'] ?? '') ?>')" class="action-btn cancel-btn">
                                <!-- <img src="<?=ROOT?>/assets/images/cancel-icon.png" alt="Cancel"> -->
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        </section>
               
        <div class="container1 history-container">
            <div class="reservation-header">
                <h2>Reservation History</h2>
                <div class="filter-container">
                    <label for="statusFilter">Filter by Status:</label>
                    <select id="statusFilter" onchange="filterTable()">
                        <option value="all">All</option>
                        <option value="Pending">Pending</option>
                        <option value="To pay">To Pay</option>
                        <option value="Paid">Paid</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
            
            <div class="reservation-history">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Facility</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($history_reservations)) : ?>
                            <?php foreach ($history_reservations as $reservation) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($reservation->date); ?></td>
                                    <td><?= htmlspecialchars($reservation->courtname); ?></td>
                                    <td>Rs.<?= htmlspecialchars($reservation->price); ?></td>
                                    <td><span class="status-pill <?= strtolower(str_replace(' ', '', $reservation->status)); ?>"><?= htmlspecialchars($reservation->status); ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4">No reservations found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="cancel-popup" class="popup">
            <div class="popup-content">
                <span class="close-icon" onclick="closePopup()">&times;</span>
                <h3>Cancel Reservation</h3>
                <p>Are you sure you want to cancel this reservation?</p>
                <form id="cancel-form" method="POST" action="<?= ROOT ?>/external/reservation/cancelReservation">
                    <input type="hidden" id="reservation-id" name="reservationid">
                    <div class="popup-buttons">
                        <button type="submit" class="confirm-btn">Yes, Cancel</button>
                        <button type="button" class="cancel-btn" onclick="closePopup()">No</button>
                    </div>
                </form>
            </div>
        </div>


        <div id="reschedule-modal" class="popup" style="display:none;">
    <div class="popup-content">
        <span class="close-icon" onclick="closeRescheduleModal()">&times;</span>
        <h3>Reschedule Reservation</h3>
        <form id="reschedule-form" method="POST" action="<?= ROOT ?>/external/reservation/rescheduleReservation">
        <div class="form-fields-scrollable">   
        <input type="hidden" name="reservationid" id="reschedule-reservationid">
            <div class="form-group">
                <label>Facility</label>
                <input type="text" id="reschedule-courtname" readonly>
            </div>
            <div class="form-group">
                <label>Event</label>
                <input type="text" id="reschedule-event" readonly>
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" id="reschedule-date" required>
            </div>

            <div id="date-message" style="color:red; margin-top:5px;"></div>
            <div class="form-group">
                <label>Duration</label>
                <input type="text" id="reschedule-duration" readonly>
                <input type="hidden" name="duration" id="reschedule-duration-hidden">
            </div>
            
            <div class="form-group">
                <label>Time</label>
                <div id="reschedule-time-slots"></div>
            </div>

            <div class="form-group">
                <label>Price</label>
                <input type="text" id="reschedule-price" readonly>
            </div>
                        </div> 
            <div class="popup-buttons">
                <button type="submit" class="confirm-btn">Submit</button>
                <button type="button" class="cancel-btn" onclick="closeRescheduleModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>


        </div>
        </div>
        

        <!-- success modal-->
        <div id="reschedule-success-modal" class="popup" style="display:none;">
    <div class="popup-content">
        <span class="close-icon" onclick="closeRescheduleSuccessModal()">&times;</span>
        <h3>Reservation Rescheduled</h3>
        <p>Your reservation has been successfully rescheduled.</p>
        <div class="popup-buttons">
            <button type="button" class="confirm-btn" onclick="closeRescheduleSuccessModal()">OK</button>
        </div>
    </div>
</div>

        <script>
// Toggle card expansion
function toggleExpand(card) {
    document.querySelectorAll('.reservation-card.expanded').forEach(expandedCard => {
        if (expandedCard !== card) {
            expandedCard.classList.remove('expanded');
        }
    });
    card.classList.toggle('expanded');
}

// Filter table function
function filterTable() {
    const filter = document.getElementById("statusFilter").value;
    const rows = document.querySelectorAll(".reservation-history tbody tr");
    rows.forEach(row => {
        const statusCell = row.cells[3];
        const status = statusCell.textContent.trim();
        if (filter === "all" || status.toLowerCase().includes(filter.toLowerCase())) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}

// Popup functions
function openCancelPopup(reservationId) {
    document.getElementById("reservation-id").value = reservationId;
    document.getElementById("cancel-popup").style.display = "block";
    setTimeout(() => {
        document.querySelector('.popup-content').classList.add('active');
    }, 10);
}

function closePopup() {
    document.querySelector('.popup-content').classList.remove('active');
    setTimeout(() => {
        document.getElementById("cancel-popup").style.display = "none";
    }, 300);
}

// Add smooth scroll behavior
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Add animation to status badges and initialize filter on load
document.addEventListener('DOMContentLoaded', function() {
    const statusBadges = document.querySelectorAll('.status-badge, .status-pill');
    statusBadges.forEach(badge => {
        badge.classList.add('animated');
    });
    filterTable();
});

// Time slot logic for reschedule modal
function getTimeSlots(duration) {
    if (duration === "half") {
        return ["8:00-13:00", "13:00-18:00"];
    } else if (duration === "full") {
        return ["8:00-18:00"];
    } else if (duration === "2 hour" || duration === "2 hours") {
        return ["8:00-10:00", "10:00-12:00", "13:00-15:00", "15:00-17:00"];
    } else if (duration === "1 hour" || duration === "1 hours") {
        let slots = [];
        for (let h = 8; h < 18; h++) {
            let start = h.toString().padStart(2, '0') + ":00";
            let end = (h+1).toString().padStart(2, '0') + ":00";
            slots.push(`${start}-${end}`);
        }
        return slots;
    }
    return [];
}

// ---- RESCHEDULE MODAL LOGIC ----

// Store section for use in reschedule modal
let currentRescheduleSection = null;

// Open reschedule modal and populate fields and time slots
function openRescheduleModal(reservationid, courtname, event, date, time, duration, price, section) {
    document.getElementById('reschedule-reservationid').value = reservationid;
    document.getElementById('reschedule-courtname').value = courtname;
    document.getElementById('reschedule-event').value = event;
    document.getElementById('reschedule-date').value = date;
    document.getElementById('reschedule-duration').value = duration;
    document.getElementById('reschedule-price').value = price;
    document.getElementById('reschedule-duration-hidden').value = duration;

    // Store section for AJAX (if your backend expects "section", pass it here; adjust if needed)
    currentRescheduleSection = section;

    const timeSlotsDiv = document.getElementById('reschedule-time-slots');
    const slots = getTimeSlots(duration);
    timeSlotsDiv.innerHTML = '';
    slots.forEach((slot, idx) => {
        const radioId = `reschedule-time-slot-${idx}`;
        const label = document.createElement('label');
        label.style.marginRight = "15px";
        label.style.cursor = "pointer";
        label.htmlFor = radioId;

        const radio = document.createElement('input');
        radio.type = "radio";
        radio.name = "time";
        const startTime = slot.split('-')[0].padStart(5, '0') + ':00';
radio.value = startTime; // Now value is "08:00:00"
        radio.id = radioId;
        radio.required = true;
        if (slot === time) radio.checked = true;

        label.appendChild(radio);
        label.appendChild(document.createTextNode(" " + slot));
        timeSlotsDiv.appendChild(label);
    });

    document.getElementById('reschedule-modal').style.display = 'block';
    setTimeout(() => {
        document.querySelector('#reschedule-modal .popup-content').classList.add('active');
    }, 10);

    // Trigger availability check on modal open
    checkRescheduleDateAvailability();
}

function closeRescheduleModal() {
    document.querySelector('#reschedule-modal .popup-content').classList.remove('active');
    setTimeout(() => {
        document.getElementById('reschedule-modal').style.display = 'none';
        document.getElementById('reschedule-duration').disabled = false;
    }, 300);
}

// --- AVAILABILITY CHECK LOGIC ---
function parseTime(str) {
    // "8:00-13:00" -> [8, 13], "13:00:00" -> [8, null]
    if (str.includes('-')) {
        const [start, end] = str.split('-').map(s => parseInt(s.split(':')[0], 10));
        return [start, end];
    } else {
        return [parseInt(str.split(':')[0], 10), null];
    }
}


function setTimeSlotsDisabled(disabled, slotIndexes = null) {
    const radios = document.querySelectorAll('#reschedule-time-slots input[type="radio"]');
    radios.forEach((radio, idx) => {
        if (slotIndexes === null) {
            radio.disabled = disabled;
        } else {
            radio.disabled = slotIndexes.includes(idx);
        }
    });
}

function timeToSeconds(timeStr) {
    // Accepts "08:00" or "08:00:00"
    const parts = timeStr.split(':');
    const h = parseInt(parts[0], 10);
    const m = parseInt(parts[1], 10);
    const s = parts[2] ? parseInt(parts[2], 10) : 0;
    return h * 3600 + m * 60 + s;
}


function parseSlot(slotStr) {
    // Accepts "8:00-13:00", "13:00:00-18:00:00", etc.
    const [start, end] = slotStr.split('-');
    return [timeToSeconds(start), timeToSeconds(end)];
}

function checkRescheduleDateAvailability() {
    const dateInput = document.getElementById('reschedule-date');
    const messageDiv = document.getElementById('date-message');
    const submitBtn = document.querySelector('#reschedule-form button[type="submit"]');
    const section = currentRescheduleSection;

    function check() {
    const date = dateInput.value;
    messageDiv.textContent = '';
    submitBtn.disabled = false;
    setTimeSlotsDisabled(false);

    if (!date || !section) {
        console.warn("Skipping availability check: missing date or section", {date, section});
        return;
    }


        const duration = document.getElementById('reschedule-duration').value.trim().toLowerCase();
        const slots = getTimeSlots('half'); // always 2: ["8:00-13:00", "13:00-18:00"]

        fetch('<?= ROOT ?>/external/reservation/checkAvailability', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `date=${encodeURIComponent(date)}&section=${encodeURIComponent(section)}`
        })
        .then(res => {
    console.log("Availability check status:", res.status);
    return res.json().catch(err => {
        console.error("Failed to parse JSON:", err);
        throw new Error("Invalid JSON");
    });
})
.then(data => {
    console.log("Availability check data:", data);
    //for two hour slot logics
    if (duration === '2 hour' || duration === '2 hours') {
    const slots = getTimeSlots('2 hour');
    let disabledIndexes = [];

    // 1. If any full booking, block all
    let fullBooked = data.some(reservation =>
        reservation.duration === 'full' &&
        ['to pay', 'paid', 'confirmed'].includes(reservation.status.toLowerCase())
    );
    if (fullBooked) {
        messageDiv.textContent = 'Date not available. Please select another date.';
        submitBtn.disabled = true;
        setTimeSlotsDisabled(true);
        return;
    }

    // 2. Disable slots that overlap with half-day bookings
    data.forEach(reservation => {
        const statusOk = ['to pay', 'paid', 'confirmed'].includes(reservation.status.toLowerCase());
        if (!statusOk) return;

        // If there's a half-day booking, disable overlapping 2-hour slots
        if (reservation.duration === 'half') {
    // Convert half-day booking time to a range in hours
    let halfStart, halfEnd;
    if (reservation.time === '8:00:00') {
        halfStart = 8;
        halfEnd = 13;
    } else if (reservation.time === '13:00:00') {
        halfStart = 13;
        halfEnd = 18;
    } else if (reservation.time.includes('-')) {
        [halfStart, halfEnd] = reservation.time.split('-').map(s => parseInt(s.split(':')[0], 10));
    } else {
        // fallback: treat as 5-hour slot from start
        halfStart = parseInt(reservation.time.split(':')[0], 10);
        halfEnd = halfStart + 5;
    }
    slots.forEach((slot, idx) => {
        let [slotStart, slotEnd] = slot.split('-').map(s => parseInt(s.split(':')[0], 10));
        if (slotStart >= halfStart && slotEnd <= halfEnd) {
            disabledIndexes.push(idx);
        }
    });
}


        // 3. If there's a 2-hour booking, disable that exact slot
        if (reservation.duration === '2 hour' || reservation.duration === '2 hours') {
            slots.forEach((slot, idx) => {
                const [slotStart, slotEnd] = parseSlot(slot); // e.g. [28800, 36000] for 8:00-10:00
const resStart = timeToSeconds(reservation.time); // e.g. 28800 for 8:00:00
const resEnd = resStart + 2 * 3600; // 2-hour booking

// If the slot overlaps with the reservation, disable it
if (
    (resStart < slotEnd && resEnd > slotStart)
) {
    disabledIndexes.push(idx);
}

            });
        }
    });

    // Remove duplicates
    disabledIndexes = [...new Set(disabledIndexes)];

    // If all slots are disabled, treat as fully booked
    if (disabledIndexes.length === slots.length) {
        messageDiv.textContent = 'Date not available. Please select another date.';
        submitBtn.disabled = true;
        setTimeSlotsDisabled(true);
    } else {
        messageDiv.textContent = '';
        submitBtn.disabled = false;
        setTimeSlotsDisabled(false, disabledIndexes);
    }
    return;
}

            // ---- NEW LOGIC: For full-day, block if ANY booking exists ----
            if (duration === 'full') {
                let anyBooking = data.some(reservation =>
                    ['to pay', 'paid', 'confirmed'].includes(reservation.status.toLowerCase())
                );
                if (anyBooking) {
                    messageDiv.textContent = 'Date not available. Please select another date.';
                    submitBtn.disabled = true;
                    setTimeSlotsDisabled(true);
                    return;
                }
            }
            // 1. If any full reservation, block all
            let fullBooked = data.some(reservation =>
                reservation.duration === 'full' &&
                ['to pay', 'paid', 'confirmed'].includes(reservation.status.toLowerCase())
            );
            if (duration === 'half' && fullBooked) {
                messageDiv.textContent = 'Date not available. Please select another date.';
                submitBtn.disabled = true;
                setTimeSlotsDisabled(true);
                return;
            }

            // 2. For half, disable only the matching slot(s)
    let disabledIndexes = [];
    if (duration === 'half') {
        data.forEach(reservation => {
            const statusOk = ['to pay', 'paid', 'confirmed'].includes(reservation.status.toLowerCase());
            if (!statusOk) return;

            // Disable the slot if another half is booked
            if (reservation.duration === 'half') {
   let halfStart, halfEnd;
if (reservation.time.includes('-')) {
    [halfStart, halfEnd] = parseSlot(reservation.time);
} else if (reservation.time === '8:00:00') {
    halfStart = timeToSeconds('8:00:00');
    halfEnd = timeToSeconds('13:00:00');
} else if (reservation.time === '13:00:00') {
    halfStart = timeToSeconds('13:00:00');
    halfEnd = timeToSeconds('18:00:00');
} else {
    halfStart = timeToSeconds(reservation.time);
    halfEnd = halfStart + 5 * 3600;
}
slots.forEach((slot, idx) => {
    const [slotStart, slotEnd] = parseSlot(slot);
    if (slotStart >= halfStart && slotEnd <= halfEnd) {
        disabledIndexes.push(idx);
    }
});

}

            
            // Disable slot if a 2-hour booking overlaps with a half slot
            if (reservation.duration === '2 hour' || reservation.duration === '2 hours') {
    slots.forEach((slot, idx) => {
        // slot: "8:00-10:00"
        const [slotStartStr, slotEndStr] = slot.split('-');
        const slotStart = timeToSeconds(slotStartStr);
        const resStart = timeToSeconds(reservation.time);
        if (slotStart === resStart) {
            disabledIndexes.push(idx);
        }
    });
}

            // Disable slot if a 1-hour booking overlaps with a half slot
            if (reservation.duration === '1 hour' || reservation.duration === '1 hours') {
    const resStart = timeToSeconds(reservation.time);
    const resEnd = resStart + 3600;
    slots.forEach((slot, idx) => {
        const [slotStart, slotEnd] = parseSlot(slot); // slotStart/slotEnd in seconds
        // If the 1-hour booking overlaps with the half slot, disable it
        if (resStart < slotEnd && resEnd > slotStart) {
            disabledIndexes.push(idx);
        }
    });
}

        });

        

        // Remove duplicates
        disabledIndexes = [...new Set(disabledIndexes)];

        // If all slots are disabled, treat as fully booked
        if (disabledIndexes.length === slots.length) {
            messageDiv.textContent = 'Date not available. Please select another date.';
            submitBtn.disabled = true;
            setTimeSlotsDisabled(true);
        } else {
            messageDiv.textContent = '';
            submitBtn.disabled = false;
            setTimeSlotsDisabled(false, disabledIndexes);
        }
    }

    if (duration === '1 hour' || duration === '1 hours') {
    const slots = getTimeSlots('1 hour');
    let disabledIndexes = [];

    // Block all if any full booking exists
    let fullBooked = data.some(reservation =>
        reservation.duration === 'full' &&
        ['to pay', 'paid', 'confirmed'].includes(reservation.status.toLowerCase())
    );
    if (fullBooked) {
        messageDiv.textContent = 'Date not available. Please select another date.';
        submitBtn.disabled = true;
        setTimeSlotsDisabled(true);
        return;
    }

    data.forEach(reservation => {
        const statusOk = ['to pay', 'paid', 'confirmed'].includes(reservation.status.toLowerCase());
        if (!statusOk) return;

        // Disable all hour slots inside a half booking
        if (reservation.duration === 'half') {
            let halfStart, halfEnd;
            if (reservation.time === '8:00:00') {
                halfStart = timeToSeconds('8:00:00');
                halfEnd = timeToSeconds('13:00:00');
            } else if (reservation.time === '13:00:00') {
                halfStart = timeToSeconds('13:00:00');
                halfEnd = timeToSeconds('18:00:00');
            } else if (reservation.time.includes('-')) {
                [halfStart, halfEnd] = reservation.time.split('-').map(timeToSeconds);
            } else {
                // Fallback: treat as 5-hour slot from start
                halfStart = timeToSeconds(reservation.time);
                halfEnd = halfStart + 5 * 3600;
            }
            slots.forEach((slot, idx) => {
                const [slotStart, slotEnd] = parseSlot(slot);
                if (slotStart >= halfStart && slotEnd <= halfEnd) {
                    disabledIndexes.push(idx);
                }
            });
        }

        // Disable the slot if another 1-hour is booked
        if (reservation.duration === '1 hour' || reservation.duration === '1 hours') {
            const resStart = timeToSeconds(reservation.time);
            slots.forEach((slot, idx) => {
                const [slotStart, ] = parseSlot(slot);
                if (slotStart === resStart) {
                    disabledIndexes.push(idx);
                }
            });
        }

        // Disable both hour slots covered by a 2-hour booking
        if (reservation.duration === '2 hour' || reservation.duration === '2 hours') {
            const resStart = timeToSeconds(reservation.time);
            const resEnd = resStart + 2 * 3600;
            slots.forEach((slot, idx) => {
                const [slotStart, slotEnd] = parseSlot(slot);
                // If the 1-hour slot is within the 2-hour booking
                if (slotStart >= resStart && slotEnd <= resEnd) {
                    disabledIndexes.push(idx);
                }
            });
        }
    });

    // Remove duplicates
    disabledIndexes = [...new Set(disabledIndexes)];

    if (disabledIndexes.length === slots.length) {
        messageDiv.textContent = 'Date not available. Please select another date.';
        submitBtn.disabled = true;
        setTimeSlotsDisabled(true);
    } else {
        messageDiv.textContent = '';
        submitBtn.disabled = false;
        setTimeSlotsDisabled(false, disabledIndexes);
    }
    return;
}


})
.catch((err) => {
    console.error("Availability check failed:", err);
    messageDiv.textContent = 'Error checking availability.';
    submitBtn.disabled = true;
    setTimeSlotsDisabled(true);
});
    }

  
    // Initial check on modal open
    check();
}


document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('reschedule-date');
    if (dateInput) {
        dateInput.addEventListener('change', checkRescheduleDateAvailability);
    }
});


function closeRescheduleSuccessModal() {
    document.querySelector('#reschedule-success-modal .popup-content').classList.remove('active');
    setTimeout(() => {
        document.getElementById('reschedule-success-modal').style.display = 'none';
    }, 300);
}

document.addEventListener('DOMContentLoaded', function() {
    // Check if the URL contains ?reschedule=success
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('reschedule') === 'success') {
        const modal = document.getElementById('reschedule-success-modal');
        modal.style.display = 'block';
        setTimeout(() => {
            modal.querySelector('.popup-content').classList.add('active');
        }, 10);
        // Optionally, remove the query param from URL after showing modal
        window.history.replaceState({}, document.title, window.location.pathname);
    }
});


        </script>
    </body>
</html>
