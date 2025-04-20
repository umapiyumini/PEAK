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

        <!-- <div class="container1">
    <div class="reservation-header">
        <h2>Active Reservations</h2>
        
    </div> -->



        <section class="statusboard">
        <div class="container1">
    <div class="reservation-header">
        <h2>Active Reservations</h2>
        <a href="pickfacility" class="new-reservation-icon" title="New Reservation">
            <img src="<?=ROOT?>/assets/images/booking.webp" alt="New Reservation">
        </a>
    </div>

        <div class="reservations-grid">
        <?php foreach ($reservations as $res) : ?>
    <div class="reservation-card">
        <p><strong>Facility:</strong> <?= htmlspecialchars($res->courtname) ?></p>
        <p><strong>Reservation ID:</strong> <?= htmlspecialchars($res->reservationid) ?></p>
        <p><strong>Event:</strong> <?= htmlspecialchars($res->event) ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($res->date) ?></p>
        <p><strong>Time:</strong> <?= htmlspecialchars($res->time) ?></p>
        <p><strong>Price:</strong> Rs.<?= htmlspecialchars($res->price) ?></p>
        <p><strong>Status:</strong> 
            <span class="status <?= strtolower($res->status) ?>">
                <?= htmlspecialchars($res->status) ?>
            </span>
        </p>

        <?php if (str_replace(' ', '', strtolower($res->status)) === 'topay') : ?>

            <form method="POST" action="<?= ROOT ?>/external/pay">
                <input type="hidden" name="reservationid" value="<?= htmlspecialchars($res->reservationid) ?>">
                <input type="hidden" name="discountedprice" value="<?= htmlspecialchars($res->discountedprice) ?>">
                <button class="pay-now-btn" type="submit">Pay Now</button>
            </form>
        <?php endif; ?>
        <a href="<?= ROOT ?>/external/<?= strtolower($res->courtname) ?>form?reservationid=<?= htmlspecialchars($res->reservationid) ?>" class="btn btn-secondary">Reschedule</a>
        <br>
        <a href="javascript:void(0);" onclick="openCancelPopup('<?= htmlspecialchars($res->reservationid) ?>', '<?= htmlspecialchars($_SESSION['username'] ?? '') ?>')" class="cancel-link">
        Cancel
        </a>
   
    </div>
    
<?php endforeach; ?>

        
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
                            <td><?= htmlspecialchars($reservation->courtname); ?></td>
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
function openCancelPopup(reservationId) {
    document.getElementById("reservation-id").value = reservationId;
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