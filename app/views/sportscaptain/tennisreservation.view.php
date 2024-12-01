<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/reservation.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>

    <div class="navbar">
    <a href="groundreservation">Ground Reservations</a>
        <a href="indoorreservation">Indoor Reservations</a>
        <a href="bascketballreservation">Basketball Court Reservations</a>
        <a href="tennisreservation">Tennis Court Reservations</a>
    </div>
    <div class="main-content">
        <main>
            <div class="header">
                <h1>Tennis Court Reservations</h1>
            </div>
            <div class="container">
                <section class="calendar-section">
                    <div class="calendar">
                        <div class="calendar-header">
                            <span id="prev" class="nav_cal"><i class="uil uil-arrow-left"></i></span>
                            <span id="month-year"></span>
                            <span id="next" class="nav_cal"><i class="uil uil-arrow-right"></i></span>
                        </div>
                        <div class="calendar-body">
                            <div class="days">
                                <div>Mon</div>
                                <div>Tue</div>
                                <div>Wed</div>
                                <div>Thu</div>
                                <div>Fri</div>
                                <div>Sat</div>
                                <div>Sun</div>
                            </div>
                            <div class="dates" id="dates"></div>
                        </div>
                    </div>
                </section>

                <aside class="controls-section">
                    <div class="facilities">
                        <h1>Reserve a Time Slot</h1>
                        <div id="time-slots" class="time-slots">
                            <!-- Time slots will appear here -->
                        </div>
                    </div>
                </aside>   
            </div>
            <div class="previous-reservations">
                <h2>Previous Reservations</h2>
                <div id="reservation-list">
                    <!-- Previous reservations will be shown here -->
                </div>
            </div>
        </main>

        <!-- Reservation Modal -->
        <div id="reservationModal" class="modal">
            <div class="modal-content">
                <span class="close-button">&times;</span>
                <h2>Make a Reservation</h2>
                <form id="reservationForm">
                    <div class="form-group">
                        <label for="title">Reason</label>
                        <input type="text" id="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="selectedTime">Time Slot</label>
                        <input type="text" id="selectedTime" readonly>
                    </div>
                    <div class="form-group">
                        <label for="selectedDate">Date</label>
                        <input type="date" id="selectedDate" readonly>
                    </div>
                    <button type="submit" class="submit-button">Submit Reservation</button>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="<?=ROOT?>/assets/js/vidusha/reservation.js"></script>
</body>
</html>
