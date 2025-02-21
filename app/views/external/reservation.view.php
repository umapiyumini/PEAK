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
        <h2>Active Reservations</h2>
        <div class="reservations-grid">
            <?php if (!empty($reservations)) : ?>
                <?php foreach ($reservations as $res) : ?>
                    <div class="reservation-card">
                        <p><strong>Facility:</strong> <?= htmlspecialchars($res->facility) ?></p>
                        <p><strong>Reservation ID:</strong> <?= htmlspecialchars($res->reservationid) ?></p>
                        <p><strong>Event:</strong> <?= htmlspecialchars($res->event) ?></p>
                        <p><strong>Date:</strong> <?= htmlspecialchars($res->date) ?></p>
                        <p><strong>Time:</strong> <?= htmlspecialchars($res->time) ?></p>
                        <p><strong>Price:</strong> Rs.<?= htmlspecialchars($res->price) ?></p>
                        <p><strong>Status:</strong> <span class="status <?= strtolower($res->status) ?>"><?= htmlspecialchars($res->status) ?></span></p>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No active reservations found.</p>
            <?php endif; ?>
         <div class="reservation-card new-reservation">
                <a href="pickfacility">
                    <div class="plus-icon"><img src="<?=ROOT?>/assets/images/booking.webp"></div>
                </a>
                <a href="pickfacility"><p>New Reservation</p></a>
            </div>
        </div>
    </div>
</section>

               
<div class="container1">
    <h2>Reservation History</h2>
    <div class="reservation-history">
        <div class="filter">
            <label for="statusFilter">Filter by Status:</label>
            <select id="statusFilter" onchange="filterTable()">
                <option value="all">All</option>
                <option value="Pending">Pending</option>
                <option value="Confirmed">To Pay</option>
                <option value="Paid">Paid</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>
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
                <?php if (!empty($reservations)) : ?>
                    <?php foreach ($reservations as $reservation) : ?>
                        <tr>
                            <td><?= htmlspecialchars($reservation->date); ?></td>
                            <td><?= htmlspecialchars($reservation->facility); ?></td>
                            <td>Rs.<?= htmlspecialchars($reservation->price); ?></td>
                            <td><?= htmlspecialchars($reservation->status); ?></td>
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

                </section>

                <div id="cancel-popup" class="popup">
    <div class="popup-content">
        <span class="close-icon" onclick="closePopup()">&times;</span>
        <h3>Cancel Reservation</h3>
        <form id="cancel-form">
            <p><strong>Reservation ID:</strong></p>
            <input type="text" id="reservation-id" name="reservation-id" readonly>

            <p><strong>Full Name:</strong></p>
            <input type="text" id="full-name" name="full-name" readonly>

            <p><strong>Reason for Cancellation:</strong></p>
            <textarea id="cancellation-reason" name="cancellation-reason" placeholder="Enter reason..." required></textarea>

            <div class="popup-buttons">
               
                <button type="submit" class="confirm-btn">Confirm Cancellation</button>
            </div>
        </form>
    </div>
</div>

               
        </div>


        
        </body>

        <script >

function filterTable() {
    const filter = document.getElementById("statusFilter").value;
    const rows = document.querySelectorAll(".reservation-history tbody tr");

    rows.forEach(row => {
        const status = row.cells[3].textContent.trim(); // Corrected index to 3
        if (filter === "all" || status.toLowerCase() === filter.toLowerCase()) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}


// updating file name
// JavaScript to display the chosen file name
document.getElementById("file-upload").addEventListener("change", function() {
    const fileName = this.files[0] ? this.files[0].name : "No file chosen";
    document.getElementById("file-chosen").textContent = fileName;
});

//------------------------------ pop up
function openCancelPopup(reservationId, fullName) {
    // Autofill Reservation ID and Full Name
    document.getElementById("reservation-id").value = reservationId;
    document.getElementById("full-name").value = fullName;

    // Show Popup
    document.getElementById("cancel-popup").style.display = "block";
}

function closePopup() {
    // Hide Popup
    document.getElementById("cancel-popup").style.display = "none";
}

function confirmCancellation() {
    const reason = document.getElementById("cancellation-reason").value;
    if (!reason) {
        alert("Please provide a reason for cancellation.");
        return false;
    }
    alert("Cancellation request submitted!");
    closePopup();
}

        </script>
        </html>