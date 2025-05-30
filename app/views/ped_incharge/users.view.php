<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile Management</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/users.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
<?php $current_page = 'users'; include 'sidebar.view.php'?>
    <div class="main-content">
        <div class="header">
            <h1>User Profiles Management</h1>
            <button class="bell-icon"><i class="uil uil-bell"></i></button>
            <button class="bell-icon"><i class="uil uil-signout"></i></button>
        </div>
        <main>
                <div class="container">

        <div class="tabs">
            <button class="tab active" onclick="showSection('student-registration')">Student Registration</button>
            <button class="tab" onclick="showSection('captain-assignment')">Sport Captain Assignment</button>
            <button class="tab" onclick="showSection('executive-assignment')">Club Executive Assignment</button>
            <button class="tab" onclick="showSection('user-display')">View Users</button>
        </div>

        <?php if(!empty($_SESSION['errors'])){
            foreach($_SESSION['errors'] as $err) {
                $errr = $err;
            }
            echo "<div id='error-message' style='position: fixed ;top: 20px; right: 20px;background-color:rgb(206, 29, 29);color: white; padding: 15px 20px; border-radius: 5px; z-index: 9999; box-shadow: 0 2px 10px rgba(0,0,0,0.2); transition: opacity 0.5s ease-out;'>" . $errr ."</div>";
            unset($_SESSION['errors']);
        }
        if (isset($_SESSION['success'])) {
            echo "<div id='success-message' style='position: fixed ;top: 20px; right: 20px;background-color:rgb(57, 184, 11);color: white; padding: 15px 20px; border-radius: 5px; z-index: 9999; box-shadow: 0 2px 10px rgba(0,0,0,0.2); transition: opacity 0.5s ease-out;'>"
                . htmlspecialchars($_SESSION['success']) . "</div>";
            unset($_SESSION['success']);
        }
        ?>

        <!-- Student Registration Form -->
        <div id="student-registration" class="form-section active">
            <h2>Student Registration</h2>
            <form id="studentForm" method="POST" action="<?=ROOT?>/ped_incharge/users/studentReg">
                <div class="grid">
                    <div class="form-group">
                        <label>Registration Number:</label>
                        <input type="text" name="regNumber" required>
                    </div>
                    <div class="form-group">
                        <label>Full Name:</label>
                        <input type="text" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Faculty:</label>
                        <input type="text" name="faculty" required>
                    </div>
                    <div class="form-group">
                        <label>Department:</label>
                        <input type="text" name="department" required>
                    </div>
                    <div class="form-group">
                        <label>Registered Date:</label>
                        <input type="date" name="id_start" required>
                    </div>
                    <div class="form-group">
                        <label>Last Examination Date:</label>
                        <input type="date" name="id_end" required>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Gender:</label>
                        <select name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>NIC:</label>
                        <input type="text" name="nic" required>
                    </div>
                    <div class="form-group">
                        <label>Date Of Birth:</label>
                        <input type="date" name="dob" required>
                    </div>
                    <div class="form-group">
                        <label>Contact Number:</label>
                        <input type="text" name="contact_number" required>
                    </div>
                    <div class="form-group">
                        <label>Address:</label>
                        <input type="text" name="address" required>
                    </div>
                </div>
                <button type="submit" class="btn submit-btn">Register Student</button>
            </form>
        </div>

        <!-- Sport Captain Assignment -->
        <div id="captain-assignment" class="form-section">
            <h2>Sport Captain Assignment</h2>
            <form id="captainForm" method="POST" action="<?=ROOT?>/ped_incharge/users/captainReg">
                <div class="grid">
                    <div class="form-group">
                        <label>Student Registration Number:</label>
                        <input type="text" name="regno" required>
                    </div>
                    <div class="form-group">
                        <label>Sport:</label>
                        <select name="sport" required>
                            <option value="">Select Sport</option>
                            <?php foreach ($sportsList as $sport): ?>
                                <option value="<?= $sport->sport_id ?>"><?= $sport->sport_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Assigned Date:</label>
                        <input type="date" name="assignedDate" required>
                    </div>
                    <div class="form-group">
                        <label>Captaincy End Date:</label>
                        <input type="date" name="endDate" required>
                    </div>
                    <div class="form-group">
                        <label>Captain or Vice-Captain:</label>
                        <select name="position" required>
                            <option value="">Select Position</option>
                            <option value="captain">Captain</option>
                            <option value="vice_captain">Vice Captain</option>
                            <option value="manager">Manager</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn submit-btn">Assign Captain</button>
            </form>
        </div>

        <!-- Club Executive Assignment -->
        <div id="executive-assignment" class="form-section">
            <h2>Amalgamated Club Executive Assignment</h2>
            <form id="executiveForm" method="POST" action="<?=ROOT?>/ped_incharge/users/clubReg">
                <div class="grid">
                    <div class="form-group">
                        <label>Student Registration Number:</label>
                        <input type="text" name="regno" required>
                    </div>
                    <div class="form-group">
                        <label>Designation:</label>
                        <input type="text" name="post" required>
                    </div>
                    <div class="form-group">
                        <label>Year:</label>
                        <input type="text" name="year" required>
                    </div>
                </div>
                <button type="submit" class="btn submit-btn">Assign Executive</button>
            </form>
        </div>

        <!-- User Display Section -->
        <div id="user-display" class="display-section">
            <h2>User Management</h2>
            <div class="filter-section">
            <div class="form-group">
                <label>Filter by Role:</label>
                    <select onchange="filterUsers(this.value)">
                        <option value="all">All Users</option>
                        <option value="Admin">Administrators</option>
                        <option value="Internal User">Students</option>
                        <option value="Sports Captain">Sports Captains</option>
                        <option value="Amalgamated Club Executive">Club Executives</option>
                        <option value="GroundIndoorStaff">Staff Members</option>
                    </select>
            </div>
            </div>
            <div class="table-responsive">
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>Role</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                       <?php if(!empty($usersList)): ?>
                        <?php foreach($usersList as $user): ?>
                            <tr class="user-row" data-role="<?= $user->role ?>">
                                <td><?= $user->role ?></td>
                                <td><?= $user->name ?></td>
                                <td><?= $user->email ?></td>
                                <td><?= $user->contact_number ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        </main>

    <script>
           //error message disappear
            setTimeout(() => {
            const fadeOut = (id) => {
                const el = document.getElementById(id);
                if (el) {
                    el.style.opacity = "0";
                    el.style.transform = "translateY(-10px)";
                    setTimeout(() => el.remove(), 500);
                }
            };

            fadeOut('error-message');
            fadeOut('success-message');
        }, 3000);
    </script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/users.js"></script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>

