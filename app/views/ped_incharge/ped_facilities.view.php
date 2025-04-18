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
                <button class="btn btn-edit" onclick="openEditModal(<?= $court->courtid ?>)">
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
            <form id="facilityForm">
    <!-- Hidden input to store courtid -->
    <input type="hidden" id="editCourtid" name="courtid">

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
    <script>
        // Show Add Facility Modal
document.getElementById('addFacilityBtn').onclick = function() {
    document.getElementById('facilityModal').style.display = 'block';
    document.getElementById('modalTitle').textContent = 'Add Facility';
    document.getElementById('facilityForm').reset();
    document.getElementById('editCourtid').value = '';
};

// Close Modal
document.querySelector('#facilityModal .close').onclick = function() {
    document.getElementById('facilityModal').style.display = 'none';
};

// Optional: Close modal when clicking outside content
window.onclick = function(event) {
    const modal = document.getElementById('facilityModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
};

// Handle Add/Edit Facility Form Submission
document.getElementById('facilityForm').onsubmit = function(e) {
    e.preventDefault();

    // Collect form data
    const courtid = document.getElementById('editCourtid').value;
    const name = document.getElementById('facilityName').value;
    const description = document.getElementById('facilityDescription').value;
    const image = document.getElementById('facilityImage').value;
    // Add location and section fields if present in your form
    // const location = document.getElementById('facilityLocation').value;
    // const section = document.getElementById('facilitySection').value;

    // Build data object
    const data = {
        name: name,
        description: description,
        image: image
        // Uncomment below if you have these fields in your form and DB
        // ,location: location,
        // section: section
    };

    // If courtid is present, it's an edit; otherwise, it's an add
    let url = '<?=ROOT?>/ped_facilities/add';
    if (courtid) {
        data.courtid = courtid;
        url = '<?=ROOT?>/ped_facilities/update';
    }

    fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams(data)
    })
    .then(response => response.text())
    .then(result => {
        if (result === 'success') {
            // Optionally close modal and refresh the facility list
            document.getElementById('facilityModal').style.display = 'none';
            location.reload();
        } else {
            alert('Error saving facility');
        }
    })
    .catch(() => alert('Error saving facility'));
};

        </script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
    

    <script src="<?=ROOT?>/assets/js/ped_incharge/facilities.js"></script>
</body>
</html>
