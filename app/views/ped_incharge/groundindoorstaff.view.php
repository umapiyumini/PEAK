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
        <h1>Ground/Indoor Staff Data</h1>
        <button class="bell-icon"><i class="uil uil-bell"></i></button>
        <div class="notifications-dropdown">
            <div class="notifications-header">
                <h3>Notifications</h3>
                <span class="clear-all">Clear All</span>
            </div>
            <div class="notifications-list">
                <ul id="notificationsList"></ul>
            </div>
        </div>
        <button class="bell-icon"><i class="uil uil-signout"></i></button>
    </div>
    <main>
        <div class="container">
            <form class="task-form" method="POST" action="<?=ROOT?>/ped_incharge/groundindoorstaff/addTask">
                <h2>Assign New Task</h2>

                <div class="form-group">
                    <label for="taskName">Task Name:</label>
                    <input type="text" id="taskName" name="taskname" required>
                </div>

                <div class="form-group">
                    <label for="deadline">Deadline:</label>
                    <input type="datetime-local" id="deadline" name="deadline" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="staffType">Assign To:</label>
                    <select id="staffType" name="type" required>
                        <option value="">-- Select Staff Type --</option>
                        <option value="ground">Ground Staff</option>
                        <option value="indoor">Indoor Staff</option>
                    </select>
                </div>

                <button class="add-btn" type="submit">Assign Task</button>
            </form>
            
            <div class="assigned-tasks">
                <div class="filter-section">
                    <h2>Assigned Tasks</h2>
                    <label for="filterStatus">Filter by Status:</label>
                    <select id="filterStatus" onchange="filterTasks()">
                        <option value="all">All Tasks</option>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>
                <div class="task-list" id="taskList">
                    <?php if(!empty($staffTodoList)):?>
                        <ul id="assignedTasksList">
                            <?php foreach($staffTodoList as $task): ?>
                            <li class="task-item" data-status="<?= $task->status ?>">
                                <div class="task-details">
                                    <h3>Task: <?= $task->taskname ?></h3>
                                    <p><strong>Description:</strong> <?= $task->description ?></p>
                                    <p><strong>Assigned Date & Time:</strong> <?= $task->time ?></p>
                                    <p><strong>Deadline:</strong> <?= $task->deadline ?></p>
                                    <p><strong>Assigned To:</strong> <?= $task->type ?></p>                                    
                                    <?php
                                        $status = strtolower($task->status);
                                        $statusClass = 'status-' . $status;
                                    ?>
                                    <p><strong>Status:</strong> <span class="<?= $statusClass ?>"><?= $task->status ?></span></p>    
                                 </div>    
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif;?>
                </div>
            </div>
        </div>

    </div>
             
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
                <tbody>
                    <?php if(!empty($groundIndoorStaffList)): ?>
                    <?php foreach($groundIndoorStaffList as $staff): ?>
                        <tr>
                            <td><?= $staff->staff_id ?></td>
                            <td><?= $staff->name ?></td>
                            <td><?= $staff->emp_no ?></td>
                            <td><?= $staff->reg_no ?></td>
                            <td><?= $staff->designation ?></td>
                            <td><?= $staff->appointment_date ?></td>
                            <td><?= $staff->nic ?></td>
                            <td><?= $staff->dob ?></td>
                            <td><?= $staff->phone ?></td>
                            <td><?= $staff->address ?></td>
                            <td class="actions">
                                <button 
                                    class="edit-btn" 
                                    onclick="openEditModal(this)"
                                    data-id="<?= $staff->staff_id ?>"
                                    data-name="<?= $staff->name ?>"
                                    data-emp_no="<?= $staff->emp_no ?>"
                                    data-reg_no="<?= $staff->reg_no ?>"
                                    data-designation="<?= $staff->designation ?>"
                                    data-appointment_date="<?= $staff->appointment_date ?>"
                                    data-nic="<?= $staff->nic ?>"
                                    data-dob="<?= $staff->dob ?>"
                                    data-phone="<?= $staff->phone ?>"
                                    data-address="<?= $staff->address ?>"
                                    data-type="<?= $staff->type ?>"
                                    >
                                    Edit
                                </button>
                                <button class="delete-btn" onclick="deleteStaff(this)" data-id="<?= $staff->staff_id ?>">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
            
    <!-- Add Staff Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add New Staff Member</h2>
            <form id="addStaffForm" method="POST" action="<?=ROOT?>/ped_incharge/groundindoorstaff/addStaffMember">
                <div class="form-group">
                    <label for="staffID">Staff ID:</label>
                    <input type="text" id="staffID" name="staff_id" required>
                </div>
                <div class="form-group">
                    <label for="fullName">Full Name:</label>
                    <input type="text" id="fullName" name="name" required>
                </div>
                <div class="form-group">
                    <label for="empNo">Employee No:</label>
                    <input type="text" id="empNo" name="emp_no" required>
                </div>
                <div class="form-group">
                    <label for="regNo">Registration No:</label>
                    <input type="text" id="regNo" name="reg_no" required>
                </div>
                <div class="form-group">
                    <label for="designation">Designation:</label>
                    <input type="text" id="designation" name="designation" required>
                </div>
                <div class="form-group">
                    <label for="dateOfAppointment">Date of Appointment:</label>
                    <input type="date" id="dateOfAppointment" name="appointment_date"required>
                </div>
                <div class="form-group">
                    <label for="nic">NIC:</label>
                    <input type="text" id="nic" name="nic"required>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" required>
                </div>
                <div class="form-group">
                    <label for="contactNumber">Contact Number:</label>
                    <input type="tel" id="contactNumber" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea id="address" name="address" required></textarea>
                </div>
                <div class="form-group">
                    <label for="staffType">Staff Type:</label>
                    <select id="staffType" name="type" required>
                        <option value="">-- Select Staff Type --</option>
                        <option value="ground">Ground Staff</option>
                        <option value="indoor">Indoor Staff</option>
                    </select>
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
            <form id="editStaffForm" method="POST" action="<?=ROOT?>/ped_incharge/groundindoorstaff/editStaffMember">
                <input type="hidden" id="editStaffId" name="staff_id">
                <div class="form-group">
                    <label for="editFullName">Full Name:</label>
                    <input type="text" id="editFullName" name="name" required>
                </div>
                <div class="form-group">
                    <label for="editEmpNo">Employee No:</label>
                    <input type="text" id="editEmpNo" name="emp_no" required>
                </div>
                <div class="form-group">
                    <label for="editRegNo">Registration No:</label>
                    <input type="text" id="editRegNo" name="reg_no" required>
                </div>
                <div class="form-group">
                    <label for="editDesignation">Designation:</label>
                    <input type="text" id="editDesignation" name="designation" required>
                </div>
                <div class="form-group">
                    <label for="editDateOfAppointment">Date of Appointment:</label>
                    <input type="date" id="editDateOfAppointment" name="appointment_date"required>
                </div>
                <div class="form-group">
                    <label for="editNic">NIC:</label>
                    <input type="text" id="editNic" name="nic" required>
                </div>
                <div class="form-group">
                    <label for="editDob">Date of Birth:</label>
                    <input type="date" id="editDob" name="dob" required>
                </div>
                <div class="form-group">
                    <label for="editContactNumber">Contact Number:</label>
                    <input type="tel" id="editContactNumber" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="editAddress">Address:</label>
                    <textarea id="editAddress" name="address" required></textarea>
                </div>
                <div class="form-group">
                    <label for="editStaffType">Staff Type:</label>
                    <select id="editStaffType" name="type" required>
                        <option value="">-- Select Staff Type --</option>
                        <option value="ground">Ground Staff</option>
                        <option value="indoor">Indoor Staff</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel">Cancel</button>
                    <button type="submit" class="btn btn-save">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
 
<script src="<?=ROOT?>/assets/js/ped_incharge/staff.js"></script>
<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>

