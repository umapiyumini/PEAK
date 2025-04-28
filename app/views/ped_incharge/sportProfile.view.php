<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sport Profile</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/hockey.css">
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
.admin-panel {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    padding: 25px;
    margin-bottom: 40px;
}

.panel-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    border-bottom: 1px solid #eee;
    padding-bottom: 15px;
}

.panel-header h2 {
    font-size: 22px;
    margin: 0;
    color: #333;
}

/* Button Styles */
.btn {
    padding: 10px 16px;
    border-radius: 5px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-primary {
    background-color: #2B124C;
    color: white;
}

.btn-secondary {
    background-color: #e0e0e0;
    color: #333;
}

.btn-secondary:hover {
    background-color: #d0d0d0;
}

.action-buttons {
    display: flex;
    gap: 10px;
    justify-content: center;
}

.btn-edit, .btn-delete {
    border: none;
    background: none;
    cursor: pointer;
    font-size: 18px;
    transition: all 0.2s ease;
    padding: 5px;
    border-radius: 4px;
}

.btn-edit {
    color: #2196F3;
}

.btn-edit:hover {
    background-color: rgba(33, 150, 243, 0.1);
}

.btn-delete {
    color: #F44336;
}

.btn-delete:hover {
    background-color: rgba(244, 67, 54, 0.1);
}

/* Table Styles */
.table-responsive {
    overflow-x: auto;
    margin-top: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 1px 4px rgba(0,0,0,0.05);
}

thead th {
    background-color: #f5f5f5;
    padding: 12px 15px;
    text-align: left;
    font-weight: 600;
    color: #333;
    border-bottom: 2px solid #e0e0e0;
}

tbody td {
    padding: 12px 15px;
    border-bottom: 1px solid #eee;
    color: #555;
}

tbody tr:last-child td {
    border-bottom: none;
}

tbody tr:hover {
    background-color: #f9f9f9;
}

.no-data {
    text-align: center;
    padding: 30px;
    color: #888;
    font-style: italic;
}

/* Search and Filter Controls */
.search-filter, .schedule-controls {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

input[type="text"], input[type="email"], input[type="tel"], 
input[type="number"], input[type="date"], input[type="time"],
select, textarea {
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 15px;
    width: 100%;
    transition: border-color 0.2s ease;
}

input:focus, select:focus, textarea:focus {
    border-color: #A62639;
    outline: none;
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
    animation: fadeIn 0.3s;
}

.modal-content {
    background-color: #fff;
    margin: 5% auto;
    padding: 25px;
    border-radius: 10px;
    width: 90%;
    max-width: 600px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    position: relative;
    animation: slideIn 0.3s;
}

.close-modal {
    position: absolute;
    right: 15px;
    top: 15px;
    font-size: 24px;
    color: #aaa;
    cursor: pointer;
}

.close-modal:hover {
    color: #333;
}

/* Form Styles */
.form-group {
    margin-bottom: 20px;
}

.form-row {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.form-row .form-group {
    flex: 1;
    min-width: 200px;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #444;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 15px;
    margin-top: 25px;
}

/* Coaches Grid */
.coaches-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 25px;
    margin-top: 25px;
}

.coach-card {
    background-color: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    transition: transform 0.3s ease;
    position: relative;
    padding: 20px;
}

.coach-card:hover {
    transform: translateY(-5px);
}

.coach-actions {
    position: absolute;
    top: 10px;
    right: 10px;
    display: flex;
    gap: 8px;
}

.coach-photo {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    margin: 15px auto;
    display: block;
    border: 3px solid #f5f5f5;
}

.coach-card h3 {
    font-size: 18px;
    margin: 10px 0 5px;
    text-align: center;
    color: #333;
}

.coach-card h4 {
    font-size: 14px;
    margin: 0 0 15px;
    text-align: center;
    color: #666;
    font-weight: normal;
}

.coach-card p {
    font-size: 14px;
    line-height: 1.6;
    color: #555;
    margin-bottom: 15px;
}

.coach-contact {
    margin-top: 15px;
    font-size: 14px;
    color: #555;
}

.coach-contact p {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 5px;
}

.coach-contact i {
    color: #A62639;
    font-size: 16px;
}

/* No Data Placeholder */
.no-data-card {
    text-align: center;
    padding: 40px 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    border: 1px dashed #ddd;
}

.no-data-card i {
    font-size: 50px;
    color: #ccc;
    margin-bottom: 15px;
    display: block;
}

.no-data-card p {
    color: #888;
    font-size: 16px;
}

/* Player thumbnails */
.player-thumbnail {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

/* Game Results */
.game-result .win {
    color: #4CAF50;
    font-weight: 600;
}

.game-result .loss {
    color: #F44336;
    font-weight: 600;
}

.game-result .tie {
    color: #FF9800;
    font-weight: 600;
}

/* Attendance Table */
#attendance-chart .present {
    background-color: rgba(76, 175, 80, 0.15);
    color: #2E7D32;
}

#attendance-chart .absent {
    background-color: rgba(244, 67, 54, 0.15);
    color: #C62828;
}

/* Records Tab System */
.tabs {
    display: flex;
    border-bottom: 1px solid #ddd;
    margin-bottom: 25px;
    overflow-x: auto;
}

.tab-btn {
    padding: 12px 20px;
    border: none;
    background: none;
    cursor: pointer;
    font-size: 15px;
    font-weight: 500;
    color: #666;
    position: relative;
    transition: color 0.3s ease;
}

.tab-btn.active {
    color: #A62639;
}

.tab-btn.active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    height: 3px;
    background-color: #A62639;
}

