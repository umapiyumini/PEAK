<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hockey Team Roster</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/team.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="navbar">
    <a href="sportprofile">Home</a>
            <a href="sportattendance">Attendance</a>
            <a href="team">Team</a>
            <a href="coaches">Coaches</a>
            <a href="schedule">Schedule</a>
            <a href="sportrecords">Records</a>
    </div>
    ?>
<?php if(isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['success']; ?>
        <?php unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>

<?php if(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error']; ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

    <div class="container">
        <h1>Hockey Men's Team</h1>
        
        <div class="form-container">
            <h2>Add Player</h2>
            <form id="player-form" action="<?=ROOT?>/sportscaptain/Team/addplayer" method="POST">
                <input type="text" id="player-regno" name="regno" placeholder="Player Reg No" required>
                <input type="text" id="player-position" name="position" placeholder="Position" required>
                <input type="number" id="player-number" name="jerseyno" placeholder="Jersey Number" required>
                <button type="submit" name="submit_add" class="submit-btn">Add Player</button>
            </form>
        </div>

        <div class="roster-container">
            <h2>Team</h2>
            <table id="roster-table">
                <thead>
                    <tr>
                        <th>Reg No</th>
                        <th>Position</th>
                        <th>Jersey Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($players)): ?>
                    <?php foreach ($players as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item->regno) ?></td>
                            <td><?= htmlspecialchars($item->position) ?></td>
                            <td><?= htmlspecialchars($item->jerseyno) ?></td>
                            <td>
                                    <button class="update-btn" data-id="<?= $item->regno ?>"><i class="fas fa-edit"></i></button>
                                </form>
                                <form method="POST" action="<?=ROOT?>/sportscaptain/team/deleteplayer">
                                    <input type="hidden" name="regno" value="<?= $item->regno ?>">
                                    <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this player?');"><i class="fas fa-trash"></i></button> 
                                </form>     
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No players found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit Player</h2>
            <form id="edit-form">
                
                    <input type="hidden" id="edit-regno" name="regno" readonly>
                <div class="form-group">
                    <label for="edit-position">Position:</label>
                    <input type="text" id="edit-position" name="position" required>
                </div>
                <div class="form-group">
                    <label for="edit-jerseyno">Jersey Number:</label>
                    <input type="number" id="edit-jerseyno" name="jerseyno" required>
                </div>
                <button type="submit" name="submit_update">Update Player</button>
            </form>
        </div>
    </div>


    

    <script src="<?=ROOT?>/assets/js/vidusha/team.js"></script>
</body>
</html>
