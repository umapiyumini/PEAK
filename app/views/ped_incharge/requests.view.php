<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requests</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/requests.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <?php $current_page = 'reservation'; include 'sidebar.view.php'?>

    <!-- Header and Main Content -->
    
    <!-- <div class="main-content"> -->
    <div class="main-content">
        <div class="header">
        <button onclick="history.back()" class="goBackButton"><i class="uil uil-arrow-left"></i></button>
            <h1>Reservation Requests</h1>
            <button class="bell-icon"><i class="uil uil-bell"></i></button>
            <div class="notifications-dropdown">
                <div class="notifications-header">
                    <h3>Notifications</h3>
                    <span class="clear-all">Clear All</span>
                </div>
                <div class="notifications-list">
                    <ul id="notificationsList"></ul>
                </div>
            </div>
            
            <button class="bell-icon"><i class="uil uil-signout"></i></button>
        </div>

        <main>
        
        <div class="events-requests">
            <!-- <div class="view-options">
                <button class="view-option" id="tableBtn" onclick="showTable()">Table</button>
                <button class="view-option active" id="boardBtn" onclick="showBoard()">Board</button>
            </div> -->
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search...">
                <i class="uil uil-search"></i>
            </div>
            <!-- <button class="sort-btn"><i class="uil uil-filter"></i></button> -->
        </div>


    <div id="board" class="board">
        <!-- New Column -->
        <div class="column new" id="newColumn" onmouseup="dropCard('newColumn')" style="background-color: #FFF;">
            <h2><span class="dot new"></span> New <span class="count">2</span></h2>
            <div class="card sports" onclick="pickUpCard(event)" data-id="205176503">
                <p class="facility">Cricket Pitch</p>
                <p class="reservation-id">ID: 01</p>
                <p class="event">Matchr</p>
                <p class="date">12.04.25</p>
                <p class="time">15:00 - 19:00</p>
            </div>

            <div class="card external" onclick="pickUpCard(event)" data-id="205176503">
                <p class="facility">Rugby Court</p>
                <p class="reservation-id">ID: 02</p>
                <p class="event">New Year</p>
                <p class="date">12.04.25</p>
                <p class="time">15:00 - 19:00</p>
            </div>
        </div>

        <!-- In Progress Column -->
        <div class="column progress" id="newColumn" onmouseup="dropcard('newColumn')" style="background-color: #FFF;">
            <h2><span class="dot in-progress"></span> In Progress <span class="count">11</span></h2>
            <div class="card external" onclick="pickUpCard(event)" data-id="205176503">
                <p class="facility">Full Ground</p>
                <p class="reservation-id">ID: 03</p>
                <p class="event">Athletic Heats</p>
                <p class="date">12.04.25</p>
                <p class="time">15:00 - 19:00</p>
            </div>
        </div>
        <!-- awaiting column -->
        <div class="column awaiting" id="newColumn" onmouseup="dropCard('newColumn')" style="background-color: #FFF;">
            <h2><span class="dot awaiting"></span> Awaiting<span class="count">11</span></h2>
            <div class="card sports" onclick="pickUpCard(event)" data-id="205176503">
                <p class="facility">Hockey Court</p>
                <p class="reservation-id">ID: 04</p>
                <p class="event">Match</p>
                <p class="date">12.04.25</p>
                <p class="time">15:00 - 19:00</p>
            </div>

            <div class="card sports" onclick="pickUpCard(event)" data-id="205176503">
                <p class="facility">Full Ground</p>
                <p class="reservation-id">ID: 05</p>
                <p class="event">New Year</p>
                <p class="date">12.04.25</p>
                <p class="time">15:00 - 19:00</p>
            </div>

            <div class="card external" onclick="pickUpCard(event)" data-id="205176503">
                <p class="facility">Elle court</p>
                <p class="reservation-id">ID: 06</p>
                <p class="event">Practice Match</p>
                <p class="date">12.04.25</p>
                <p class="time">15:00 - 19:00</p>
            </div>

            <div class="card external" onclick="pickUpCard(event)" data-id="205176503">
                <p class="facility">Full Ground</p>
                <p class="reservation-id">ID: 06</p>
                <p class="event">New Year</p>
                <p class="date">16.04.25</p>
                <p class="time">15:00 - 19:00</p>
            </div>

            <div class="card sports" onclick="pickUpCard(event)" data-id="205176503">
                <p class="facility">Rugby Court</p>
                <p class="reservation-id">ID: 06</p>
                <p class="event">Practices</p>
                <p class="date">12.04.25</p>
                <p class="time">15:00 - 19:00</p>
            </div>
            <!-- Add more cards as needed -->
        </div>

        <div class="column done" id="newColumn" onmouseup="dropCard('newColumn')" style="background-color: #FFF;">
            <h2><span class="dot done"></span>Accepted<span class="count">11</span></h2>
            <div class="card sports" onclick="pickUpCard(event)" data-id="205176503">
                <p class="facility">Elle Court</p>
                <p class="reservation-id">ID: 10</p>
                <p class="event">Practices</p>
                <p class="date">12.04.25</p>
                <p class="time">15:00 - 19:00</p>
            </div>
            <!-- Add more cards as needed -->
        </div>

        <!-- cancelled column -->
        <div class="column cancelled" id="newColumn" onmouseup="dropCard('newColumn')" style="background-color: #FFF;">
            <h2><span class="dot cancelled"></span> Cancelled <span class="count">11</span></h2>
            <div class="card sports" onclick="pickUpCard(event)" data-id="205176503">
                <p class="facility">Cricket Pitch</p>
                <p class="reservation-id">ID: 11</p>
                <p class="event">Practice Match</p>
                <p class="date">12.04.25</p>
                <p class="time">15:00 - 19:00</p>
            </div>
            <!-- Add more cards as needed -->
        </div>

        <!-- rejected column -->
        <div class="column rejected" style="background-color: #FFF;">
            <h2><span class="dot rejected"></span> Rejected <span class="count">11</span></h2>
            <div class="card external" onclick="pickUpCard(event)" data-id="205176503">
                <p class="facility">Hockey Court</p>
                <p class="reservation-id">ID: 12</p>
                <p class="event">Match</p>
                <p class="date">12.04.25</p>
                <p class="time">15:00 - 19:00</p>
            </div>
            <!-- Add more cards as needed -->
        </div>


