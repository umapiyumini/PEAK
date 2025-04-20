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
    <?php if (!empty($courts)): ?>
        <?php foreach ($courts as $court): ?>
            <div class="facility-card" data-id="<?= $court->courtid ?>">
                <img src="<?= $court->image ?>" alt="<?= $court->name ?>" class="facility-image">
                <div class="facility-content">
                    <h3><?= $court->name ?></h3>
                    <p><?= $court->description ?></p>
                </div>
                <div class="facility-actions">
                <button class="btn btn-edit" onclick="fetchFacility(<?= $court->courtid ?>)">

    <i class="uil uil-edit"></i> 
</button>

    <button class="btn btn-delete" onclick='deleteFacility(<?= $court->courtid ?>)'>
        <i class="uil uil-trash-alt"></i> 
    </button>
</div>

            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No facilities found.</p>
    <?php endif; ?>
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
            <form id="reservationForm" method="post" action="<?=ROOT?>/ped_incharge/ped_facilities/add" enctype="multipart/form-data">

    <!-- Hidden input to store courtid -->
    <input type="hidden" id="editCourtid" name="courtid">

    <div class="form-group">
        <label for="facilityName">Facility Name</label>
        <input type="text" id="facilityName" name="name" required>
    </div>

    <div class="form-group">
        <label for="facilitlocation">Location</label>
        <input type="text" id="facilitylocation" name="location" required>
    </div>

    <div class="form-group">
        <label for="facilitysection">Section</label>
        <input type="text" id="facilitysection" name="section" required>
    </div>
    <div class="form-group">
        <label for="facilityDescription">Description</label>
        <textarea id="facilityDescription" rows="4" name="description" required></textarea>
    </div>
    <div class="form-group">
    <label>Current Image:</label>
    <img id="currentImage" src="" alt="Current Image" style="max-width: 100px; display: block; margin-bottom: 10px;">
</div>
<div class="form-group">
    <label for="facilityImage">Change Image:</label>
    <input type="file" id="facilityImage" name="image" accept="image/*">
</div>

    <button type="submit" class="btn btn-submit">Save Facility</button>
</form>

        </div>
    </div>
    
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
    

    <script src="<?=ROOT?>/assets/js/ped_incharge/facilities.js"></script>
</body>
</html>
