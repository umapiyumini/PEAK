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
      <div class="sub-header">
        <h2 class="sub-topic">Other Tournaments</h2>
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

        <div class="records-table">
          <table>
            <thead>
              <tr>
                <th>Sport</th>
                <th>Tournament Name</th>
                <th>Date</th>
                <th>Place</th>
                <th>Men/Women</th>
                <th>Venue</th>
                <th>Participants</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="tournamentsBody">
              <?php if(!empty($tournamentList)):?>
                <?php foreach ($tournamentList as $i): ?>
                  <tr>
                    <td><?=$i->sport_name?></td>
                    <td><?=$i->tournament_name?></td>
                    <td><?=$i->date?></td>
                    <td><?=$i->place?></td>
                    <td><?=$i->men_women?></td>
                    <td><?=$i->venue?></td>
                    <td><?=$i->no_of_players?></td>
                    <td>
                      <button 
                        class="btn btn-edit" 
                        onclick="openModal(this)" 
                        data-tournamentid="<?=$i->interrecordid?>"
                        data-tournamentname="<?=$i->tournament_name?>"
                        data-sport="<?=$i->sport_name?>"
                        data-date="<?=$i->date?>"
                        data-place="<?=$i->place?>"
                        data-category="<?=$i->men_women?>"
                        data-venue="<?=$i->venue?>"
                        data-participantcount="<?=$i->no_of_players?>"
                      >
                        Edit
                      </button>
                      <button class="btn btn-delete" onclick="deleteTournament(<?=$i->interrecordid?>)">Delete</button>
                      <button 
                        class="btn btn-view" 
                        onclick="viewTournament(this)"
                        data-tournamentid="<?=$i->interrecordid?>"
                        data-tournamentname="<?=$i->tournament_name?>"
                        data-sport="<?=$i->sport_name?>"
                        data-date="<?=$i->date?>"
                        data-place="<?=$i->place?>"
                        data-category="<?=$i->men_women?>"
                        data-venue="<?=$i->venue?>"
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

      <!--Edit Tournament Modal -->
      <div id="tournamentModal" class="modal">
        <div class="modal-content">
          <div class="modal-header">
            <h2 id="modalTitle">Edit Tournament</h2>
            <span class="close" onclick="closeModal('tournamentModal')">&times;</span>
          </div>
          <form id="tournamentForm" action="<?=ROOT?>/ped_incharge/interuni_tournaments/saveTournament" method="POST">
            <input type="hidden" id="tournamentId" name="tournamentId">
            <div class="form-group">
              <label for="name">Tournament Name</label>
              <input type="text" id="name" name="name" required>
            </div>
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
              <label for="date">Date</label>
              <input type="date" name="date" id="date" required>
            </div>
            <div class="form-group">
              <label for="place">Place</label>
              <input type="text" name="place" id="place" required>
            </div>
            <div class="form-group">
              <label for="men_women">Men/Women</label>
              <input type="text" name="men_women" id="men_women" required>
            </div>
            <div class="form-group">
              <label for="venue">Venue</label>
              <input type="text" name="venue" id="venue" required>
            </div>
            <div class="form-group">
              <label for="participants">Number of Participants</label>
              <input type="number" name="participants" id="participants" required min="2">
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
                    <label>Tournament Name:</label>
                    <input type="text" id="viewName" readonly>
                </div>
                <div class="detail-item">
                    <label>Sport:</label>
                    <input type="text" id="viewSport" readonly>
                </div>
                <div class="detail-item">
                    <label>Date:</label>
                    <input type="data" id="viewDate" readonly>
                </div>
                <div class="detail-item">
                    <label>Place:</label>
                    <input type="text" id="viewPlace" readonly>
                </div>
                <div class="detail-item">
                    <label>Category:</label>
                    <input type="text" id="viewMenWomen" readonly>
                </div>
                <div class="detail-item">
                    <label>Venue:</label>
                    <input type="text" id="viewVenue" readonly>
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