</main>
</div>

<div id="table" class="table" style="display:none;">
    <?php include 'requests_table.php'?>
</div>

   
    <!-- reservation details modal -->
<div id="actionModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="modal-header">
            <h2>Reservation Details</h2>
        </div>
        <div class="modal-body">
            <div class="details-grid">
                <div class="basic-info">
                    <h3>Basic Information</h3>
                    <div id="requestInfo"></div>
                </div>
                <div class="additional-info">
                    <h3>Additional Information</h3>
                    <div id="additionalInfo">
                        <div class="info-row">
                            <label>Company:</label>
                            <span id="company"></span>
                        </div>
                    <div id="additionalInfo">
                        <div class="info-row">
                            <label>Contact Person:</label>
                            <span id="contactPerson"></span>
                        </div>
                        <div class="info-row">
                            <label>Phone:</label>
                            <span id="phone"></span>
                        </div>
                        <div class="info-row">
                            <label>Email:</label>
                            <span id="email"></span>
                        </div>
                        <div class="info-row">
                            <label>Number of Participants:</label>
                            <span id="participants"></span>
                        </div>
                        <div class="info-row">
                            <label>Special Requirements:</label>
                            <span id="requirements"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="modalActions" class="modal-footer">
            <!-- Action buttons will be dynamically inserted here -->
        </div>
    </div>
<!-- </div> -->

  

    <script src="<?=ROOT?>/assets/js/ped_incharge/requests.js"></script>
    <script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>

</body>
</html>
