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
                                <span class="detail-label">Section:</span>
                                <span class="detail-value"><?= htmlspecialchars($res->section) ?></span>
                            </div>


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
   onclick="event.stopPropagation(); openRescheduleModal('<?= htmlspecialchars($res->reservationid) ?>', '<?= htmlspecialchars($res->date) ?>', '<?= htmlspecialchars($res->time) ?>', '<?= htmlspecialchars($res->courtid) ?>', '<?= htmlspecialchars($res->courtname) ?>', '<?= htmlspecialchars($res->event) ?>', '<?= htmlspecialchars($res->duration) ?>', '<?= htmlspecialchars($res->numberof_participants) ?>', '<?= htmlspecialchars($res->price) ?>', '<?= htmlspecialchars($res->section) ?>')">
   Reschedule
</a>








                            
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
                        <option value="rejected">Rejected</option>
                        <option value="rejected">Cancelled</option>
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



        </div>
        </div>
        <!-- reschedule modal -->
         <!-- Reschedule Modal -->
<div id="reschedule-modal" class="popup" style="display:none;">
    <div class="popup-content">
        <span class="close-icon" onclick="closeRescheduleModal()">&times;</span>
        <h3>Reschedule Reservation</h3>
        
        <div class="reservation-details">
            <p><strong>Court:</strong> <span id="modal-court-name"></span></p>
            <p><strong>Event:</strong> <span id="modal-event"></span></p>
            <p><strong>Duration:</strong> <span id="modal-duration"></span></p>
            <p><strong>Participants:</strong> <span id="modal-participants"></span></p>
            <p><strong>Current Date:</strong> <span id="modal-current-date"></span></p>
            <p><strong>Current Time:</strong> <span id="modal-current-time"></span></p>
            <p><strong>Section:</strong> <span id="modal-section"></span></p>
        </div>
        
        <form id="reschedule-form" method="POST" action="<?= ROOT ?>/external/reservation/rescheduleReservation">
            <input type="hidden" id="reschedule-reservation-id" name="reservationid">
            <input type="hidden" id="reschedule-court-id" name="courtid">
            <input type="hidden" id="reschedule-event" name="event">
            <input type="hidden" id="reschedule-duration" name="duration">
            <input type="hidden" id="reschedule-participants" name="numberof_participants">
            <input type="hidden" id="reschedule-price" name="price">
            
            <div class="form-group">
                <label for="reschedule-date">New Date:</label>
                <input type="date" id="reschedule-date" name="date" class="form-control" required>
                <div id="availability-message" class="alert" style="display:none;"></div>
            </div>

            
            <div class="form-group">
                <label for="reschedule-time">New Time:</label>
                <select id="reschedule-time" name="time" class="form-control abz" required>
                    <!-- Time options will be populated dynamically -->
                </select>
            </div>
            
            <div class="popup-buttons">
                <button type="submit" class="confirm-btn">Reschedule</button>
                <button type="button" class="cancel-btn" onclick="closeRescheduleModal()">Cancel</button>
            </div>
        </form>
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

//reschedule


// Reschedule modal functions
function openRescheduleModal(reservationId, date, time, courtId, courtName, event, duration, participants, price,section) {
    // Set values in the form fields
    document.getElementById("reschedule-reservation-id").value = reservationId;
    document.getElementById("reschedule-court-id").value = courtId;
    document.getElementById("reschedule-event").value = event;
    document.getElementById("reschedule-duration").value = duration;
    document.getElementById("reschedule-participants").value = participants;
    document.getElementById("reschedule-price").value = price;
    
    // Display reservation details in the modal
    document.getElementById("modal-court-name").textContent = courtName;
    document.getElementById("modal-event").textContent = event;
    document.getElementById("modal-duration").textContent = duration;
    document.getElementById("modal-participants").textContent = participants;
    document.getElementById("modal-current-date").textContent = date;
    document.getElementById("modal-current-time").textContent = formatTimeDisplay(time);
    document.getElementById("modal-section").textContent = section;

   
    // Set minimum date to today
    const today = new Date();
    const formattedToday = today.toISOString().split('T')[0];
    document.getElementById("reschedule-date").min = formattedToday;
    
    // Set the current date as default
    document.getElementById("reschedule-date").value = date;
    
    // Populate time slots based on duration
    populateTimeSlots(duration, time);
    

    // Show the modal
    document.getElementById("reschedule-modal").style.display = "block";
    setTimeout(() => {
        document.querySelector('#reschedule-modal .popup-content').classList.add('active');
    }, 10);
}


function closeRescheduleModal() {
    document.querySelector('#reschedule-modal .popup-content').classList.remove('active');
    setTimeout(() => {
        document.getElementById("reschedule-modal").style.display = "none";
    }, 300);
}

