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
        <!-- interfaculty recoreds table-->
        <h1>Other Tournament Records</h1>
            <button type="button" class="add-btn">Add Recored</button>
        <div class="record-table">
            <table id="record-table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Reg No</th>
                        <th>Tournament</th>
                        <th>Place</th>
                        <th>Date</th>
                        <th>Venue</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            <tbody id="record-body">
        <?php if(!empty($data['otherrecords'])):?>
          <?php foreach($data['otherrecords'] as $record): ?>
            <tr>
              <td><?= htmlspecialchars($record->name)?></td>
              <td><?= htmlspecialchars($record->player_regno)?></td>
              <td><?= htmlspecialchars($record->tournament_name)?></td>
              <td><?= htmlspecialchars($record->place)?></td>
              <td><?= htmlspecialchars($record->date)?></td>
              <td><?= htmlspecialchars($record->venue)?></td>
              <td><?= htmlspecialchars($record->men_women)?></td>
              <td>
                <button type="button" class="edit-btn" 
                  onclick="openEditModal('others', '<?= $record->tournamentid ?>',
                    '<?= htmlspecialchars($record->name)?>',
                    '<?= htmlspecialchars($record->player_regno)?>', 
                    '<?= htmlspecialchars($record->tournament_name) ?>', 
                    '<?= htmlspecialchars($record->date) ?>', 
                    '<?= htmlspecialchars($record->place) ?>', 
                    '<?= htmlspecialchars($record->venue) ?>',
                    '<?= htmlspecialchars($record->men_women)?>')">
                  <i class="fas fa-edit"></i>
                </button>
                <form method="POST" style="display: inline;" action="<?=ROOT?>/sportscaptain/Other/deleteothertournaments">
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
    </main>

<!--othe add modal-->
<div id="othersAddModal" class="modal" style="display:none;">
    <div class="modal-content">
      <span class="close" onclick="closeModal('othersAddModal')">&times;</span>
    <!-- Other tournmanet Form -->
    <form id="othersForm" action="<?=ROOT?>/sportscaptain/other/addothertournaments" method="POST">
      <h2>Other Tournaments</h2>
      <input type="hidden" name="tournamentid" id="tournamentid">
      <div class="form-group">
        <label for="name"> Name:</label>
        <input type="text" name="name" placeholder="Name" required>
      </div>
      <div class="form-group">
        <label for="playersregno">Players Reg No:</label>
        <input type="text" name="player_regno" placeholder="Player Reg No" required></textarea>
      </div>
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

<!--other edit modal-->
<div id="othersModal" class="modal" style="display:none;">
    <div class="modal-content">
      <span class="close" onclick="closeModal('othersModal')">&times;</span>
      <h2>Edit Other Tournaments Record</h2>
      <form id="otherEditForm" action="<?=ROOT?>/sportscaptain/Other/editothertournaments" method="POST">
        <input type="hidden" name="tournamentid" id="tournamentEditId">
        <div class="form-group">
          <label for="venue">Player Name:</label>
          <input type="text" name="name" placeholder="name" id="otherEditpname" required>
        </div>
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
        <div class="form-group">
        <label for="category">Category:</label>
        <select id="men_women" name="men_women">
        <option value="men">Men</option>
        <option value="women">Women</option>
      </select>
      </div> 
        <button type="submit">Update Record</button>
        <button type="button" class="cancel" onclick="closeModal('othersModal')">Cancel</button>
      </form>
    </div>
  </div>

	<script src="<?=ROOT?>/assets/js/vidusha/other.js"></script>
</body>
</html>
