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
                  
            </div>
        </div>

        <div class="profile-right">
            <div class="info-card">
                <h3><i class="uil uil-info-circle"></i> General Information</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Registered Date:2023-05-21<?= $d->id_start ?></label>
                        <span id="studentRegDate"></span>
                    </div>
                    <div class="info-item">
                        <label>ID Expiry Date:2026-05-21<?= $d->id_end ?></label>
                        <span id="studentExpireDate"></span>
                    </div>
                    <div class="info-item">
                        <label>Academic Year:1</label>
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
                        <label>Birth Date: 2002-07-02</label>
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
                        <label>Address: No:47,Ulpothapitiya,Kiula,Matale</label>
                        <span id="studentAddress"></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?> 

           
            <div class="actions">
                <button id="editRequestBtn">Request to Edit</button>
            </div>
        </div>
    </div>
</main>

<script>
    document.getElementById('editRequestBtn').addEventListener('click', function() {
        alert("Redirected to PED Admin");
    });
</script>

</body>
</html>
