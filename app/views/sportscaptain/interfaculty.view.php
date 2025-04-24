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
    </div>
    
	<main>
        <div class="container">   
        <!-- interfaculty recoreds table-->
        <h1>Inter Faculty Tournament Records</h1>
        <div class="controls">
            <input type="hidden" id="tournament_name" name="tournament_name" value="Inter Faculty">
            <input type="text" id="year" name="year" placeholder="Enter Year">
            <select id ="faculty_id" name="faculty_id">
                <option value="1">Arts</option>
                <option value="2">Education</option>
                <option value="3">Graduate Studies</option>
                <option value="4">indigenous Medicine</option>
                <option value="5">Law</option>
                <option value="6">Management</option>
                <option value="7">Medicine</option>
                <option value="8">Science</option>
                <option value="9">Technology</option>
                <option value="10">Nursing</option>
                <option value="11">Sri Palee</option>
                <option value="12">UCSC</option>
        </select>
            <select id="category" name="category">
                <option value="men">Men</option>
                <option value="women">Women</option>
            </select>
            <button type="button" class="add-btn">Add Recored</button>
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
                    <!-- Records will be dynamically added here -->
                    <td> <button type="button" class="view-btn"> <i class="fas fa-view"></i> </button>
                     <button type="button" class="edit-btn"> <i class="fas fa-edit"></i> </button>
                     <button type="button" class="delete-btn"> <i class="fas fa-trash"></i> </button></td>
                </tbody>
            </table>
        </div>
    </main>

    <!-- view modal-->
<div id="interfacultyViewModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('interfacultyViewModal')">&times;</span>
    <h2>Inter University Players</h2>
    <div id="viewPlayers">
      <ul id="interUniPlayerList"></ul>
    </div>
    <button type="button" class="cancel" onclick="closeModal('interuniViewModal')">Close</button>
  </div>
</div>

	<script src="<?=ROOT?>/assets/js/vidusha/interfaculty.js"></script>
</body>
</html>
