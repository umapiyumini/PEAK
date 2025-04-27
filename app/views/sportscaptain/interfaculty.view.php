<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hockey</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/tournaments.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>


<div class="navbar">
            <a href="tournamentrecords">Inter University</a>
            <a href="interfaculty">Inter Faculty</a>
            <a href="freshers">Freshers</a>
            <a href="other">Other</a>
    </div>>

<main>
    <div class="container">   
        <h1>Inter Faculty Tournament Records</h1>
        <div class="controls">
            <input type="hidden" id="tournament_name" name="tournament_name" value="Inter Faculty">
            <input type="text" id="yearFilter" placeholder="Enter Year">

            <select id="facultyFilter">
                <?php foreach($faculties as $faculty): ?>
                    <option value="<?=$faculty->facultyid?>"><?=$faculty->faculty_name?></option>
                <?php endforeach; ?>
            </select>

            <select id="categoryFilter">
                <option value="men">Men</option>
                <option value="women">Women</option>
            </select>

            <button type="button" class="add-btn" onclick="openForm(playerSearchForm)">Add Players</button>
            <button type="button" class="add-records-btn">Add Record</button>
        </div>

        <div class="record-table">
            <table id="record-table">
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>1st Place</th>
                        <th>2nd Place</th>
                        <th>3rd Place</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="record-body">
                    <?php if(!empty($data['tournaments'])): ?>
                        <?php foreach($data['tournaments'] as $record): ?>
                            <tr>
                            <td><?=$record->year?></td>
                <td><?=$record->first_place_faculty?></td>
                <td><?=$record->second_place_faculty?></td>
                <td><?=$record->third_place_faculty?></td>
                <td><?=$record->category?></td>
                <td>
                                    <button class="view-btn" data-id="<?=$record->id?>"><i class="uil uil-eye"></i></button>
                                    <button class="edit-btn" data-id="<?=$record->id?>"><i class="uil uil-edit"></i></button>
                                    <!-- <form action ="<?=ROOT?>/sportscaptain/interfaculty/deleterecord" method="POST">
                                    <input type="hidden" name="recordid" value="<?= $record->recordid ?>"> -->
                                    <button class="delete-btn" data-id="<?=$record->recordid?>"><i class="uil uil-trash"></i></button>
                                    <!-- </form> -->
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6">No records found</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Players Modal -->
<div id="playersModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('playersModal')">&times;</span>
        <h2>Players Registration Numbers</h2>
        <ul id="playerList"></ul>
        <button type="button" class="add-players-btn">Add Record</button>
        <button type="button" class="cancel" onclick="closeModal('playersModal')">Cancel</button>
    </div>
</div>

<!-- Add Tournament Modal -->
<div id="addrecordModal" class="modal">
 <div class="modal-content">
        <h2>Add Tournament Record</h2>
            <div class="modal-body">
                <form method="POST" action="<?= ROOT ?>/sportscaptain/interfaculty/addrecord">
                    <!-- Tournament Details Section -->
                    <input type="hidden" name="tournament_name" value="Inter Faculty">
                    <input type="hidden" name="sport_id" value="<?=$sport_id ?? ''?>">
                    <div class="form-group">
                        <label for="year">Year</label>
                        <input type="number" class="form-control" id="year" name="year" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="">Select Category</option>
                            <option value="Men">Men</option>
                            <option value="Women">Women</option>
                        </select>
                    </div>
                    
                    <hr>
                    
                    <!-- Place Information Section -->
                    <h5>Tournament Results</h5>
                    
                    <div class="form-group">
                        <label for="first_place">First Place</label>
                        <select class="form-control" id="first_place" name="place[1]">
                            <option value="">Select Faculty</option>
                            <?php foreach ($faculties as $faculty): ?>
                                <option value="<?= $faculty->facultyid ?>"><?= $faculty->faculty_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="second_place">Second Place</label>
                        <select class="form-control" id="second_place" name="place[2]">
                            <option value="">Select Faculty</option>
                            <?php foreach ($faculties as $faculty): ?>
                                <option value="<?= $faculty->facultyid ?>"><?= $faculty->faculty_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="third_place">Third Place</label>
                        <select class="form-control" id="third_place" name="place[3]">
                            <option value="">Select Faculty</option>
                            <?php foreach ($faculties as $faculty): ?>
                                <option value="<?= $faculty->facultyid ?>"><?= $faculty->faculty_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="modal-footer">
                    <button type="submit" class="save-btn">Save</button>
                    <button type="button" class="cancel" onclick="closeModal('addrecordModal')">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<!--edit modal-->
