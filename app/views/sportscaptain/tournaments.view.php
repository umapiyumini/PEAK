<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tournament Records Management</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/tournaments.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
  <h1>Tournament Records Management</h1>

  <!-- Category Selection Buttons -->
  <div class="category-buttons">
    <button id="interUniBtn" onclick="openAddModal('interUniAddModal')">Inter University</button>
    <button id="interFacultyBtn" onclick="openAddModal('interFacultyAddModal')">Inter Faculty</button>
    <button id="freshersBtn" onclick="openAddModal('freshersAddModal')">Freshers</button>
    <button id="otherBtn" onclick="openAddModal('othersAddModal')">Other</button>
  </div>

  <div id="interUniAddModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('interUniAddModal')">&times;</span>
    <!-- Inter University Form -->
    <form id="interUniForm" class="hidden" action="<?=ROOT?>/sportscaptain/Tournaments/addinterunirecords" method="POST">
      <h2>Inter University</h2>
      <input type="hidden" name="interunirecordid" id="interunirecordid">
      <div class="form-group">
        <label for="tournament_name">Tournament Name:</label>
        <input type="text" name="tournament_name" placeholder="Tournament Name" required>
      </div>
      <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" name="date" placeholder="Date" required>
      </div>
      <div class="form-group">
        <label for="place">Place:</label>
        <input type="text" name="place" placeholder="Place" required>
      </div>
      <div class="form-group">
        <label for="venue">Venue:</label>
        <input type="text" name="venue" placeholder="Venue" required>
      </div>
      <div class="form-group">
        <label for="no_of_players">No of Players:</label>
        <input type="number" name="no_of_players" placeholder="No of Players" required>
      </div>
      <div class="form-group">
        <label for="players_Regno">Players Reg No:</label>
        <textarea name="players_Regno" placeholder="Players Reg No" required></textarea>
      </div>
      <div class="form-group">
        <label for="category">Category:</label>
      <select id="men_women" name="men_women">
        <option value="men">Men</option>
        <option value="women">Women</option>
      </select>
      </div> 
      <input type="hidden" name="sport_id" value="<?= $userSportId ?>">
      <button type="submit">Add Record</button>
    </form>
</div>
</div>


<div id="interFacultyAddModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('interFacultyAddModal')">&times;</span>
    <!-- Inter Faculty Form -->
    <form id="interFacultyForm" class="hidden" action="<?=ROOT?>/sportscaptain/Tournaments/addinterfacultyrecords" method="POST">
      <h2>Inter Faculty</h2>
      <input type="hidden" name="interfacrecid" id="interfacrecordid">
      <div class="form-group">
        <label for="tournament_name">Tournament Name:</label>
        <input type="text" name="tournament_name" placeholder="Tournament Name" required>
      </div>
      
      <div class="form-group">
        <label for="year">Year:</label>
        <input type="number" name="year" placeholder="Year" required>
      </div>
      <div class="form-group">
        <label for="first_place">1st Place Faculty:</label>
        <input type="text" name="first_place" placeholder="1st Place Faculty" required>
      </div>
      <div class="form-group">
        <label for="second_place">2nd Place Faculty:</label>
        <input type="text" name="second_place" placeholder="2nd Place Faculty" required>
      </div>
      <div class="form-group">
        <label for="third_place">3rd Place Faculty:</label>
        <input type="text" name="third_place" placeholder="3rd Place Faculty" required>
      </div>
      <div class="form-group">
        <label for="no_of_players">No of Players:</label>
        <input type="number" name="no_of_players" placeholder="No of Players" required>
      </div>
      <div class="form-group">
        <label for="players_regno">Players Reg No:</label>
        <textarea name="players_regno" placeholder="Players Reg No" required></textarea>
      </div>
      <div class="form-group">
      <label for="category">Category:</label>
      <select id="men_women" name="men_women">
        <option value="men">Men</option>
        <option value="women">Women</option>
      </select>
      </div> 
      <input type="hidden" name="sport_id" value="<?= $userSportId ?>">
      <button type="submit">Add Record</button>
    </form>
</div>
</div>


