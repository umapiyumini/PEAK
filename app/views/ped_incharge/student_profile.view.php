<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/ped.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        .profile-container {
            width: 95%;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 2rem;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        /* Left sidebar styles */
        .profile-left {
            background: var(--gray-light);
            padding: 2rem 1.5rem;
            text-align: center;
            border-right: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            overflow: hidden;
            border: 5px solid white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-left h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .basic-info p {
            margin: 0.4rem 0;
            font-size: 0.95rem;
            color: #333;
            text-align: left;
        }

        .basic-info span {
            font-weight: 600;
            color: #000;
        }

        /* Right content styles */
        .profile-right {
            padding: 2rem;
        }

        .info-card {
            background: #fff;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .info-card h3 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .info-item.full-width {
            grid-column: 1 / -1;
        }

        .info-item label {
            color: #666;
            font-size: 0.9rem;
        }

        .info-item span {
            color: #333;
            font-weight: 500;
        }

        p span{
            font-weight: 500;
            width: 120px;
            color: black;
        }
        
    

        /* Responsive design */
        @media (max-width: 900px) {
            .profile-container {
                grid-template-columns: 1fr;
            }
            
            .profile-left {
                padding: 1.5rem;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        .edit-buttons {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-bottom: 1rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background: var(--edit-color);
            color: white;
        }

        .btn-save {
            background: var(--success-color);
            color: white;
        }

        .btn-cancel {
            background: #dc3545;
            color: white;
        }

        .info-item input, .info-item textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .info-item.editing label {
            color: #007bff;
        }

        .upload-photo {
            margin-top: 1rem;
            display: none;
        }

        .upload-photo.show {
            display: block;
        }

        .edit-mode .info-item span {
            display: none;
        }

        .view-mode .info-item input,
        .view-mode .info-item textarea {
            display: none;
        }
        #studentSports div {
            padding: 0.2rem 0;
            color: #333;
            font-weight: 500;
            border-bottom: 1px dashed #ccc;
        }
  
        .tournament-item {
            padding: 1rem 1.2rem;
            margin-bottom: 1rem;
            background-color: #ffffff;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }



        .tournament-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .tournament-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1f2937;
        }
        .tournament-name span {
            
            color: #666;
        }

        .tournament-date {
            font-size: 0.9rem;
            color: #6b7280;
        }

        .tournament-result {
            display: inline-block;
            background-color:var(--res-sports);
            color: white;
            font-weight: 500;
            padding: 4px 10px;
            font-size: 0.875rem;
            border-radius: 6px;
            margin-top: 6px;
            width: fit-content;
        }
        .tournament {
    margin-bottom: 1.5rem; 
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 1rem;
}


    </style>
</head>
<body>
<?php $current_page = 'studentprofile'; include 'sidebar.view.php'?>
<div class="main-content">
        
        <div class="header">
            <h1>Student Profile</h1>
        </div>
        <main>
            
            <div class="profile-container">
        <div class="profile-left">
            <div class="profile-image">
                <img src="<?=ROOT?>/assets/images/ped_incharge/pro_icon.jpg" alt="Student Photo" id="studentPhoto">
            </div>
            <?php if (!empty($studentDetails)) : ?>

                    <h2 id="studentName"><?=$studentDetails[0]->name?></h2>
                    <div class="basic-info">
                        <p>Registration No: <span id="studentRegNo"><?=$studentDetails[0]->registrationnumber?></span></p>
                        <p>Faculty: <span id="studentFaculty"><?=$studentDetails[0]->faculty?></span></p>
                        <p>Department: <span id="studentFaculty"><?=$studentDetails[0]->department?></span></p>
                        <p>Registered Date: <span id="studentRegDate"><?=$studentDetails[0]->id_start?></span></p>
                        <p>ID Expiry Date: <span id="studentExpireDate"><?=$studentDetails[0]->id_end?></span></p>
                    </div>

             <?php endif; ?>
        </div>
        <div class="profile-right">
            

            <div class="info-card">
                <h3><i class="uil uil-user"></i> Personal Information</h3>
                <div class="info-grid">
                    <div class="info-item">
                            <label>Gender:</label>
                            <span id="studentGender"><?=$studentDetails[0]->gender?></span>
                    </div>
                    <div class="info-item">
                        <label>Date of Birth:</label>
                        <span id="dobDisplay"><?=$studentDetails[0]->date_of_birth ?></span>
                    </div>
                    <div class="info-item">
                        <label>NIC:</label>
                        <span id="studentNIC"><?=$studentDetails[0]->nic ?></span>
                    </div>
                    <div class="info-item">
                        <label>Email:</label>
                        <span id="studentEmail"><?=$studentDetails[0]->email ?></span>
                    </div>
                    <div class="info-item">
                        <label>Contact:</label>
                        <span id="studentContact"><?=$studentDetails[0]->contact_number?></span>
                    </div>
                    <div class="info-item">
                        <label>Address:</label>
                        <span id="studentAddress"><?=$studentDetails[0]->address ?></span>
                    </div>
                </div>
            </div>
           
            <div class="info-card">
                <h3><i class="uil uil-medal"></i> Achievements & Activities</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Sports:</label>
                        <span id="studentSports">
                        <?php if (!empty($sports)) : ?>
                            <?php foreach ($sports as $sport): ?>
                                <div><?= htmlspecialchars($sport->sport_name) ?></div><br>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div>No sports registered.</div>
                        <?php endif; ?>
                        </span>
                    </div>
                    <div class="info-item full-width">
                        <label>Achievements:</label>
                        <div class="card-body">    
                            <div class="tournament-item interuni">
                                <?php if (!empty($interuni)) : ?>
                                    <?php foreach ($interuni as $i): ?>
                                        <div class="tournament">
                                            <div class="tournament-header">
                                                <div class="tournament-name"><?= htmlspecialchars($i->tournament_name) ?> - <span ><?= htmlspecialchars($i->sport_name) ?></span></div>
                                                <div class="tournament-date"><?= htmlspecialchars(date('Y', strtotime($i->date))) ?></div>
                                            </div>
                                            <div>
                                                <div class="tournament-result"><?= htmlspecialchars($i->place) ?></div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <div>No Tournaments.</div>
                                <?php endif; ?>
                            </div>
                            <div class="tournament-item interfaculty">
                                <?php if (!empty($tournament)) : ?>
                                    <?php foreach ($tournament as $i): ?>
                                        <div class="tournament">
                                            <div class="tournament-header">
                                                <div class="tournament-name"><?= htmlspecialchars($i->tournament_name) ?> - <span ><?= htmlspecialchars($i->sport_name) ?></span></div>
                                                <div class="tournament-date"><?= htmlspecialchars($i->year) ?></div>
                                            </div>
                                            <div>
                                                <div class="tournament-result">
                                                    <?php
                                                    $placeMap = [
                                                        '1' => 'Champions',
                                                        '2' => '2nd Place',
                                                        '3' => '3rd Place'
                                                    ];

                                                    echo htmlspecialchars($placeMap[$i->place] ?? $i->place);
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <div>No Tournaments.</div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="edit-buttons">
                <button class="btn btn-edit" id="editButton">
                    <i class="uil uil-edit"></i> Edit Profile
                </button>
                <button class="btn btn-save" id="saveButton" style="display: none;">
                    <i class="uil uil-save"></i> Save Changes
                </button>
                <button class="btn btn-cancel" id="cancelButton" style="display: none;">
                    <i class="uil uil-times"></i> Cancel
                </button>
            </div>
        </div>
    </div>
        </main>
	<script src="navbar.js"></script>
    <script>
        


    </script>
</body>
</body>
</html>

