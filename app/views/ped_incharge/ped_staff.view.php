<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ground/Indoor Staff</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/groundindoorstaff.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
<?php $current_page = 'staff'; include 'sidebar.view.php'?>
    <div class="main-content">
      
        <div class="header">
            <h1>PED Staff Data</h1>
        </div>
        <main>

             
<div class="ground-staff-table table">
<div class="controls">
                    <div class="search-bar">
                        <input type="text" id="searchInput" placeholder="Search staff...">
                        <i class="uil uil-search"></i>
                    </div>
                    <button class="add-btn" id="openAddModal">
                        <i class="uil uil-plus"></i> Add new member
                    </button>
                    
</div>
                    <table id="groundStaffTable">
                        <thead>
                            <tr>
                                <th>Staff ID</th>
                                <th>FullName</th>
                                <th>Emp No</th>
                                <th>Reg. No</th>
                                <th>Designation</th>
                                <th>Date of Appointment</th>
                                <th>NIC</th>
                                <th>DOB</th>
                                <th>Contact number</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
</div>

</main>
           
<!-- Add Staff Modal -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Add New Staff Member</h2>
        <form id="addStaffForm">
            <div class="form-group">
                <label for="fullName">Full Name:</label>
                <input type="text" id="fullName" required>
            </div>
            <div class="form-group">
                <label for="empNo">Employee No:</label>
                <input type="text" id="empNo" required>
            </div>
            <div class="form-group">
                <label for="regNo">Registration No:</label>
                <input type="text" id="regNo" required>
            </div>
            <div class="form-group">
                <label for="designation">Designation:</label>
                <input type="text" id="designation" required>
            </div>
            <div class="form-group">
                <label for="dateOfAppointment">Date of Appointment:</label>
                <input type="date" id="dateOfAppointment" required>
            </div>
            <div class="form-group">
                <label for="nic">NIC:</label>
                <input type="text" id="nic" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" required>
            </div>
            <div class="form-group">
                <label for="contactNumber">Contact Number:</label>
                <input type="tel" id="contactNumber" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" required></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel">Cancel</button>
                <button type="submit" class="btn btn-save">Add Staff</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Staff Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit Staff Member</h2>
        <form id="editStaffForm">
            <input type="hidden" id="editStaffId">
            <div class="form-group">
                <label for="editFullName">Full Name:</label>
                <input type="text" id="editFullName" required>
            </div>
            <div class="form-group">
                <label for="editEmpNo">Employee No:</label>
                <input type="text" id="editEmpNo" required>
            </div>
            <div class="form-group">
                <label for="editRegNo">Registration No:</label>
                <input type="text" id="editRegNo" required>
            </div>
            <div class="form-group">
                <label for="editDesignation">Designation:</label>
                <input type="text" id="editDesignation" required>
            </div>
            <div class="form-group">
                <label for="editDateOfAppointment">Date of Appointment:</label>
                <input type="date" id="editDateOfAppointment" required>
            </div>
            <div class="form-group">
                <label for="editNic">NIC:</label>
                <input type="text" id="editNic" required>
            </div>
            <div class="form-group">
                <label for="editDob">Date of Birth:</label>
                <input type="date" id="editDob" required>
            </div>
            <div class="form-group">
                <label for="editContactNumber">Contact Number:</label>
                <input type="tel" id="editContactNumber" required>
            </div>
            <div class="form-group">
                <label for="editAddress">Address:</label>
                <textarea id="editAddress" required></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel">Cancel</button>
                <button type="submit" class="btn btn-save">Save Changes</button>
            </div>
        </form>
    </div>
</div>
    
	<script src="<?=ROOT?>/assets/js/ped_incharge/staff.js"></script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>

