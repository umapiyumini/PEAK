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
                <th>Sport</th>
                <th>Year</th>
                <th>1st Place</th>
                <th>2nd Place</th>
                <th>3rd Place</th>
                <th>Men/Women</th>
                <th>Participants</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="tournamentsBody">
            <?php if(!empty($tournamentList)):?>
                <?php foreach ($tournamentList as $i): ?>
                  <tr>
                    <td><?=$i->sport_name?></td>
                    <td><?=$i->year?></td>
                    <td><?=$i->first_place?></td>
                    <td><?=$i->second_place?></td>
                    <td><?=$i->third_place?></td>
                    <td><?php?></td><!-- men/women column is not in database yet (need to add it) -->
                    <td><?=$i->no_of_players?></td>
                    <td>
                      <button 
                        class="btn btn-edit" 
                        onclick="openModal(this)" 
                        data-tournamentid="<?=$i->interfacrecid?>"
                        data-sport="<?=$i->sport_name?>"
                        data-date="<?=$i->year?>"
                        data-place1="<?=$i->first_place?>"
                        data-place2="<?=$i->second_place?>"
                        data-place3="<?=$i->third_place?>"
                        data-participantcount="<?=$i->no_of_players?>"
                      >
                        Edit
                      </button>
                      <button class="btn btn-delete" onclick="deleteTournament(<?=$i->interfacrecid?>)">Delete</button>
                      <button 
                        class="btn btn-view" 
                        onclick="viewTournament(this)"
                        data-tournamentid="<?=$i->interfacrecid?>"
                        data-sport="<?=$i->sport_name?>"
                        data-date="<?=$i->year?>"
                        data-place1="<?=$i->first_place?>"
                        data-place2="<?=$i->second_place?>"
                        data-place3="<?=$i->third_place?>"
                        data-participantcount="<?=$i->no_of_players?>"
                      >
                        View
                      </button>
                    </td>
                  </tr>
                <?php endforeach;?>
              <?php endif;?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Add/Edit Tournament Modal -->
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
                      <h3>Participants</h3>
                      <div id="viewParticipantsList" class="participants-list"></div>
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

    function openModal(tournamentdata) {
      let tournamentModal = document.getElementById("tournamentModal");
      tournamentModal.style.display = "block";

      document.getElementById("tournamentId").value = tournamentdata.dataset.tournamentid || '';
      document.getElementById("sportInput").value = tournamentdata.dataset.sport || '';
      document.getElementById("date").value = tournamentdata.dataset.date || '';
      document.getElementById("place1").value = tournamentdata.dataset.place1 || '';
      document.getElementById("place2").value = tournamentdata.dataset.place2 || '';
      document.getElementById("place3").value = tournamentdata.dataset.place3 || '';
      document.getElementById("participants").value = tournamentdata.dataset.participantcount || '';
    }

    function deleteTournament(interrecordid) {
      if (confirm("Are you sure you want to delete this tournament?")) {
        window.location.href = "<?=ROOT?>/ped_incharge/interfaculty_tournaments/deleteTournament/" + interrecordid;
      }
    }

    function viewTournament(tournamentdata) {
      let viewTournamentModal = document.getElementById("viewTournamentModal");
      viewTournamentModal.style.display = "block";

      document.getElementById("viewSport").value = tournamentdata.dataset.sport || '';
      document.getElementById("viewDate").value = tournamentdata.dataset.date || '';
      document.getElementById("viewPlace1").value = tournamentdata.dataset.place1 || '';
      document.getElementById("viewPlace2").value = tournamentdata.dataset.place2 || '';
      document.getElementById("viewPlace3").value = tournamentdata.dataset.place3 || '';
      document.getElementById("viewMenWomen").value = tournamentdata.dataset.category || '';
      document.getElementById("viewVenue").value = tournamentdata.dataset.venue || '';
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
  </script>
</body>
</html>