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
            <button class="tab" onclick="showSection('staff-registration')">Staff Registration</button>
            <button class="tab" onclick="showSection('captain-assignment')">Sport Captain Assignment</button>
            <button class="tab" onclick="showSection('executive-assignment')">Club Executive Assignment</button>
            <button class="tab" onclick="showSection('user-display')">View Users</button>
        </div>

        <!-- Student Registration Form -->
        <div id="student-registration" class="form-section active">
            <h2>Student Registration</h2>
            <form id="studentForm" onsubmit="handleStudentSubmit(event)">
                <div class="grid">
                    <div class="form-group">
                        <label>Role Type:</label>
                        <select name="roleNumber" required>
                            <option value="">Select Role</option>
                            <option value="2">Student Only</option>
                            <option value="3">Student and Sports Captain</option>
                            <option value="4">Student, Sports Captain and Club Executive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Registration Number:</label>
                        <input type="text" name="regNumber" required>
                    </div>
                    <div class="form-group">
                        <label>Faculty:</label>
                        <input type="text" name="faculty" required>
                    </div>
                    <div class="form-group">
                        <label>Start Date:</label>
                        <input type="date" name="startDate" required>
                    </div>
                    <div class="form-group">
                        <label>End Date:</label>
                        <input type="date" name="endDate" required>
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
                </div>
                <button type="submit" class="btn submit-btn">Register Student</button>
            </form>
        </div>

        <!-- Staff Registration Form -->
        <div id="staff-registration" class="form-section">
            <h2>Ground/Indoor Staff Registration</h2>
            <form id="staffForm" onsubmit="handleStaffSubmit(event)">
                <div class="grid">
                    <div class="form-group">
                        <label>Role Type:</label>
                        <select name="roleNumber" required>
                            <option value="">Select Role</option>
                            <option value="5">Staff Member</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Staff ID:</label>
                        <input type="text" name="staffId" required>
                    </div>
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Employee Number:</label>
                        <input type="text" name="employeeNumber" required>
                    </div>
                    <div class="form-group">
                        <label>Registration Number:</label>
                        <input type="text" name="regNumber" required>
                    </div>
                    <div class="form-group">
                        <label>NIC:</label>
                        <input type="text" name="nic" required>
                    </div>
                    <div class="form-group">
                        <label>Date of Birth:</label>
                        <input type="date" name="dob" required>
                    </div>
                    <div class="form-group">
                        <label>Contact Number:</label>
                        <input type="tel" name="contact" required>
                    </div>
                    <div class="form-group">
                        <label>Date of Appointment:</label>
                        <input type="date" name="appointmentDate" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Address:</label>
                    <input type="text" name="address" required>
                </div>
                <button type="submit" class="btn submit-btn">Register Staff</button>
            </form>
        </div>

        <!-- Sport Captain Assignment -->
        <div id="captain-assignment" class="form-section">
            <h2>Sport Captain Assignment</h2>
            <form id="captainForm" onsubmit="handleCaptainSubmit(event)">
                <div class="grid">
                    <div class="form-group">
                        <label>Role Type:</label>
                        <select name="roleNumber" required>
                            <option value="">Select Role</option>
                            <option value="3">Sports Captain</option>
                            <option value="4">Sports Captain and Club Executive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Student Registration Number:</label>
                        <input type="text" name="studentRegNumber" required>
                    </div>
                    <div class="form-group">
                        <label>Sport:</label>
                        <input type="text" name="sport" required>
                    </div>
                    <div class="form-group">
                        <label>Assigned Date:</label>
                        <input type="date" name="assignedDate" required>
                    </div>
                    <div class="form-group">
                        <label>Captaincy End Date:</label>
                        <input type="date" name="endDate" required>
                    </div>
                </div>
                <button type="submit" class="btn submit-btn">Assign Captain</button>
            </form>
        </div>

        <!-- Club Executive Assignment -->
        <div id="executive-assignment" class="form-section">
            <h2>Amalgamated Club Executive Assignment</h2>
            <form id="executiveForm" onsubmit="handleExecutiveSubmit(event)">
                <div class="grid">
                    <div class="form-group">
                        <label>Role Type:</label>
                        <select name="roleNumber" required>
                            <option value="">Select Role</option>
                            <option value="4">Club Executive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Student Registration Number:</label>
                        <input type="text" name="studentRegNumber" required>
                    </div>
                    <div class="form-group">
                        <label>Designation:</label>
                        <input type="text" name="designation" required>
                    </div>
                    <div class="form-group">
                        <label>Assigned Date:</label>
                        <input type="date" name="assignedDate" required>
                    </div>
                    <div class="form-group">
                        <label>End Date:</label>
                        <input type="date" name="endDate" required>
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
                        <option value="1">Administrators</option>
                        <option value="2">Students</option>
                        <option value="3">Sports Captains</option>
                        <option value="4">Club Executives</option>
                        <option value="5">Staff Members</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>Role</th>
                            <th>Registration/Staff ID</th>
                            <th>Name/Email</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        <!-- Table content will be dynamically populated -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

        </main>

    
	<script src="<?=ROOT?>/assets/js/ped_incharge/users.js"></script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>