<div id="freshersAddModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('freshersAddModal')">&times;</span>
    <!-- Freshers Form -->
    <form id="freshersForm" class="hidden" action="<?=ROOT?>/sportscaptain/Tournaments/addfreshersrecords" method="POST">
      <h2>Freshers</h2>
      <input type="hidden" name="freshersid" id="freshersrecordid">
      <div class="form-group">
        <label for="tournament_name">Tournament Name:</label>
        <input type="text" name="tournament_name" placeholder="Tournament Name" required>
      </div>
      <div class="form-group">
        <label for="year">Year:</label>
        <input type="number" name="year" placeholder="Year" required>
      </div>
      <div class="form-group">
        <label for="first_place">1st Place Faculty:</label>
        <input type="text" name="first_place" placeholder="1st Place Faculty" required>
      </div>
      <div class="form-group">
        <label for="second_place">2nd Place Faculty:</label>
        <input type="text" name="second_place" placeholder="2nd Place Faculty" required>
      </div>
      <div class="form-group">
        <label for="third_place">3rd Place Faculty:</label>
        <input type="text" name="third_place" placeholder="3rd Place Faculty" required>
      </div>
      <div class="form-group">
        <label for="no_of_players">No of Players:</label>
        <input type="number" name="no_of_players" placeholder="No of Players" required>
      </div>
      <div class="form-group">
        <label for="playersregno">Players Reg No:</label>
        <textarea name="playersregno" placeholder="Players Reg No" required></textarea>
      </div>
      <div class="form-group">
        <label for="category">Category:</label>
      <select id="men_women" name="men_women">
        <option value="men">Men</option>
        <option value="women">Women</option>
      </select>
</div>
      <input type="hidden" name="sport_id" value="<?= $userSportId ?>">
      <button type="submit">Add Record</button>
    </form>
  </div>
</div>

<div id="othersAddModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('othersAddModal')">&times;</span>
    <!-- Other tournmanet Form -->
    <form id="othersForm" class="hidden" action="<?=ROOT?>/sportscaptain/Tournaments/addothertournaments" method="POST">
      <h2>Other Tournaments</h2>
      <input type="hidden" name="tournamentid" id="tournamentid">
      <div class="form-group">
        <label for="tournament_name">Tournament Name:</label>
        <input type="text" name="tournament_name" placeholder="Tournament Name" required>
      </div>
      <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" name="date" placeholder="Date" required>
      </div>
      <div class="form-group">
        <label for="place">Place:</label>
        <input type="text" name="place" placeholder="Place" required>
      </div>
      <div class="form-group">
        <label for="venue">Venue:</label>
        <input type="text" name="venue" placeholder="Venue" required>
      </div>
      <div class="form-group">
        <label for="playersregno">Players Reg No:</label>
        <input type="text" name="player_regno" placeholder="Player Reg No" required></textarea>
      </div>
      <div class="form-group">
        <label for="category">Category:</label>
      <select id="men_women" name="men_women">
        <option value="men">Men</option>
        <option value="women">Women</option>
      </select>
      </div> 
      <input type="hidden" name="sport_id" value="<?= $userSportId ?>">
      <button type="submit">Add Record</button>
    </form>
