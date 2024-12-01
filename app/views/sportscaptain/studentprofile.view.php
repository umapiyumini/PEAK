 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/studentprofiles.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>

    <div class="main-content">
        
            <div class="header-title">
                <h2>Student Profile</h2>
            
                <div class="search-bar">
                    <input 
                        type="text" 
                        id="searchInput" 
                        placeholder="Enter Registration Number" 
                        class="search-input" 
                    />
                    <button 
                        onclick="searchByRegNo()" 
                        class="btn-search">
                        <i class="uil uil-search"></i>
                        Search
                    </button>
                </div>
            </div>    
        
        
    
           
    <div class="profile-container">
        <div class="profile-left">
            <div class="profile-image">
                <img src="<?=ROOT?>/assets/images/vidusha/mcaptain.jpeg" alt="Student Photo" id="studentPhoto">
            </div>
            <h2 id="studentName">Student Name</h2>
            <div class="basic-info">
                <p>Registration No: <span id="studentRegNo"></span></p>
                <p>Faculty: <span id="studentFaculty"></span></p>
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
                        <label>Gender:</label>
                        <span id="studentGender"></span>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <h3><i class="uil uil-user"></i> Personal Information</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <label>studentBirthDate:</label>
                        <span id="dobDisplay"></span>
                    </div>
                    <div class="info-item">
                        <label>NIC:</label>
                        <span id="studentNIC"></span>
                    </div>
                    <div class="info-item">
                        <label>Email:</label>
                        <span id="studentEmail"></span>
                    </div>
                    <div class="info-item">
                        <label>Contact:</label>
                        <span id="studentContact"></span>
                    </div>
                    <div class="info-item">
                        <label>Address:</label>
                        <span id="studentAddress"></span>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <h3><i class="uil uil-other"></i> Health Information</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Height:</label>
                        <span id="studentHeight"></span>
                    </div>
                    <div class="info-item">
                        <label>Weight:</label>
                        <span id="studentWeight"></span>
                    </div>
                    <div class="info-item">
                        <label>Allergies:</label>
                        <span id="studentAllergies"></span>
                    </div>
                    <div class="info-item">
                        <label>Medicines:</label>
                        <span id="studentMedicines"></span>
                    </div>
                    <div class="info-item">
                        <label>Blood group:</label>
                        <span id="studentBlood"></span>
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
            <div class="edit-buttons">
                <button class="btn btn-edit" id="editButton">
                    <i class="uil uil-edit"></i> Edit Profile
                </button>
                <button class="btn btn-cancel" id="cancelButton" style="display: none;">
                    <i class="uil uil-times"></i> Cancel
                </button>
            </div>
        </div>
    </div>
        </main>
	<script src="<?=ROOT?>/assets/js/vidusha/studentprofiles.js"></script>
    
</body>
</html>