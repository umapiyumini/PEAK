<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tournament Records</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/tournaments.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/ped.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
  

  <!-- Header and Main Content -->
  <!-- Header and Main Content -->
  <div class="main-content">
    <main>
      <div class="container">
        <div class="header">
          <h1>Tournament Records</h1>
          <div class="tabs">
          <button class="tab-button active" id="inter-university" onclick="switchTab('inter-university')">Inter-University</button>
          <button class="tab-button" id="inter-faculty" onclick="switchTab('inter-faculty')">Inter-Faculty</button>
          <button class="tab-button" id="freshers-meet" onclick="switchTab('freshers-meet')">Freshers Meet</button>

          </div>
        </div>

        <div class="filters">
          <div class="filter-group">
            <label for="search">Search</label>
            <input type="text" id="search" placeholder="Search tournaments...">
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
        </div>

        <!-- Tournament Categories -->
        <div id="inter-university" class="tab-content active">
          <h2>Inter University Games</h2>
          <div class="records-table">
            <table>
              <thead>
                <tr>
                  <th>Tournament Name</th>
                  <th>Year</th>
                  <th>Place</th>
                  <th>Venue</th>
                  <th>No of Players</th>
                  <th>Players Reg No</th>
                </tr>
              </thead>
              <tbody id="interUniversityTournamentsBody">
                <!-- Inter University tournaments will be inserted here -->
              </tbody>
            </table>
          </div>
        </div>

        <div id="inter-faculty" class="tab-content">
          <h2>Inter Faculty Games</h2>
          <div class="records-table">
            <table>
              <thead>
                <tr>
                  <th>Tournament Name</th>
                  <th>Year</th>
                  <th>Place</th>
                  <th>Venue</th>
                  <th>Faculty</th>
                  <th>No of Players</th>
                </tr>
              </thead>
              <tbody id="interFacultyTournamentsBody">
                <!-- Inter Faculty tournaments will be inserted here -->
              </tbody>
            </table>
          </div>
        </div>

        <div id="freshers-meet" class="tab-content">
          <h2>Freshers Meet</h2>
          <div class="records-table">
            <table>
              <thead>
                <tr>
                  <th>Tournament Name</th>
                  <th>Year</th>
                  <th>Place</th>
                  <th>Venue</th>
                  <th>No of Players</th>
                </tr>
              </thead>
              <tbody id="freshersMeetTournamentsBody">
                <!-- Freshers Meet tournaments will be inserted here -->
              </tbody>
            </table>
          </div>
        </div>

      </div>

      <!-- Add/Edit Tournament Modal -->
      <div id="tournamentModal" class="modal">
        <div class="modal-content">
          <div class="modal-header">
            <h2 id="modalTitle">Request the change Tournament</h2>
            <span class="close" onclick="closeModal()">&times;</span>
          </div>
          <form id="tournamentForm" onsubmit="saveTournament(event)">
            <input type="hidden" id="tournamentId">
            <div class="form-group">
              <label for="name">Tournament Name</label>
              <input type="text" id="name" required>
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
              <label for="venue">Venue</label>
              <input type="text" id="venue" required>
            </div>
            <div class="form-group">
              <label for="participants">Number of Participants</label>
              <input type="number" id="participants" required min="2">
            </div>
            <button type="submit" class="btn btn-add">Submit</button>
          </form>
        </div>
      </div>

      <!-- Participants Modal -->
      <div id="participantsModal" class="modal">
        <div class="modal-content">
          <div class="modal-header">
            <h2>Tournament Participants</h2>
            <span class="close" onclick="closeModal()">&times;</span>
          </div>
          <div class="participants-list">
            <!-- Participant list will be dynamically inserted here -->
          </div>
        </div>
      </div>
    </main>
  </div>
  <script src="<?=ROOT?>/assets/js/vidusha/tournaments.js"></script>
</body>
</html>