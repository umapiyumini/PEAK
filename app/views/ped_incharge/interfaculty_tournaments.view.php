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
        <button class="bell-icon"><i class="uil uil-signout"></i></button>
      </div>
    </div>
    <main>
      <div class="tournament-type">
        <div class="grid-item interfacullty" id="interfaculty">
          <a><h3>Inter Faculty</h3></a>
        </div>
        <div class="grid-item freshers" id="freshers">
            <a><h3>Freshers</h3></a>
        </div>
      </div>
      <div class="interfaculty-tournaments" id="interfaculty-tournaments">          
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
        </div>

        <div class="records-table">
          <table id="interfacultyTable">
            <div class="sub-header">
              <h2 class="sub-topic">Inter Faculty Games</h2>
            </div>
            <thead>
              <tr>
                <th>Sport</th>
                <th>Year</th>
                <th>1st Place</th>
                <th>2nd Place</th>
                <th>3rd Place</th>
                <th>Men/Women</th>
                <th>Actions</th>
              </tr>
            </thead>
            <!-- In your view file where you display the tournaments -->
            <tbody id="tournamentsBody">
              <?php if(!empty($interfacultyrecords)): ?>
                <?php foreach ($interfacultyrecords as $record): ?>
                  <tr>
                    <td><?= $record['tournament_info']->sport_name ?></td>
                    <td><?= $record['tournament_info']->year ?></td>
                    <td><?= isset($record['places'][1]) ? $record['places'][1]->faculty_name : '' ?></td>
                    <td><?= isset($record['places'][2]) ? $record['places'][2]->faculty_name : '' ?></td>
                    <td><?= isset($record['places'][3]) ? $record['places'][3]->faculty_name : '' ?></td>
                    <td><?= $record['tournament_info']->category ?></td>
                    <td>
                      <button 
                        class="btn btn-view" 
                        onclick="viewTournament(this)"
                        data-tournamentid="<?= $record['tournament_info']->recordid ?>"
                        data-sport="<?= $record['tournament_info']->sport_name ?>"
                        data-date="<?= $record['tournament_info']->year ?>"
                        data-place1="<?= isset($record['places'][1]) ? $record['places'][1]->faculty_name : '' ?>"
                        data-place2="<?= isset($record['places'][2]) ? $record['places'][2]->faculty_name : '' ?>"
                        data-place3="<?= isset($record['places'][3]) ? $record['places'][3]->faculty_name : '' ?>"
                        data-category="<?= ucfirst($record['tournament_info']->category) ?>"
                        data-players="<?= htmlspecialchars(json_encode($record['places'])) ?>"
                        data-players="<?= htmlspecialchars(json_encode($record['places'])) ?>"
                      >
                        View
                      </button>
                    </td>
                  </tr>
                  <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>


      <div class="freshers-tournaments" id="freshers-tournaments" style="display:none;">          
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
        </div>

        <div class="records-table">
          <table id="freshersTable">
            <div class="sub-header">
              <h2 class="sub-topic">Freshers</h2>
            </div>
            <thead>
              <tr>
                <th>Sport</th>
                <th>Year</th>
                <th>1st Place</th>
                <th>2nd Place</th>
                <th>3rd Place</th>
                <th>Men/Women</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="tournamentsBody">
              <?php if(!empty($freshersrecords)): ?>
                  <?php foreach ($freshersrecords as $record): ?>
                      <tr>
                          <td><?= $record['tournament_info']->sport_name ?></td>
                          <td><?= $record['tournament_info']->year ?></td>
                          <td><?= isset($record['places'][1]) ? $record['places'][1]->faculty_name : '' ?></td>
                          <td><?= isset($record['places'][2]) ? $record['places'][2]->faculty_name : '' ?></td>
                          <td><?= isset($record['places'][3]) ? $record['places'][3]->faculty_name : '' ?></td>
                          <td><?= $record['tournament_info']->category ?></td>
                          <td>
                              <button 
                                  class="btn btn-view" 
                                  onclick="viewTournament(this)"
                                  data-tournamentid="<?= $record['tournament_info']->recordid ?>"
                                  data-sport="<?= $record['tournament_info']->sport_name ?>"
                                  data-date="<?= $record['tournament_info']->year ?>"
                                  data-place1="<?= isset($record['places'][1]) ? $record['places'][1]->faculty_name : '' ?>"
                                  data-place2="<?= isset($record['places'][2]) ? $record['places'][2]->faculty_name : '' ?>"
                                  data-place3="<?= isset($record['places'][3]) ? $record['places'][3]->faculty_name : '' ?>"
                                  data-category="<?= ucfirst($record['tournament_info']->category) ?>"
                                  data-players="<?= htmlspecialchars(json_encode($record['places'])) ?>"
                                  data-players="<?= htmlspecialchars(json_encode($record['places'])) ?>"
                              >
                                  View
                              </button>
                          </td>
                      </tr>
                  <?php endforeach; ?>
              <?php endif; ?>
          </tbody>
          </table>
        </div>
      </div>

      <!-- Edit Tournament Modal -->
      <div id="tournamentModal" class="modal">
        <div class="modal-content">
          <div class="modal-header">
            <h2 id="modalTitle">Add Tournament</h2>
            <span class="close" onclick="closeModal('tournamentModal')">&times;</span>
          </div>
          <form id="tournamentForm" action="<?=ROOT?>/ped_incharge/interfaculty_tournaments/saveTournament" method="POST">
            <input type="hidden" id="tournamentId" name="tournamentId">
            <!-- <div class="form-group">
              <label for="name">Tournament Name</label>
              <input type="text" id="name" name="name" required>
            </div> -->
            <div class="form-group">
              <label for="sportInput">Sport</label>
              <select name="sportInput" id="sportInput" required>
                <option value="Basketball">Basketball</option>
                <option value="Soccer">Soccer</option>
                <option value="Volleyball">Volleyball</option>
                <option value="Hockey">Hockey</option>
                <option value="Cricket">Cricket</option>
                <option value="Baseball">Baseball</option>
              </select>
            </div>
            <div class="form-group">
              <label for="date">Year</label>
              <input type="text" name="date" id="date" required>
            </div>
            <div class="form-group">
              <label for="place1">1st Place</label>
              <input type="text" name="place1" id="place1" required>
            </div>
            <div class="form-group">
              <label for="place2">2nd Place</label>
              <input type="text" name="place2" id="place2" required>
            </div>
            <div class="form-group">
              <label for="place3">3rd Place</label>
              <input type="text" name="place3" id="place3" required>
            </div>
            <div class="form-group">
              <label for="participants">Number of Participants</label>
              <input type="number" name="participants" id="participants" required min="2">
            </div>
            <div class="form-group">
              <label>Participants' Registration Numbers</label>
              <div id="participantsContainer">
                <!-- Participant input fields will go here -->
              </div>
              <button type="button" class="btn btn-add" onClick="addParticipant()">Add Participant</button>
            </div>
            <button type="submit" class="btn btn-add">Save Tournament</button>
          </form>
        </div>
      </div>

      <div id="viewTournamentModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Tournament Details</h2>
            <span class="close" onclick="closeModal('viewTournamentModal')">&times;</span>
        </div>
        <div class="modal-body">
            <div class="details-grid">
                <div class="detail-item">
                    <label>Sport:</label>
                    <input type="text" id="viewSport" readonly>
                </div>
                <div class="detail-item">
                    <label>Year:</label>
                    <input type="text" id="viewDate" readonly>
                </div>
                <div class="detail-item">
                    <label>1st Place:</label>
                    <input type="text" id="viewPlace1" readonly>
                </div>
                <div class="detail-item">
                    <label>2nd Place:</label>
                    <input type="text" id="viewPlace2" readonly>
                </div>
                <div class="detail-item">
                    <label>3rd Place:</label>
                    <input type="text" id="viewPlace3" readonly>
                </div>
            </div>
            <div class="participants-section">
                <h3>Participants by Place</h3>
                <div id="viewParticipantsList2" class="participants-list"></div>
            </div>
        </div>
    </div>