.record-tab {
    animation: fadeIn 0.3s;
}

/* Stats Cards */
.stats-cards {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
    margin-top: 25px;
}

.stats-card {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    padding: 20px;
    position: relative;
}

.card-actions {
    position: absolute;
    top: 15px;
    right: 15px;
    display: flex;
    gap: 8px;
}

.stats-card h3 {
    font-size: 18px;
    margin: 0 0 15px;
    padding-bottom: 10px;
    border-bottom: 1px solid #eee;
    color: #333;
}

.stats-info {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 20px;
}

.stat-item {
    display: flex;
    flex-direction: column;
}

.stat-label {
    font-size: 13px;
    color: #666;
}

.stat-value {
    font-size: 16px;
    font-weight: 600;
    color: #333;
}

.season-notes {
    font-size: 14px;
    line-height: 1.6;
    color: #555;
    margin-top: 15px;
    border-top: 1px solid #eee;
    padding-top: 15px;
}

/* Status Filter */
.status-filter {
    display: flex;
    gap: 10px;
}

.filter-btn {
    padding: 8px 16px;
    border: 1px solid #ddd;
    border-radius: 20px;
    background: none;
    cursor: pointer;
    font-size: 14px;
    transition: all 0.2s ease;
}

.filter-btn.active {
    background-color: #A62639;
    color: white;
    border-color: #A62639;
}

/* Season Selection */
.season-selector {
    display: flex;
    align-items: center;
    gap: 10px;
}

.season-selector label {
    margin-bottom: 0;
    white-space: nowrap;
}

