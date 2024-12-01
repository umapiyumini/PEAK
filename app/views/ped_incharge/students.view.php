<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profiles</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/students.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
<?php $current_page = 'studentprofile'; include 'sidebar.view.php'?>
    <div class="main-content">
        <div class="header">
            <h1>Student Profiles</h1>
        </div>
        <main>
            <div class="student-controls">
                <div class="search-bar">
                    <input type="text" id="searchInput" placeholder="Search students...">
                    <i class="uil uil-search"></i>
                </div>
                <button class="add-student-btn" id="openAddModal">
                    <i class="uil uil-plus"></i> Add New Student
                </button>
            </div>
            <div>
                <div class="student-table">
                    <table id="studentTable">
                        <thead>
                            <tr>
                                <th>Reg. No</th>
                                    <th>Name</th>
                                    <th>Faculty</th>
                                    <th>Gender</th>
                                    <th>Actions</th>   
                                </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>


                    
            <!-- Add Student Modal -->
            <div id="addModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Add New Student</h2>
                    <form id="addStudentForm">
                        <!-- Registration Number -->
                        <div class="form-group">
                            <label for="studentRegNo">Registration No:</label>
                            <input type="text" id="studentRegNo" required>
                        </div>
                        <!-- Full Name -->
                        <div class="form-group">
                            <label for="studentName">Full Name:</label>
                            <input type="text" id="studentName" required>
                        </div>
                        <!-- Faculty -->
                        <div class="form-group">
                            <label for="studentFaculty">Faculty:</label>
                            <input type="text" id="studentFaculty" required>
                        </div>
                        <!-- Registered Date -->
                        <div class="form-group">
                            <label for="studentRegDate">Registered Date:</label>
                            <input type="date" id="studentRegDate" required>
                        </div>
                        <!-- ID Expiry Date -->
                        <div class="form-group">
                            <label for="studentExpireDate">ID Expiry Date:</label>
                            <input type="date" id="studentExpireDate" required>
                        </div>
                        <!-- Date of Birth -->
                        <div class="form-group">
                            <label for="studentBirthDate">Date of Birth:</label>
                            <input type="date" id="studentBirthDate" required>
                        </div>
                        <!-- NIC -->
                        <div class="form-group">
                            <label for="studentNIC">NIC:</label>
                            <input type="text" id="studentNIC" required>
                        </div>
                        <!-- Email -->
                        <div class="form-group">
                            <label for="studentEmail">Email:</label>
                            <input type="email" id="studentEmail">
                        </div>
                        <!-- Contact Number -->
                        <div class="form-group">
                            <label for="studentContact">Contact Number:</label>
                            <input type="tel" id="studentContact" pattern="[0-9]{10}" placeholder="Enter 10-digit number" required>
                        </div>
                        <!-- Gender -->
                        <div class="form-group">
                            <label for="studentGender">Gender:</label>
                            <select id="studentGender" required>
                                <option value="" disabled selected>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <!-- Address -->
                        <div class="form-group">
                            <label for="studentAddress">Address:</label>
                            <textarea id="studentAddress" rows="3" required></textarea>
                        </div>
                        <!-- Sports -->
                        <div class="form-group">
                            <label for="studentSports">Sports:</label>
                            <input type="text" id="studentSports" placeholder="E.g., Football, Basketball">
                        </div>
                        <!-- Achievements -->
                        <div class="form-group">
                            <label for="studentAchievements">Achievements:</label>
                            <textarea id="studentAchievements" rows="3" ></textarea>
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-cancel">Cancel</button>
                            <button type="submit" class="btn btn-save">Add Student</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Edit Student Modal -->
            <div id="editModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Edit Student</h2>
                    <form id="editStudentForm">
                        <input type="hidden" id="editStudentId">
                        <!-- Registration Number -->
                        <div class="form-group">
                            <label for="editStudentRegNo">Registration No:</label>
                            <input type="text" id="editStudentRegNo" required>
                        </div>
                        <!-- Full Name -->
                        <div class="form-group">
                            <label for="editStudentName">Full Name:</label>
                            <input type="text" id="editStudentName" required>
                        </div>
                        <!-- Faculty -->
                        <div class="form-group">
                            <label for="editStudentFaculty">Faculty:</label>
                            <input type="text" id="editStudentFaculty" required>
                        </div>
                        <!-- Registered Date -->
                        <div class="form-group">
                            <label for="editStudentRegDate">Registered Date:</label>
                            <input type="date" id="editStudentRegDate" required>
                        </div>
                        <!-- ID Expiry Date -->
                        <div class="form-group">
                            <label for="editStudentExpireDate">ID Expiry Date:</label>
                            <input type="date" id="editStudentExpireDate" required>
                        </div>
                        <!-- Date of Birth -->
                        <div class="form-group">
                            <label for="editStudentBirthDate">Date of Birth:</label>
                            <input type="date" id="editStudentBirthDate" required>
                        </div>
                        <!-- NIC -->
                        <div class="form-group">
                            <label for="editStudentNIC">NIC:</label>
                            <input type="text" id="editStudentNIC" required>
                        </div>
                        <!-- Email -->
                        <div class="form-group">
                            <label for="editStudentEmail">Email:</label>
                            <input type="email" id="editStudentEmail">
                        </div>
                        <!-- Contact Number -->
                        <div class="form-group">
                            <label for="editStudentContact">Contact Number:</label>
                            <input type="tel" id="editStudentContact" pattern="[0-9]{10}" required>
                        </div>
                        <!-- Gender -->
                        <div class="form-group">
                            <label for="editStudentGender">Gender:</label>
                            <select id="editStudentGender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <!-- Address -->
                        <div class="form-group">
                            <label for="editStudentAddress">Address:</label>
                            <textarea id="editStudentAddress" rows="3" required></textarea>
                        </div>
                        <!-- Sports -->
                        <div class="form-group">
                            <label for="editStudentSports">Sports:</label>
                            <input type="text" id="editStudentSports">
                        </div>
                        <!-- Achievements -->
                        <div class="form-group">
                            <label for="editStudentAchievements">Achievements:</label>
                            <textarea id="editStudentAchievements" rows="3"></textarea>
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-cancel">Cancel</button>
                            <button type="submit" class="btn btn-save">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    
	<script src="<?=ROOT?>/assets/js/ped_incharge/students.js"></script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>