</div>
    </main>
  </div>

 

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      initializeEventListeners();
    });

  

    function viewTournament(tournamentdata) {
    let viewTournamentModal = document.getElementById("viewTournamentModal");
    viewTournamentModal.style.display = "block";

    // Set basic tournament details
    document.getElementById("viewSport").value = tournamentdata.dataset.sport || '';
    document.getElementById("viewDate").value = tournamentdata.dataset.date || '';
    document.getElementById("viewPlace1").value = tournamentdata.dataset.place1 || '';
    document.getElementById("viewPlace2").value = tournamentdata.dataset.place2 || '';
    document.getElementById("viewPlace3").value = tournamentdata.dataset.place3 || '';
    
    // Display players for each place
    const participantsContainer = document.getElementById("viewParticipantsList2");
    participantsContainer.innerHTML = ''; // Clear previous content
    
    try {
        // Parse the places data from the button's dataset
        const placesData = JSON.parse(tournamentdata.dataset.players);
        
        // Create sections for each place (1st, 2nd, 3rd)
        for (let placeNum = 1; placeNum <= 3; placeNum++) {
            if (placesData[placeNum]) {
                // Create a section for this place
                const placeSection = document.createElement('div');
                placeSection.className = 'place-players';
                
                // Add place title
                const placeTitle = document.createElement('h4');
                const placeSuffix = placeNum === 1 ? 'st' : placeNum === 2 ? 'nd' : 'rd';
                placeTitle.textContent = `${placeNum}${placeSuffix} Place: ${placesData[placeNum].faculty_name}`;
                placeSection.appendChild(placeTitle);
                
                // Add players list
                if (placesData[placeNum].players && placesData[placeNum].players.length > 0) {
                    const playersList = document.createElement('ul');
                    playersList.className = 'players-list';
                    
                    placesData[placeNum].players.forEach(player => {
                        const playerItem = document.createElement('li');
                        playerItem.textContent = `${player.reg_no}`;
                        playersList.appendChild(playerItem);
                    });
                    
                    placeSection.appendChild(playersList);
                } else {
                    const noPlayers = document.createElement('p');
                    noPlayers.textContent = 'No players recorded';
                    placeSection.appendChild(noPlayers);
                }
                
                participantsContainer.appendChild(placeSection);
            }
        }
    } catch (e) {
        console.error("Error parsing players data:", e);
        participantsContainer.innerHTML = '<p>Error loading players data</p>';
    }
}

    function closeModal(modalId) {
      const modal = document.getElementById(modalId);
      modal.style.display = "none";
    }

    function initializeEventListeners() {
      window.onclick = (event) => {
        if(event.target.classList.contains('modal')) {
          event.target.style.display = "none";
        }
      }
    }

    document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("interfaculty").addEventListener("click", function() {
        let interfaculty = document.getElementById("interfaculty-tournaments");
        let freshers = document.getElementById("freshers-tournaments");
        interfaculty.style.display = "block";
        freshers.style.display = "none";
    });

    document.getElementById("freshers").addEventListener("click", function() {
        let interfaculty = document.getElementById("interfaculty-tournaments");
        let freshers = document.getElementById("freshers-tournaments");
        interfaculty.style.display = "none";
        freshers.style.display = "block";
    });
  });

  
  </script>
</body>
</html>