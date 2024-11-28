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
                        
                        <!-- Reservation 1 -->
                        <div class="reservation-card">
                        <a href="#"><div class="close-btn">
                        <div class="tooltip">
                        <img src="<?=ROOT?>/assets/images/uma/garbage.png" alt="Delete Reservation" class="delete-icon" onclick="openCancelPopup()">
                        <span class="tooltip-text">Cancel Reservation</span>
                        </div></div></a>
                            <p><strong>Facility:</strong> Ground</p>
                            <p><strong>Reservation ID:</strong> 01</p>
                            <p><strong>Event:</strong> New Year</p>
                            <p><strong>Date:</strong> 12.04.25</p>
                            <p><strong>Time:</strong> 15:00 - 19:00</p>
                            <p><strong>Price:</strong> Rs.14000</p>
                            <p><strong>Status:</strong> <span class="status pending">Pending</span></p>
                            
                        </div>
            
                        <!-- Reservation 2 -->
                        <div class="reservation-card">
                        <a href="#"><div class="close-btn">
                        <div class="tooltip">
                        <img src="<?=ROOT?>/assets/images/uma/garbage.png" alt="Delete Reservation" class="delete-icon" onclick="openCancelPopup()">
                        <span class="tooltip-text">Cancel Reservation</span>
                        </div></div></a>
                            <p><strong>Facility:</strong> Ground</p>
                            <p><strong>Reservation ID:</strong> 02</p>
                            <p><strong>Event:</strong> New Year</p>
                            <p><strong>Date:</strong> 12.04.25</p>
                            <p><strong>Time:</strong> 15:00 - 19:00</p>
                            <p><strong>Price:</strong> Rs.14000</p>
                            <p><strong>Status:</strong> <span class="status accepted">Accepted :<a href="https://pay.cmb.ac.lk/?_gl=1*k59fjr*_ga*MjUxMTAxODczLjE2ODY5ODIwMjU.*_ga_9NP480MYRZ*MTczMjQ1MzY2OC4xOS4xLjE3MzI0NTM3MTAuMTguMC4w"> Click to pay</span></a></p>
                            <p>Upload payment proof
                                <label for="file-upload" class="file-upload-label">Choose file</label>
                                <input type="file" id="file-upload" class="file-upload" required>
                                <span id="file-chosen" class="file-upload-chosen">No file chosen</span>
                            </p>

                        </div>
            
                        <!-- Reservation 3 -->
                        <div class="reservation-card">
                        <a href="#"><div class="close-btn">
                        <div class="tooltip">
                        <img src="<?=ROOT?>/assets/images/uma/garbage.png" alt="Delete Reservation" class="delete-icon" >
                        <span class="tooltip-text">Please contact the PED for cancellation of paid reservations</span>
                        </div></div></a>
                        <p><strong>Facility:</strong> Ground</p>
                            <p><strong>Reservation ID:</strong> 03</p>
                            <p><strong>Event:</strong> New Year</p>
                            <p><strong>Date:</strong> 12.04.25</p>
                            <p><strong>Time:</strong> 15:00 - 19:00</p>
                            <p><strong>Price:</strong> Rs.14000</p>
                            <p><strong>Status:</strong> <span class="status paid">Paid</span></p>
                           
                        </div>
            
                        <!-- New Reservation Card -->
                        <div class="reservation-card new-reservation">
                            <a href="pickfacility">
                                <div class="plus-icon"><img src="<?=ROOT?>/assets/images/booking.webp"></div>
                                
                            </a>
                            <a href="pickfacility">
                            <p>New Reservation</p></a>
                        </div>
            
                    </div>

                </div>
                <div class="container1">
                    <h2>Reservation History</h2>
                    <div class="reservation-history">
                        
                        <div class="filter">
                        <label for="statusFilter">Filter by Status:</label>
                        <select id="statusFilter" onchange="filterTable()">
                        <option value="all">All</option>
                        <option value="Pending">Pending</option>
                        <option value="To Pay">To Pay</option>
                        <option value="Paid">Paid</option>
                        <option value="Cancelled">Cancelled</option>
                        </select></div>
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
                                <tr>
                                    <td>2024-10-01</td>
                                    <td>Basketball Court</td>
                                    <td>Rs.15000</td>
                                    <td>To Pay</td>
                                </tr>
                                <tr>
                                    <td>2024-09-20</td>
                                    <td>Tennis Court</td>
                                    <td>Rs.9000</td>
                                    <td>Pending</td>
                                </tr>
                                <tr>
                                    <td>2024-08-15</td>
                                    <td>Indoor Stadium</td>
                                    <td>Rs.5000</td>
                                    <td>Cancelled</td>
                                </tr>
        
                                <tr>
                                    <td>2024-08-15</td>
                                    <td>badminton court</td>
                                    <td>Rs.3000</td>
                                    <td>paid</td>
                                </tr>
        
                                <tr>
                                    <td>2024-08-15</td>
                                    <td>tennis court</td>
                                    <td>Rs.10000</td>
                                    <td>Cancelled</td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
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