.season-selector select {
    width: auto;
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideIn {
    from { transform: translateY(-30px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .stats-info {
        grid-template-columns: 1fr;
    }
    
    .form-row {
        flex-direction: column;
    }
    
    .coaches-grid, .stats-cards {
        grid-template-columns: 1fr;
    }
    
    .tabs {
        gap: 10px;
    }
    
    .tab-btn {
        padding: 10px 15px;
        font-size: 14px;
    }
    
    .panel-header {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
    }
}
</style>
</head>
<body>
    <?php $current_page = 'sports'; include 'sidebar.view.php'?>
    <div class="main-content">
        <div class="navbar" style="border-radius:8px;">
            <a onclick="switchTab('home')">Home</a>
            <a onclick="switchTab('attendance')">Attendance</a>
            <a onclick="switchTab('team')">Team</a>
            <a onclick="switchTab('coaches')">Coaches</a>
            <a onclick="switchTab('schedule')">Schedule</a>
        </div>
        
        <div id="home" class="container">
            <section class="main-content2">
                <h1><?=$sportdetails->sport_name?></h1>
                <div class="image-slider">
                    <div class="slides">
                        <img src="<?=ROOT?>/<?=$sportdetails->frontimage?>" alt="Hockey Action 1">
                    </div>
                    <button class="prev">&#10094;</button>
                    <button class="next">&#10095;</button>
                </div>
                <h2>Team 2024</h2>
                <article class="captains">
                    <div class="tile2">
                        <?php if(!empty($sportcapdetails)): 
                            foreach($sportcapdetails as $j):
                                ?>
                                <img src="<?=ROOT?>/<?=$j->image?>" alt="cap-men">
                                <div class="cap-name">
                                    <p style="color:grey;"><?=$j->position?></p>
                                    <p><?=$j->name?></p>
                                </div>
                                <?php endforeach;
                        endif;?>
                    </div>                 
                </article>
            </section>
            
            <aside class="latest-news">
                <h2>Latest News</h2>
                <div id="newsContainer">
                    <?php if(!empty($sportnews)):?>
                        <?php foreach($sportnews as $i):?>
                            <div class="news-item">
                                <h3><?=$i->topic?></h3>
                                <p><?=$i->content?></p>
                                <p class="news-date">Published: <?=$i->published_date?></p>
                            </div>
                            <?php endforeach;?>
                            <?php endif;?>
                        </div>
                    </aside>
                </div>
                
                <div id="attendance" class="container" style="display:none">
            <h1 style="margin-top:4rem;">Attendance</h1>
            <div class="controls">
                <input type="text" id="search-bar" placeholder="Search by player name..." onkeyup="filterTable()">
            </div>
            
            <table id="attendance-chart">
                <thead>
                    <tr>
                        <th>Player Name</th>
                        <th>2024-11-22</th>
                        <th>2024-11-23</th>
                        <th>2024-11-24</th>
                        <th>2024-11-25</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Aamir Arshad</td>
                        <td class="present">Present</td>
                        <td class="absent" title="Sick">Absent</td>
                        <td class="present">Present</td>
                        <td class="absent" title="Sick">Absent</td>
                    </tr>
                    <tr>
                        <td>Dinith Dulanja</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                        <td class="absent" title="Sick">Absent</td>
                        <td class="present">Present</td>
                    </tr>
                    <tr>
                        <td>Amantha Tharusha</td>
                        <td class="absent" title="Sick">Absent</td>
                        <td class="absent" title="Sick">Absent</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                    </tr>
                    <tr>
                        <td>Theshawa Dasun</td>
                        <td class="absent" title="Sick">Absent</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                    </tr>
                    <tr>
                        <td>Mario Silva</td>
                        <td class="absent" title="Sick">Absent</td>
                        <td class="absent" title="Sick">Absent</td>
                        <td class="present">Present</td>
                        <td class="absent" title="lectures">Absent</td>
                    </tr>
                    <tr>
                        <td>Pasindu Madhushan</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                    </tr>
                    <tr>
                        <td>Akindu Liyange</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                    </tr>
                    <tr>
                        <td>Gayan Sasmina</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                    </tr>
                    <tr>
                        <td>Hirusha Deemantha</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                        <td class="absent" title="Sick">Absent</td>
                    </tr>
                    <tr>
                        <td>Chanaka Sampath</td>
                        <td class="present">Present</td>
                        <td class="present">Present</td>
                        <td class="absent" title="sick">Absent</td>
                        <td class="present">Present</td>
                    </tr>
                </tbody>
            </table>

                </div>
                
                <!-- TEAM SECTION -->
<div id="team" class="container" style="display:none">
    <h1 style="margin-top:4rem;">Team Management</h1>
    
    <div class="admin-panel">
        <div class="panel-header">
            <h2>Current Team Members</h2>
        </div>
        
        <div class="search-filter">
            <input type="text" id="team-search" placeholder="Search players..." onkeyup="filterTeamMembers()">
            <select id="position-filter" onchange="filterTeamMembers()">
                <option value="all">All Positions</option>
                <option value="forward">Forward</option>
                <option value="midfielder">Midfielder</option>
                <option value="defender">Defender</option>
                <option value="goalkeeper">Goalkeeper</option>
            </select>
        </div>
        
        <div class="table-responsive">
            <table id="team-members-table">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Year</th>
                        <th>Jersey #</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($teammembers)): 
                        foreach($teammembers as $member): ?>
                            <tr>
                                <td><img src="<?=ROOT?>/<?=$member->image?>" alt="<?=$member->name?>" class="player-thumbnail"></td>
                                <td><?=$member->name?></td>
                                <td><?=$member->position?></td>
                                <td><?=$member->year?></td>
                                <td><?=$member->jersey_number?></td>
                            </tr>
                        <?php endforeach;
                    else: ?>
                        <tr>
                            <td colspan="6" class="no-data">No team members added yet</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- COACHES SECTION -->
<div id="coaches" class="container" style="display:none">
    <h1 style="margin-top:4rem;">Coaches and Instructors</h1>
    
    <div class="admin-panel">
        <div class="panel-header">
            <h2>Coaching Staff</h2>
            <button class="btn btn-primary" onclick="showAddCoachModal()"><i class="uil uil-plus"></i> Add Coach</button>
        </div>
        
        <div class="coaches-grid">
            <?php if(!empty($coaches)): 
                foreach($coaches as $coach): ?>
                    <div class="coach-card">
                        <div class="coach-actions">
                            <button class="btn-edit" onclick="editCoach(<?=$coach->empid?>)"><i class="uil uil-edit"></i></button>
                            <button class="btn-delete" onclick="confirmDeleteCoach(<?=$coach->empid?>, <?=$sportdetails->sport_id?>)"><i class="uil uil-trash-alt"></i></button>
                        </div>
                        <h3><?=$coach->name?></h3>
                        <h4><?=$coach->role?></h4>
                        <p><?=$coach->experience?><i class='uil uil-star'></i></p>
                        <div class="coach-contact">
                            <p><i class="uil uil-envelope"></i> <?=$coach->email?></p>
                            <p><i class="uil uil-phone"></i> <?=$coach->phone?></p>
                        </div>
                    </div>
                <?php endforeach;
            else: ?>
                <div class="no-data-card">
                    <i class="uil uil-user-exclamation"></i>
                    <p>No coaches added yet</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Add Coach Modal -->
    <div id="add-coach-modal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeAddCoachModal()">&times;</span>
            <h2>Add New Coach</h2>
            <form id="add-coach-form" method="post" action="<?=ROOT?>/ped_incharge/sportprofile/addcoach" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="coach-name">Name</label>
                    <input type="text" id="coach-name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="coach-role">Role</label>
                    <input type="text" id="coach-role" name="role" required placeholder="e.g. Head Coach, Assistant Coach">
                </div>
                <div class="form-group">
                    <label for="coach-bio">Experience</label>
                    <textarea id="coach-bio" name="bio" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="coach-nic">NIC</label>
                    <input type="text" id="coach-nic" name="nic">
                </div>
                <div class="form-group">
                    <label for="coach-email">Email</label>
                    <input type="email" id="coach-email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="coach-phone">Phone</label>
                    <input type="tel" id="coach-phone" name="phone">
                </div>
                <div class="form-group">
                    <label for="coach-address">Address</label>
                    <input type="text" id="coach-address" name="address">
                </div>
                <input type="hidden" name="sportid" value="<?=$sportdetails->sport_id?>">
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeAddCoachModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Coach</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SCHEDULE SECTION -->
<div id="schedule" class="container" style="display:none">
    <h1 style="margin-top:4rem;">Schedule Management</h1>
    
    <div class="admin-panel">
        <div class="panel-header">
            <h2>Upcoming Games</h2>
            <button class="btn btn-primary" onclick="showAddGameModal()"><i class="uil uil-plus"></i> Add Game</button>
        </div>
        
        <div class="schedule-controls">
            <div class="season-selector">
                <label for="season-select">Season:</label>
                <select id="season-select" onchange="filterSchedule()">
                    <option value="2024-2025">2024-2025</option>
                    <option value="2023-2024">2023-2024</option>
                    <option value="2022-2023">2022-2023</option>
                </select>
            </div>
            
            <div class="status-filter">
                <button class="filter-btn active" data-filter="all">All Games</button>
                <button class="filter-btn" data-filter="upcoming">Upcoming</button>
                <button class="filter-btn" data-filter="completed">Completed</button>
            </div>
        </div>
        
        <div class="table-responsive">
            <table id="games-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Opponent</th>
                        <th>Location</th>
                        <th>Result</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($games)): 
                        foreach($games as $game): ?>
                            <tr class="<?=$game->status?>">
                                <td><?=date('M d, Y', strtotime($game->date))?></td>
                                <td><?=date('h:i A', strtotime($game->time))?></td>
                                <td><?=$game->opponent?></td>
                                <td><?=$game->location?></td>
                                <td class="game-result">
                                    <?php if($game->status == 'completed'): ?>
                                        <span class="<?=$game->result?>">
                                            <?=$game->home_score?> - <?=$game->away_score?>
                                            (<?=ucfirst($game->result)?>)
                                        </span>
                                    <?php else: ?>
                                        Upcoming
                                    <?php endif; ?>
                                </td>
                                <td class="action-buttons">
                                    <button class="btn-edit" onclick="editGame(<?=$game->id?>)"><i class="uil uil-edit"></i></button>
                                    <button class="btn-delete" onclick="confirmDeleteGame(<?=$game->id?>)"><i class="uil uil-trash-alt"></i></button>
                                </td>
                            </tr>
                        <?php endforeach;
                    else: ?>
                        <tr>
                            <td colspan="6" class="no-data">No games scheduled yet</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Add Game Modal -->
    <div id="add-game-modal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeAddGameModal()">&times;</span>
            <h2>Add New Game</h2>
            <form id="add-game-form" method="post" action="<?=ROOT?>/sportprofile/addgame">
                <div class="form-row">
                    <div class="form-group">
                        <label for="game-date">Date</label>
                        <input type="date" id="game-date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="game-time">Time</label>
                        <input type="time" id="game-time" name="time" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="game-opponent">Opponent</label>
                    <input type="text" id="game-opponent" name="opponent" required>
                </div>
                <div class="form-group">
                    <label for="game-location">Location</label>
                    <input type="text" id="game-location" name="location" required>
                </div>
                <div class="form-group">
                    <label for="game-season">Season</label>
                    <select id="game-season" name="season" required>
                        <option value="2024-2025">2024-2025</option>
                        <option value="2023-2024">2023-2024</option>
                        <option value="2022-2023">2022-2023</option>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeAddGameModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Game</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
        
    </div>
        
        <script>
                function switchTab(tabId) {
                    // First, hide all sections
                    const sections = document.querySelectorAll('.container');
                    sections.forEach(section => {
                        section.style.display = 'none';
                    });

                    // Then show the selected section
                    document.getElementById(tabId).style.display = 'block';
                }
                function showAddCoachModal() {
                    document.getElementById('add-coach-modal').style.display = 'block';
                }

                function closeAddCoachModal() {
                    document.getElementById('add-coach-modal').style.display = 'none';
                }

                function editCoach(id) {
                    fetch(`getCoach/${id}`)
                    .then(response => response.json())
                    .then(data => {
                            console.log(data);
                            // Populate form with coach data
                            document.getElementById('coach-name').value = data.name;
                            document.getElementById('coach-role').value = data.role;
                            document.getElementById('coach-bio').value = data.experience;
                            document.getElementById('coach-nic').value = data.nic;
                            document.getElementById('coach-email').value = data.email;
                            document.getElementById('coach-phone').value = data.phone;
                            document.getElementById('coach-address').value = data.address;
                            
                            // Update form action for edit rather than add
                            document.getElementById('add-coach-form').action = `editcoach/${id}`;
                            document.querySelector('#add-coach-modal h2').textContent = 'Edit Coach';
                            document.querySelector('#add-coach-form button[type="submit"]').textContent = 'Update Coach';
                            
                            // Show the modal
                            showAddCoachModal();
                        })
                        .catch(error => {
                            console.error('Error fetching coach data:', error);
                            alert('Failed to load coach data. Please try again.');
                        });
                }

                function confirmDeleteCoach(id, sportid) {
                    if (confirm('Are you sure you want to remove this coach?')) {
                        window.location.href = `deletecoach/${id}/${sportid}`;
                    }
                }
            </script>

	<script src="<?=ROOT?>/assets/js/ped_incharge/hockey.js"></script>
</body>
</html>