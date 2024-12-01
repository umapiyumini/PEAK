<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tournament Records</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/tournaments.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
  <?php $current_page = 'tournament'; include 'sidebar.view.php'?>

  <!-- Header and Main Content -->
  <div class="main-content">

    <div class="container">
      <div class="header">
          <h1>Tournament Records</h1>
          <button class="bell-icon"><i class="uil uil-bell"></i></button>
            <!-- <div class="notifications-dropdown">
                <div class="notifications-header">
                    <h3>Notifications</h3>
                    <span class="clear-all">Clear All</span>
                </div>
                <div class="notifications-list">
                    <ul id="notificationsList"></ul>
                </div>
              </div> -->
            <button class="bell-icon"><i class="uil uil-signout"></i></button>
        </div>
      </div>
      <main>
      <div class="sub-header">
            <h2 class="sub-topic">Inter Faculty Games</h2>
            </div>
        <div class="filters">
          <div class="filter-group">
            <label for="search">Search</label>
            <input type="text" id="search" placeholder="Search tournaments...">
          </div>
          <div class="filter-group">
            <label for="sport">Sport</label>
            <select id="sport">
              <option value="">All Sports</option>
              <option value="basketball">Basketball</option>
              <option value="soccer">Soccer</option>
              <option value="volleyball">Volleyball</option>
            </select>
          </div>
          <div class="filter-group">
            <label for="year">Year</label>
            <select id="year">
              <option value="">All Years</option>
              <option value="2024">2024</option>
              <option value="2023">2023</option>
              <option value="2022">2022</option>
            </select>
          </div>
          <!-- <button class="btn btn-add" onclick="openModal('Add Tournament')">Add Tournament</button> -->
        </div>

        <div class="records-table">
          <table>
            <thead>
              <tr>
                <th>Tournament Name</th>
                <th>Sport</th>
                <th>Date</th>
                <th>Places</th>
                <th>Men/Women</th>
                <th>Venue</th>
                <th>Participants</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="tournamentsBody">
            </tbody>
          </table>
        </div>
      </div>

      <!-- Add/Edit Tournament Modal -->
      <div id="tournamentModal" class="modal">
        <div class="modal-content">
          <div class="modal-header">
            <h2 id="modalTitle">Add Tournament</h2>
            <span class="close" onclick="closeModal()">&times;</span>
          </div>
          <form id="tournamentForm" onsubmit="saveTournament(event)">
            <input type="hidden" id="tournamentId">
            <div class="form-group">
              <label for="name">Tournament Name</label>
              <input type="text" id="name" required>
            </div>
            <div class="form-group">
              <label for="sportInput">Sport</label>
              <select id="sportInput" required>
                <option value="basketball">Basketball</option>
                <option value="soccer">Soccer</option>
                <option value="volleyball">Volleyball</option>
              </select>
            </div>
            <div class="form-group">
              <label for="date">Date</label>
              <input type="date" id="date" required>
            </div>
            <div class="form-group">
              <label for="place">Place</label>
              <input type="text" id="place" required>
            </div>
            <div class="form-group">
              <label for="men_women">Men/Women</label>
              <input type="text" id="men_women" required>
            </div>
            <div class="form-group">
              <label for="venue">Venue</label>
              <input type="text" id="venue" required>
            </div>
            <div class="form-group">
              <label for="participants">Number of Participants</label>
              <input type="number" id="participants" required min="2">
            </div>
            <div class="form-group">
              <label>Participants' Registration Numbers</label>
              <div id="participantsContainer">
          <!-- Participant input fields will go here -->
              </div>
          <button type="button" class="btn btn-add" onclick="addParticipant()">Add Participant</button>
         </div>
            <button type="submit" class="btn btn-add">Save Tournament</button>
          </form>
        </div>
      </div>

     <!-- Add this HTML for the view modal structure -->
<div id="viewTournamentModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Tournament Details</h2>
            <span class="close" onclick="closeViewModal()">&times;</span>
        </div>
        <div class="modal-body">
            <div class="details-grid">
                <div class="detail-item">
                    <label>Tournament Name:</label>
                    <span id="viewName"></span>
                </div>
                <div class="detail-item">
                    <label>Sport:</label>
                    <span id="viewSport"></span>
                </div>
                <div class="detail-item">
                    <label>Date:</label>
                    <span id="viewDate"></span>
                </div>
                <div class="detail-item">
                    <label>Place:</label>
                    <span id="viewPlace"></span>
                </div>
                <div class="detail-item">
                    <label>Category:</label>
                    <span id="viewMenWomen"></span>
                </div>
                <div class="detail-item">
                    <label>Venue:</label>
                    <span id="viewVenue"></span>
                </div>
            </div>
            <div class="participants-section">
                <h3>Participants</h3>
                <div id="viewParticipantsList" class="participants-list"></div>
            </div>
        </div>
    </div>
</div>
    </main>
  </div>

 

  <script src="<?=ROOT?>/assets/js/ped_incharge/tournaments.js"></script>
</body>
</html>