</div>
</div>



  <!-- Records Tables -->
  <div id="recordsContainer">
    <h2>Inter University Records</h2>
    <table id="interUniTable">
      <thead>
        <tr>
          <th>Tournament Name</th>
          <th>Date</th>
          <th>Place</th>
          <th>Venue</th>
          <th>No of Players</th>
          <th>Players Reg No</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="interUniList">
        <?php if(!empty($data['interunirecords'])):?>
          <?php foreach($data['interunirecords'] as $record): ?>
            <tr>
              <td><?= htmlspecialchars($record->tournament_name)?></td>
              <td><?= htmlspecialchars($record->date)?></td>
              <td><?= htmlspecialchars($record->place)?></td>
              <td><?= htmlspecialchars($record->venue)?></td>
              <td><?= htmlspecialchars($record->no_of_players)?></td>
              <td><?= htmlspecialchars($record->players_Regno)?></td>
              <td>
                <button type="button" class="edit-btn" 
                  onclick="openEditModal('interUni', '<?= $record->interrecordid ?>', 
                    '<?= htmlspecialchars($record->tournament_name) ?>', 
                    '<?= htmlspecialchars($record->date) ?>', 
                    '<?= htmlspecialchars($record->place) ?>', 
                    '<?= htmlspecialchars($record->venue) ?>', 
                    '<?= htmlspecialchars($record->no_of_players) ?>', 
                    '<?= htmlspecialchars($record->players_Regno) ?>')">
                  <i class="fas fa-edit"></i>
                </button>
                <form method="POST" style="display: inline;" action="<?=ROOT?>/sportscaptain/Tournaments/deleteinterunirecords">
                  <input type="hidden" name="interunirecordid" value="<?= htmlspecialchars($record->interrecordid) ?>">
                  <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this record?');">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="7">No records found</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <h2>Inter Faculty Records</h2>
    <table id="interFacultyTable">
      <thead>
        <tr>
          <th>Tournament Name</th>
          <th>Year</th>
          <th>1st Place Faculty</th>
          <th>2nd Place Faculty</th>
          <th>3rd Place Faculty</th>
          <th>No of Players</th>
          <th>Players Reg No</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="interFacultyList">
        <?php if(!empty($data['interfacultyrecords'])):?>
          <?php foreach($data['interfacultyrecords'] as $record): ?>
            <tr>
              <td><?= htmlspecialchars($record->tournament_name)?></td>
              <td><?= htmlspecialchars($record->year)?></td>
              <td><?= htmlspecialchars($record->first_place)?></td>
              <td><?= htmlspecialchars($record->second_place)?></td>
              <td><?= htmlspecialchars($record->third_place)?></td>
              <td><?= htmlspecialchars($record->no_of_players)?></td>
              <td><?= htmlspecialchars($record->players_regno)?></td>
              <td>
                <button type="button" class="edit-btn"
                  onclick="openEditModal('interFaculty', '<?= $record->interfacrecid ?>', 
                    '<?= htmlspecialchars($record->tournament_name) ?>', 
                    '<?= htmlspecialchars($record->year) ?>', 
                    '<?= htmlspecialchars($record->first_place) ?>', 
                    '<?= htmlspecialchars($record->second_place) ?>', 
                    '<?= htmlspecialchars($record->third_place) ?>', 
                    '<?= htmlspecialchars($record->no_of_players) ?>', 
                    '<?= htmlspecialchars($record->players_regno) ?>')">
                  <i class="fas fa-edit"></i>
                </button>
                <form method="POST" style="display: inline;" action="<?=ROOT?>/sportscaptain/Tournaments/deleteinterfacrecords">
                  <input type="hidden" name="interfacrecid" value="<?= htmlspecialchars($record->interfacrecid) ?>">
                  <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this record?');">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="8">No records found</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <h2>Freshers Records</h2>
    <table id="freshersTable">
      <thead>
        <tr>
          <th>Tournament Name</th>
          <th>Year</th>
          <th>1st Place Faculty</th>
          <th>2nd Place Faculty</th>
          <th>3rd Place Faculty</th>
          <th>Players Reg No</th>
          <th>Category</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="freshersList">
        <?php if(!empty($data['freshersrecords'])):?>
          <?php foreach($data['freshersrecords'] as $record): ?>
            <tr>
              <td><?= htmlspecialchars($record->tournament_name)?></td>
              <td><?= htmlspecialchars($record->year)?></td>
              <td><?= htmlspecialchars($record->first_place)?></td>
              <td><?= htmlspecialchars($record->second_place)?></td>
              <td><?= htmlspecialchars($record->third_place)?></td>
              <td><?= htmlspecialchars($record->playersregno)?></td>
              <td><?= htmlspecialchars($record->no_of_players)?></td>
              <td>
                <button type="button" class="edit-btn"
                  onclick="openEditModal('freshers', '<?= $record->freshersid ?>', 
                    '<?= htmlspecialchars($record->tournament_name) ?>', 
                    '<?= htmlspecialchars($record->year) ?>', 
                    '<?= htmlspecialchars($record->first_place) ?>', 
                    '<?= htmlspecialchars($record->second_place) ?>', 
                    '<?= htmlspecialchars($record->third_place) ?>', 
                    '<?= htmlspecialchars($record->no_of_players) ?>', 
                    '<?= htmlspecialchars($record->playersregno) ?>')">
                  <i class="fas fa-edit"></i>
                </button>
                <form method="POST" style="display: inline;" action="<?=ROOT?>/sportscaptain/Tournaments/deletefreshersrecords">
                  <input type="hidden" name="freshersid" value="<?= htmlspecialchars($record->freshersid) ?>">
                  <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this record?');">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="8">No records found</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <h2>Other Records</h2>
    <table id="Other Table">
      <thead>
        <tr>
          <th>Tournament Name</th>
          <th>Date</th>
          <th>Place</th>
          <th>Venue</th>
          <th>Player Reg No</th>
          <th>Category</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="otherList">
        <?php if(!empty($data['otherrecords'])):?>
          <?php foreach($data['otherrecords'] as $record): ?>
            <tr>
              <td><?= htmlspecialchars($record->tournament_name)?></td>
              <td><?= htmlspecialchars($record->date)?></td>
              <td><?= htmlspecialchars($record->place)?></td>
              <td><?= htmlspecialchars($record->venue)?></td>
              <td><?= htmlspecialchars($record->player_regno)?></td>
              <td><?= htmlspecialchars($record->men_women)?></td>
              <td>
                <button type="button" class="edit-btn" 
                  onclick="openEditModal('others', '<?= $record->tournamentid ?>', 
                    '<?= htmlspecialchars($record->tournament_name) ?>', 
                    '<?= htmlspecialchars($record->date) ?>', 
                    '<?= htmlspecialchars($record->place) ?>', 
                    '<?= htmlspecialchars($record->venue) ?>', 
                    '<?= htmlspecialchars($record->player_regno)?>')">
                  <i class="fas fa-edit"></i>
                </button>
                <form method="POST" style="display: inline;" action="<?=ROOT?>/sportscaptain/tournaments/deleteothertournaments">
                  <input type="hidden" name="tournamentid" value="<?= htmlspecialchars($record->tournamentid) ?>">
                  <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this record?');">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="7">No records found</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<div id="interUniModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('interUniModal')">&times;</span>
      <h2>Edit Inter University Record</h2>
      <form id="interUniEditForm" action="<?=ROOT?>/sportscaptain/Tournaments/editinterunirecords" method="POST">
        <input type="hidden" name="interunirecordid" id="interUniEditId">
        <div class="form-group">
          <label for="tournament_name">Tournament Name:</label>
          <input type="text" name="tournament_name" placeholder="Tournament Name" id="interUniEditName" required>
        </div>
        <div class="form-group">
          <label for="date">Date:</label>
          <input type="date" name="date" placeholder="Date" id="interUniEditDate" required>
        </div>
        <div class="form-group">
          <label for="place">Place:</label>
          <input type="text" name="place" placeholder="Place" id="interUniEditPlace" required>
        </div>
        <div class="form-group">
          <label for="venue">Venue:</label>
          <input type="text" name="venue" placeholder="Venue" id="interUniEditVenue" required>
        </div>
        <div class="form-group">
          <label for="no_of_players">No of Players:</label>
          <input type="number" name="no_of_players" placeholder="No of Players" id="interUniEditPlayers" required>
        </div>
        <div class="form-group">
          <label for="players_Regno">Players Reg No:</label>
          <textarea name="players_Regno" placeholder="Players Reg No" id="interUniEditRegno" required></textarea>
        </div>
        <button type="submit">Update Record</button>
        <button type="button" class="cancel" onclick="closeModal('interUniModal')">Cancel</button>
      </form>
    </div>
  </div>

  <div id="interFacultyModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('interFacultyModal')">&times;</span>
      <h2>Edit Inter Faculty Record</h2>
      <form id="interFacultyEditForm" action="<?=ROOT?>/sportscaptain/Tournaments/editinterfacrecords" method="POST">
        <input type="hidden" name="interfacrecid" id="interFacultyEditId">
        <div class="form-group">
          <label for="tournament_name">Tournament Name:</label>
          <input type="text" name="tournament_name" placeholder="Tournament Name" id="interFacultyEditName" required>
        </div>
        <div class="form-group">
          <label for="year">Year:</label>
          <input type="number" name="year" placeholder="Year" id="interFacultyEditYear" required>
        </div>
        <div class="form-group">
        <label for="first_place">1st Place:</label>
        <input type="text" name="first_place" placeholder="1st Place Faculty" id="interFacultyEditFirst" required>
        </div>
        <div class="form-group">
        <label for="second_place">2nd Place:</label>
        <input type="text" name="second_place" placeholder="2nd Place Faculty" id="interFacultyEditSecond" required>
        </div>
        <div class="form-group">
        <label for="third_place">3rd Place:</label>
        <input type="text" name="third_place" placeholder="3rd Place Faculty" id="interFacultyEditThird" required>
        </div>
        <div class="form-group">
        <label for="no_of_players">No Of Players:</label>
        <input type="number" name="no_of_players" placeholder="No of Players" id="interFacultyEditPlayers" required>
        </div>
        <div class="form-group">
        <label for="players_regno">Players reg no:</label>
        <textarea name="players_regno" placeholder="Players Reg No" id="interFacultyEditRegno" required></textarea>
        </div>
        <button type="submit">Update Record</button>
        <button type="button" class="cancel" onclick="closeModal('interFacultyModal')">Cancel</button>
      </form>
    </div>
  </div>

  <div id="freshersModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('freshersModal')">&times;</span>
      <h2>Edit Freshers Record</h2>
      <form id="freshersEditForm" action="<?=ROOT?>/sportscaptain/Tournaments/editfreshersrecords" method="POST">
        <input type="hidden" name="freshersid" id="freshersEditId">
        <div class="form-group">
          <label for="tournament_name">Tournament Name:</label>
        <input type="text" name="tournament_name" placeholder="Tournament Name" id="freshersEditName" required>
        </div>
        <div class="form-group">
          <label for="year">Year:</label>
        <input type="number" name="year" placeholder="Year" id="freshersEditYear" required>
        </div>
        <div class="form-group">
        <label for="first_place">1st Place:</label>
        <input type="text" name="first_place" placeholder="1st Place Faculty" id="freshersEditFirst" required>
        </div>
        <div class="form-group">
        <label for="second_place">2nd Place:</label>
        <input type="text" name="second_place" placeholder="2nd Place Faculty" id="freshersEditSecond" required>
        </div>
        <div class="form-group">
        <label for="third_place">3rd Place:</label>
        <input type="text" name="third_place" placeholder="3rd Place Faculty" id="freshersEditThird" required>
        </div>
        <div class="form-group">
        <label for="no_of_players">No Of Players:</label>
        <input type="number" name="no_of_players" placeholder="No of Players" id="freshersEditPlayers" required>
        </div>
        <div class="form-group">
        <label for="players_regno">Players reg no:</label>
        <textarea name="playersregno" placeholder="Players Reg No" id="freshersEditRegno" required></textarea>
        </div>
        <button type="submit">Update Record</button>
        <button type="button" class="cancel" onclick="closeModal('freshersModal')">Cancel</button>
      </form>
    </div>
  </div>

  <div id="othersModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('othersModal')">&times;</span>
      <h2>Edit Other Tournaments Record</h2>
      <form id="otherEditForm" action="<?=ROOT?>/sportscaptain/Tournaments/editothertournaments" method="POST">
        <input type="hidden" name="tournamentid" id="tournamentEditId">
        <div class="form-group">
          <label for="tournament_name">Tournament Name:</label>
          <input type="text" name="tournament_name" placeholder="Tournament Name" id="otherEditName" required>
        </div>
        <div class="form-group">
          <label for="date">Date:</label>
          <input type="date" name="date" placeholder="Date" id="otherEditDate" required>
        </div>
        <div class="form-group">
          <label for="place">Place:</label>
          <input type="text" name="place" placeholder="Place" id="otherEditPlace" required>
        </div>
        <div class="form-group">
          <label for="venue">Venue:</label>
          <input type="text" name="venue" placeholder="Venue" id="otherEditVenue" required>
        </div>
        <div class="form-group">
          <label for="player_Regno">Player Reg No:</label>
          <input type="text" name="player_regno" placeholder="Reg No" id="otherEditRegno" required>
        </div>
        <button type="submit">Update Record</button>
        <button type="button" class="cancel" onclick="closeModal('othersModal')">Cancel</button>
      </form>
    </div>
  </div>


  <script src="<?=ROOT?>/assets/js/vidusha/tournaments.js"></script>
</body>
</html>
