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
        <!-- freshers recoreds table-->
        <h1>Freshers Tournament Records</h1>
        <div class="controls">
            <input type="text" id="year" name="year" placeholder="Enter Year">
            <input type="text" id="placer" name="place" placeholder="Enter place">
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
                     <td><<button type="button" class="view-btn"> <i class="fas fa-view"></i> </button>
                     <button type="button" class="edit-btn"> <i class="fas fa-edit"></i> </button>
                     <button type="button" class="delete-btn"> <i class="fas fa-trash"></i> </button></td>
                </tbody>
            </table>
        </div>
</div>
    </main>
	<script src="<?=ROOT?>/assets/js/vidusha/sportprofile.js"></script>
</body>
</html>
