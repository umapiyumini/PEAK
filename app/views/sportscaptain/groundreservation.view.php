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
            <h1>Ground Reservations</h1>
            <div class="category-selector">
                <button class="category-button" data-category="cricket"> Cricket Pitch</button>
                <button class="category-button" data-category="hockey"> Hockey Court</button>
                <button class="category-button" data-category="rugger"> Rugger Court/Football Court</button>
                <button class="category-button" data-category="elle"> Elle Pitch</button>
                <button class="category-button" data-category="fullground"> Full Ground</button>
            </div>
        </div>
        <div class="container">
            <section class="calendar-section">
                <div class="calendar">
                    <div class="calendar-header">
                        <span id="prev-month" class="nav_cal"><i class="uil uil-arrow-left"></i></span>
                        <span id="month-year"></span>
                        <span id="next-month" class="nav_cal"><i class="uil uil-arrow-right"></i></span>
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
                        <div class="calendar-dates" id="dates">
                            <!-- Dates dynamically inserted here -->
                        </div>
                    </div>
                </div>
            </section>
            <aside class="controls-section">
                <div class="facilities">
                    <h1>Reserve a Time Slot</h1>
                    <div id="time-slots" class="time-slots">
                        <!-- Time slots dynamically based on category -->
                    </div>
                </div>
            </aside>   
        </div>
        <div class="previous-reservations">
            <h2>Previous Reservations</h2>
            <div id="reservation-list">
                <!-- Previous reservations dynamically populated -->
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
                    <label for="category">Category</label>
                    <input type="text" id="category" readonly>
                </div>
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



    <!-- JavaScript -->
    <script src="<?=ROOT?>/assets/js/vidusha/groundreservation.js"></script>
</body>
</html>
