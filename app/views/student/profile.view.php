<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="stylesheet" href="ped.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/amar/profile.css">
</head>
<body>

<?php include 'nav.view.php'; ?>

<main>
    <div class="profile-container">
        <div class="profile-left">
            <div class="profile-image">
                <img src="<?=ROOT?>/assets/images/amar/profile.png" alt="Student Photo" id="studentPhoto">
            </div>
            <div class="basic-info">
                <?php if(!empty($details)): ?>
                    <?php foreach($details as $d): ?> 
                        <h3><?= $d->name ?></h3>
                        <p>Registration No: <?= $d->registrationnumber ?></p>
                        <p>Faculty: <?= $d->faculty ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="profile-right">
            <div class="info-card">
                <h3><i class="uil uil-info-circle"></i> General Information</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Registered Date:</label>
                        <span id="studentRegDate"></span>
                    </div>
                    <div class="info-item">
                        <label>ID Expiry Date:</label>
                        <span id="studentExpireDate"></span>
                    </div>
                    <div class="info-item">
                        <label>Academic Year:</label>
                        <span id="academicYearDisplay"></span>
                    </div>
                    <div class="info-item">
                        <label>Gender: <?= $d->gender ?></label>
                        <span id="studentGender"></span>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <h3><i class="uil uil-user"></i> Personal Information</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Birth Date: <?= $d->date_of_birth ?></label>
                        <span id="dobDisplay"></span>
                    </div>
                    <div class="info-item">
                        <label>NIC: <?= $d->nic ?></label>
                        <span id="studentNIC"></span>
                    </div>
                    <div class="info-item">
                        <label>Email: <?= $d->email ?></label>
                        <span id="studentEmail"></span>
                    </div>
                    <div class="info-item">
                        <label>Contact: <?= $d->contact_number ?></label>
                        <span id="studentContact"></span>
                    </div>
                    <div class="info-item">
                        <label>Address: <?= $d->address ?></label>
                        <span id="studentAddress"></span>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <h3><i class="uil uil-medal"></i> Achievements & Activities</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Sports:</label>
                        <span id="studentSports"></span>
                    </div>
                    <div class="info-item full-width">
                        <label>Achievements:</label>
                        <span id="studentAchievements"></span>
                    </div>
                </div>
            </div>

            <div class="actions">
                <button id="editRequestBtn">Request to Edit</button>
            </div>
        </div>
    </div>
</main>

<script>
    document.getElementById('editRequestBtn').addEventListener('click', function() {
        alert("Redirected to PED Admin");
        window.location.href = "http://localhost/PEAK/public/ped_incharge/users"; // Redirects to the PED Admin page
    });
</script>

</body>
</html>