function populateTimeSlots(duration, currentTime) {
    const timeSelect = document.getElementById("reschedule-time");
    timeSelect.innerHTML = ""; // Clear existing options
    
    // Define available time slots based on duration
    let timeSlots = [];
    
    if (duration === "1 hour") {
        timeSlots = ["08:00:00", "09:00:00", "10:00:00", "11:00:00", "12:00:00", 
                     "13:00:00", "14:00:00", "15:00:00", "16:00:00", "17:00:00"];
    } else if (duration === "2 hour") {
        timeSlots = ["08:00:00", "10:00:00", "13:00:00", "15:00:00"];
    } else if (duration === "half") {
        timeSlots = ["08:00:00", "13:00:00"];
    } else if (duration === "full") {
        timeSlots = ["08:00:00"];
    }
    
    // Create and append options
    timeSlots.forEach(time => {
        const option = document.createElement("option");
        option.value = time;
        option.textContent = formatTimeDisplay(time);
        
        // Set current time as selected
        if (time === currentTime) {
            option.selected = true;
        }
        
        timeSelect.appendChild(option);
    });
    
    // If it's a half-day booking, check availability immediately
    if (duration === 'half') {
        checkAvailability();
    }
}

function formatTimeDisplay(timeString) {
    // Convert 24-hour format to 12-hour format with AM/PM
    if (!timeString) return "";
    
    const [hours, minutes] = timeString.split(':');
    const hour = parseInt(hours);
    const ampm = hour >= 12 ? 'PM' : 'AM';
    const hour12 = hour % 12 || 12;
    return `${hour12}:${minutes || '00'} ${ampm}`;
}

//checking avaialbility
// Add this to your existing script section
// Add this to your existing script section
document.addEventListener('DOMContentLoaded', function() {
    // Get the date input element
    const dateInput = document.getElementById('reschedule-date');
    
    // Add event listener for date change
    if (dateInput) {
        dateInput.addEventListener('change', function() {
            checkAvailability();
        });
    }
});
function checkAvailability() {
    const date = document.getElementById('reschedule-date').value;
    const courtId = document.getElementById('reschedule-court-id').value;
    const duration = document.getElementById('reschedule-duration').value;
    const section = document.getElementById('modal-section').textContent;
    
    // Clear previous messages
    const availabilityMessage = document.getElementById('availability-message');
    if (availabilityMessage) {
        availabilityMessage.style.display = 'none';
    }
    
    // Only proceed if we have a date and courtId
    if (!date || !courtId) return;
    
    // Create form data for the AJAX request
    const formData = new FormData();
    formData.append('date', date);
    formData.append('courtid', courtId);
    formData.append('duration', duration);
    formData.append('section', section);
    
    // Send AJAX request
    fetch('<?= ROOT ?>/external/reservation/checkAvailability', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
    if (!data.available) {
        // Show unavailability message
        availabilityMessage.textContent = data.message;
        availabilityMessage.className = "alert alert-danger";
        availabilityMessage.style.display = 'block';
        
        // Disable the submit button
        document.querySelector('#reschedule-form .confirm-btn').disabled = true;
    } else {
        // Enable the submit button if date is available
        document.querySelector('#reschedule-form .confirm-btn').disabled = false;
        
        // Handle disabled slots for different durations
        if ((duration === '1 hour' || duration === '2 hour' || duration === 'half') && data.disabledSlots) {
            updateTimeSlotOptions(data.disabledSlots);
        }
    }
})

    .catch(error => {
        console.error('Error checking availability:', error);
    });
}

function updateTimeSlotOptions(disabledSlots) {
    const timeSelect = document.getElementById('reschedule-time');
    const options = timeSelect.options;
    
    // Enable all options first
    for (let i = 0; i < options.length; i++) {
        options[i].disabled = false;
    }
    
    // Disable specific slots
    for (let i = 0; i < options.length; i++) {
        const optionValue = options[i].value;
        
        if (disabledSlots.includes(optionValue)) {
            options[i].disabled = true;
        }
    }
    
    // If the currently selected option is disabled, select the first available option
    if (timeSelect.selectedOptions[0].disabled && options.length > 0) {
        for (let i = 0; i < options.length; i++) {
            if (!options[i].disabled) {
                timeSelect.selectedIndex = i;
                break;
            }
        }
    }
}

// Add this to your existing script
document.addEventListener('DOMContentLoaded', function() {
    // Check for reschedule success parameter in URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('reschedule') === 'success') {
        document.getElementById("reschedule-success-modal").style.display = "block";
        setTimeout(() => {
            document.querySelector('#reschedule-success-modal .popup-content').classList.add('active');
        }, 10);
    }
});

function closeRescheduleSuccessModal() {
    document.querySelector('#reschedule-success-modal .popup-content').classList.remove('active');
    setTimeout(() => {
        document.getElementById("reschedule-success-modal").style.display = "none";
        // Remove the query parameter from URL
        const url = new URL(window.location);
        url.searchParams.delete('reschedule');
        window.history.replaceState({}, '', url);
    }, 300);
}



        </script>
    </body>
</html>
