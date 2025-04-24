<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hockey</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/tournaments.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    
    <div class="navbar">
            <a href="tournamentrecords">Inter University</a>
            <a href="interfaculty">Inter Faculty</a>
            <a href="freshers">Freshers</a>
            <a href="other">Other</a>
    </div>
    
	<main>
        <div class="container">   
        <!-- interuni recoreds table-->
        <h1>Inter University Tournament Records</h1>
        <button id="add-record-btn" class="abb-btn">Add Record</button>
        <div class="record-table">
            <table id="record-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Place</th>
                        <th>Venue</th>
                        <th>No Of Players</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="record-body">
                    <tr>
                    <?php if(!empty($data['record'])): ?>
                      <?php foreach($data['record'] as $record): ?>
                        <td><?= htmlspecialchars($record->tournament_name)?></td>
                        <td><?= htmlspecialchars($record->date)?></td>
                        <td><?= htmlspecialchars($record->place)?></td>
                        <td><?= htmlspecialchars($record->venue)?></td>
                        <td><?= htmlspecialchars($record->no_of_players)?></td>
                        <td><?= htmlspecialchars($record->men_women)?></td>
                        <td>
                            <button type="button" class="view-btn" onclick="openViewModal('interUni', '<?= $record->interrecordid ?>', 
                            '<?= htmlspecialchars($record->players_Regno) ?>')"><i class="fas fa-eye"></i></button>
                        <button type="button" class="edit-btn" 
                        onclick="openEditModal('interUni', '<?= $record->interrecordid ?>', 
                        '<?= htmlspecialchars($record->tournament_name) ?>', 
                        '<?= htmlspecialchars($record->date) ?>', 
                        '<?= htmlspecialchars($record->place) ?>', 
                        '<?= htmlspecialchars($record->venue) ?>', 
                        '<?= htmlspecialchars($record->no_of_players) ?>', 
                        '<?= htmlspecialchars($record->men_women) ?>')">
                         <i class="fas fa-edit"></i></button>
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
    </div>
    </div>
    </main>
    
    <!--add modal-->
    <div id="interUniAddModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('interUniAddModal')">&times;</span>
    <!-- Inter University Form -->
    <form id="interUniForm" class="hidden" action="<?=ROOT?>/sportscaptain/Tournamentrecords/addinterunirecords" method="POST">
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

<!-- view modal-->
<div id="interuniViewModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('interuniViewModal')">&times;</span>
    <h2>Inter University Players</h2>
    <div id="viewPlayers">
      <ul id="interUniPlayerList"></ul>
    </div>
    <button type="button" class="cancel" onclick="closeModal('interuniViewModal')">Close</button>
  </div>
</div>

<!--edit modal-->
<div id="interUniModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('interUniModal')">&times;</span>
      <h2>Edit Inter University Record</h2>
      <form id="interUniEditForm" action="<?=ROOT?>/sportscaptain/Tournamentrecords/editinterunirecords" method="POST">
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
        <button type="submit">Update Record</button>
        <button type="button" class="cancel" onclick="closeModal('interUniModal')">Cancel</button>
      </form>
    </div>
  </div>



	<script src="<?=ROOT?>/assets/js/vidusha/interuni.js"></script>
</body>
</html>