<div id="editrecordModal" class="modal">
 <div class="modal-content">
    <h2>Add Record</h2>
<form id="editRecordForm" method="POST" action="<?=ROOT?>/sportscaptain/interfaculty/addrecord">
    <input type="hidden" name="tournament_name" value="Inter Faculty">
    <input type="hidden" name="sportID" value="<?=$sport_id ?? ''?>">

    <label for="year">Year</label>
    <input type="text" name="year" placeholder="Enter Year" required>

    <label for="1stplace">1st Place</label>
    <select name="1stplace">
        <?php foreach($faculties as $faculty): ?>
            <option value="<?=$faculty->faculty_id?>"><?=$faculty->faculty_name?></option>
        <?php endforeach; ?>
    </select>

    <label for="2ndplace">2nd Place</label>
    <select name="2ndplace">
        <?php foreach($faculties as $faculty): ?>
            <option value="<?=$faculty->faculty_id?>"><?=$faculty->faculty_name?></option>
        <?php endforeach; ?>
    </select>

    <label for="3rdplace">3rd Place</label>
    <select name="3rdplace">
        <?php foreach($faculties as $faculty): ?>
            <option value="<?=$faculty->faculty_id?>"><?=$faculty->faculty_name?></option>
        <?php endforeach; ?>
    </select>

    <label for="category">Category</label>
    <select name="category" required>
        <option value="men">Men</option>
        <option value="women">Women</option>
    </select>

    <button type="submit" class="save-btn">Save</button>
    <button type="button" class="cancel" onclick="closeModal('addrecordModal')">Cancel</button>
</form>
 </div>
</div>

<div id="playerModal" class="modal">
    <div class="modal-content">
    <h2>Search Players by Tournament</h2>
    <form id="playerSearchForm" method="POST" action="<?=ROOT?>/sportscaptain/interfaculty/getPlayers">
        <div class="form-group">
            <label for="player_year">Year:</label>
            <input type="text" id="player_year" name="year" required>
        </div>
        
            <input type="hidden" id="sport_id" name="sport_id" required>
            <input type="hidden" id="tournament_name" name="tournament_name" value="Inter Faculty" required>
       
        
        <div class="form-group">
            <label for="player_category">Category:</label>
            <select id="player_category" name="category" required>
                <option value="men">Men</option>
                <option value="women">Women</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="faculty_id">Faculty:</label>
            <select id="faculty_id" name="faculty_id" required>
                <?php foreach($faculties as $faculty): ?>
                    <option value="<?=$faculty->facultyid?>"><?=$faculty->faculty_name?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <button type="submit" class="search-btn">Show Players</button>
    
     </form>
    <!-- Show players if they exist in the view data -->
    <?php if(!empty($data['players'])): ?>
    <div class="player-results">
        <h3>Player Registration Numbers</h3>
        <ul>
            <?php foreach($data['players'] as $player): ?>
                <li><?=$player->reg_no?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
    
    <!-- Show error message if it exists -->
    <?php if(!empty($data['error'])): ?>
    <div class="player-results">
        <p class="error"><?=$data['error']?></p>
    </div>
    <?php endif; ?>

</div>
    </div>
<script src="<?=ROOT?>/assets/js/vidusha/interfaculty.js"></script>
</body>
</html>
