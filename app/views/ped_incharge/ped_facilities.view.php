<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facilities</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/facilities.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
<?php $current_page = 'facilities'; include 'sidebar.view.php';?>
    <div class="main-content">
        <div class="header">
            <h1>Facilities</h1>
        </div>
        <main>
        
        <div class="facilities-container" id="facilitiesContainer">
            <!-- Facilities will be dynamically added here -->
        </div>

        <button class="add-facility" id="addFacilityBtn">
            <i class="uil uil-plus"></i>
        </button>
    </main>

    <!-- Modal for Add/Edit Facility -->
    <div class="modal" id="facilityModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Add Facility</h2>
                <span class="close">&times;</span>
            </div>
            <form id="facilityForm">
                <div class="form-group">
                    <label for="facilityName">Facility Name</label>
                    <input type="text" id="facilityName" required>
                </div>
                <div class="form-group">
                    <label for="facilityDescription">Description</label>
                    <textarea id="facilityDescription" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="facilityImage">Image URL</label>
                    <input type="text" id="facilityImage" required>
                </div>
                <button type="submit" class="btn btn-submit">Save Facility</button>
            </form>
        </div>
    </div>
	
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
    <script src="<?=ROOT?>/assets/js/ped_incharge/facilities.js"></script>
</body>
</html>

