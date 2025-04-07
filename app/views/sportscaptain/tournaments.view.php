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
    <button id="interUniBtn" onclick="showForm('interUni')">Inter University</button>
    <button id="interFacultyBtn" onclick="showForm('interFaculty')">Inter Faculty</button>
    <button id="freshersBtn" onclick="showForm('freshers')">Freshers</button>
  </div>

  <!-- Form Container -->
  <div id="formContainer" class="hidden">
    <!-- Inter University Form -->
    <form id="interUniForm" class="hidden" action="<?=ROOT?>/sportscaptain/Tournaments/addinterunirecords" method="POST">
      <h2>Inter University</h2>
      <input type="hidden" name="interunirecordid" id="interunirecordid">
      <input type="text" placeholder="Tournament Name" name="tournament_name" required>
      <input type="number" placeholder="Year" name="year" required>
      <input type="text" placeholder="Place" name="place" required>
      <input type="text" placeholder="Venue" name="venue" required>
      <input type="number" placeholder="No of Players" name="no_of_players" required>
      <textarea placeholder="Players Reg No" name="players_Regno" required></textarea>
      <input type="hidden" name="sport_id" value="<?= $userSportId ?>">
      <button type="submit">Add Record</button>
    </form>

    <!-- Inter Faculty Form -->
    <form id="interFacultyForm" class="hidden" action="<?=ROOT?>/sportscaptain/Tournaments/addinterfacultyrecords" method="POST">
      <h2>Inter Faculty</h2>
      <input type="hidden" name="interfacrecid" id="interfacrecordid">
      <input type="text" name="tournament_name" placeholder="Tournament Name" required>
      <input type="number" name="year" placeholder="Year" required>
      <input type="text" name="first_place" placeholder="1st Place Faculty" required>
      <input type="text" name="second_place" placeholder="2nd Place Faculty" required>
      <input type="text" name="third_place" placeholder="3rd Place Faculty" required>
      <input type="number" name="no_of_players" placeholder="No of Players" required>
      <textarea name="players_regno" placeholder="Players Reg No" required></textarea>
      <input type="hidden" name="sport_id" value="<?= $userSportId ?>">
      <button type="submit">Add Record</button>
    </form>

    <!-- Freshers Form -->
    <form id="freshersForm" class="hidden" action="<?=ROOT?>/sportscaptain/Tournaments/addfreshersrecords" method="POST">
      <h2>Freshers</h2>
      <input type="hidden" name="freshersid" id="freshersrecordid">
      <input type="text" name="tournament_name" placeholder="Tournament Name" required>
      <input type="number" name="year" placeholder="Year" required>
      <input type="text" name="first_place" placeholder="1st Place Faculty" required>
      <input type="text" name="second_place" placeholder="2nd Place Faculty" required>
      <input type="text" name="third_place" placeholder="3rd Place Faculty" required>
      <input type="number" name="no_of_players" placeholder="No of Players" required>
      <textarea name="playersregno" placeholder="Players Reg No" required></textarea>
      <input type="hidden" name="sport_id" value="<?= $userSportId ?>">
      <button type="submit">Add Record</button>
    </form>
  </div>

  <!-- Records Tables -->
  <div id="recordsContainer">
    <h2>Inter University Records</h2>
    <table id="interUniTable">
      <thead>
        <tr>
          <th>Tournament Name</th>
          <th>Year</th>
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
              <td><?= htmlspecialchars($record->year)?></td>
              <td><?= htmlspecialchars($record->place)?></td>
              <td><?= htmlspecialchars($record->venue)?></td>
              <td><?= htmlspecialchars($record->no_of_players)?></td>
              <td><?= htmlspecialchars($record->players_Regno)?></td>
              <td>
                <button type="button" class="edit-btn" 
                  onclick="openEditModal('interUni', '<?= $record->interrecordid ?>', 
                    '<?= htmlspecialchars($record->tournament_name) ?>', 
                    '<?= htmlspecialchars($record->year) ?>', 
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
          <th>No of Players</th>
          <th>Players Reg No</th>
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
              <td><?= htmlspecialchars($record->no_of_players)?></td>
              <td><?= htmlspecialchars($record->playersregno)?></td>
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
  </div>
</div>

<div id="interUniModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('interUniModal')">&times;</span>
      <h2>Edit Inter University Record</h2>
      <form id="interUniEditForm" action="<?=ROOT?>/sportscaptain/Tournaments/editinterunirecords" method="POST">
        <input type="hidden" name="interunirecordid" id="interUniEditId">
        <input type="text" placeholder="Tournament Name" name="tournament_name" id="interUniEditName" required>
        <input type="number" placeholder="Year" name="year" id="interUniEditYear" required>
        <input type="text" placeholder="Place" name="place" id="interUniEditPlace" required>
        <input type="text" placeholder="Venue" name="venue" id="interUniEditVenue" required>
        <input type="number" placeholder="No of Players" name="no_of_players" id="interUniEditPlayers" required>
        <textarea placeholder="Players Reg No" name="players_Regno" id="interUniEditRegno" required></textarea>
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
        <input type="text" name="tournament_name" placeholder="Tournament Name" id="interFacultyEditName" required>
        <input type="number" name="year" placeholder="Year" id="interFacultyEditYear" required>
        <input type="text" name="first_place" placeholder="1st Place Faculty" id="interFacultyEditFirst" required>
        <input type="text" name="second_place" placeholder="2nd Place Faculty" id="interFacultyEditSecond" required>
        <input type="text" name="third_place" placeholder="3rd Place Faculty" id="interFacultyEditThird" required>
        <input type="number" name="no_of_players" placeholder="No of Players" id="interFacultyEditPlayers" required>
        <textarea name="players_regno" placeholder="Players Reg No" id="interFacultyEditRegno" required></textarea>
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
        <input type="text" name="tournament_name" placeholder="Tournament Name" id="freshersEditName" required>
        <input type="number" name="year" placeholder="Year" id="freshersEditYear" required>
        <input type="text" name="first_place" placeholder="1st Place Faculty" id="freshersEditFirst" required>
        <input type="text" name="second_place" placeholder="2nd Place Faculty" id="freshersEditSecond" required>
        <input type="text" name="third_place" placeholder="3rd Place Faculty" id="freshersEditThird" required>
        <input type="number" name="no_of_players" placeholder="No of Players" id="freshersEditPlayers" required>
        <textarea name="playersregno" placeholder="Players Reg No" id="freshersEditRegno" required></textarea>
        <button type="submit">Update Record</button>
        <button type="button" class="cancel" onclick="closeModal('freshersModal')">Cancel</button>
      </form>
    </div>
  </div>


  <script src="<?=ROOT?>/assets/js/vidusha/tournaments.js"></script>
</body>
</html>
