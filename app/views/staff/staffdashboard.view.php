<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-1.0">
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/indoor.css">
        <title>External User Dashboard</title>
    </head>


    <body>
        <!-- navigation bar -->
        

       

        <div class="topbar">
    <div class="logo"><img src="<?=ROOT?>/assets/images/logo.png" alt="Logo"></div>
    <button id="logout" class="logout">Logout</button>
    <div class="user">
        <a href="#" id="userImage">
            <img src="<?=ROOT?>/assets/images/user1.jpg" alt="User Image">
        </a>
        <div id="dropdownMenu" class="dropdown hidden">
            <a href="profile">Profile</a>
            <a href="logout">Logout</a>
        </div>
    </div>
</div>



                

            <!-- ----------------- main content ------------------ -->

            <div class="container">
        <!-- Reservations Section -->
        <div class="reservations">
            <h2>View Reservations</h2>
            <label for="facility">Select Facility:</label>
            <select id="facility">
                <option value="" disabled selected>Select...</option>
                <option value="ground">Ground</option>
                <option value="basketball">Basketball Court</option>
                <option value="tennis">Tennis Court</option>
                <option value="indoor">Indoor Stadium</option>
            </select>
            <div id="dateNavigation">
    <button id="prevDate"><</button>
    <span id="currentDate"></span>
    <button id="nextDate">></button>
</div>
<div id="timeSlots" class="time-slots"></div>

            <div id="timeSlots" class="time-slots">
                <!-- Time slots will populate dynamically -->
            </div>
        </div>

        <!-- To-Do List Section -->
        <div class="todo-list">
            <h2>To-Do List</h2>
            <div id="toDoListContainer">
  
    <div id="taskFilter">
        <label for="taskFilterSelect">Filter Tasks:</label>
        <select id="taskFilterSelect">
            <option value="all">All Tasks</option>
            <option value="completed">Completed</option>
            <option value="notCompleted">Not Completed</option>
        </select>
    </div>

    <div class="table-wrapper">
        <table id="taskTable">
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Due Date</th>
                    <th>Complete</th>
                    
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <!-- Task rows will go here -->
            </tbody>
        </table>
    </div>
</div>
        </div>

        <!-- Inventory Management Section -->
        <div class="inventory-management">
            <h2>Inventory Management</h2>
            <!-- Horizontal Containers for Inventory and Requests -->
     <!-- Horizontal Containers for Inventory and Requests -->
     <div class="containers">
        <!-- Inventory Table Container with Border -->
        <div class="inventory-container">
            <h3>Inventory</h3>
            
            <!-- Search Bar inside Inventory Section -->
            <div class="search-container">
                <label for="searchEquipment">Search Equipment:</label>
                <input type="text" id="searchEquipment" placeholder="Search by name...">
            </div>

        <!-- Add these message alerts near the top of the view -->
<?php if (isset($message)): ?>
    <div class="alert alert-success">
        <?php echo htmlspecialchars($message); ?>
    </div>
<?php endif; ?>

<?php if (isset($error)): ?>
    <div class="alert alert-danger">
        <?php echo htmlspecialchars($error); ?>
    </div>
<?php endif; ?>

<!-- Rest of your existing view remains the same -->
<!-- Inventory Table -->
<div class="inventory-table">
    <table id="inventoryTable">
        <thead>
            <tr>
                
            
                <th>Equipment</th>
                <th>Available Quantity</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($unpacked)): ?>
                <?php foreach ($unpacked as $item): ?>
                    <tr>
                    
                        <td><?php echo $item->name; ?></td>
                        <td><?php echo $item->quantity; ?></td>
                        <td>
                            <button class="edit-btn"
                                    data-id="<?php echo $item->equipmentid; ?>"
                                    data-name="<?php echo $item->name; ?>"
                                    data-quantity="<?php echo $item->quantity; ?>"
                                    onclick="openEditModal(this)">Edit</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No data available</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Edit Equipment Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <h3>Edit Equipment</h3>
        
        <!-- Form to edit equipment details -->
        <form method="POST" action="<?php echo ROOT; ?>/staffdashboard/editEquipment" id="editEquipmentForm">

            <!-- Hidden input for equipmentId -->
            <input type="hidden" id="equipmentId" name="equipmentid">

            <label for="equipmentName">Equipment Name:</label>
            <input type="text" id="equipmentName" name="name" disabled>

            <label for="quantity">Quantity:</label>
            <div class="quantity-container">
                <button type="button" id="subtractQty">-</button>
                <input type="number" id="quantity" name="editquantity" value="0">
                <button type="button" id="addQty">+</button>
            </div>

            <!-- Reason Dropdown -->
            <label for="reason">Reason for Update:</label>
            <select id="reason" name="reason">
                <option value="">Select a reason...</option>
                <option value="broken">Broken</option>
                <option value="lost">Lost</option>
                <option value="maintenance">Maintenance</option>
                <option value="damaged">Damaged</option>
                <option value="other">Other</option>
            </select>

            <div class="button-container">
                <button type="submit" id="submitEdit">Submit</button>
                <button type="button" id="closeModal">Close</button>
            </div>
        </form>
    </div>
</div>

            </div>


        <!-- Requests Table Container with Border -->
        <div class="requests-container">
            <h3>Stock Requests</h3>
            
         <!-- Requests Table -->
        <table id="requestsTable">
            <button class="add" id="addNewRequestBtn">Add New Request</button>
            <thead>
                <tr>
                    <th>Equipment</th>
                    <th>Quantity Requested</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($request)): ?>
                    <?php foreach ($request as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item->name); ?></td>
                            <td><?php echo htmlspecialchars($item->quantityrequested); ?></td>
                            <td><?php echo htmlspecialchars($item->date); ?></td>
                            <td>
                                <input type="hidden" class="request-id" value="<?php echo htmlspecialchars($item->requestid); ?>">
                                <button class="delete-btn">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No requests available</td>
                    </tr>
                <?php endif; ?>
            </tbody>


        </table> 







        <div id="newRequestModal" class="modal">
    <div class="modal-content">
        <h3>New Stock Request</h3>

        <form method="POST">
            <label for="equipmentSelect">Equipment:</label>
            <select id="equipmentSelect" name="name">
                <?php if (!empty($dropdown)): ?>
                    <?php foreach ($dropdown as $item): ?>
                        <option value="<?php echo htmlspecialchars($item->name); ?>">
                            <?php echo htmlspecialchars($item->name); ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">No equipment available</option>
                <?php endif; ?>
            </select>

            <label for="requestQuantity">Quantity:</label>
            <div class="quantity-container">
                <button type="button" id="subtractRequestQty">-</button>
                <input type="number" id="requestQuantity" value="0" min="1" name="quantityrequested">
                <button type="button" id="addRequestQty">+</button>
            </div>

            <!-- Button container -->
            <div class="button-container">
                <button type="submit" id="submitNewRequest">Confirm</button>
                <button type="button" id="closeRequestModal">Close</button>
            </div>
        </form>
    </div>
</div>

    </div>
</div>



        </div>
    </div>
    </div>
    </div>
 
    



    <script src="<?=ROOT?>/assets/js/uma/staff.js"></script>
    <script>
   document.addEventListener('DOMContentLoaded', function () {
    const userImage = document.getElementById('userImage');
    const dropdownMenu = document.getElementById('dropdownMenu');

    // Listen for the profile image click
    userImage.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default action (e.g., navigating away)
        console.log("User image clicked!"); // Debugging log

  
    });

    document.querySelector('.user').addEventListener('click', function () {
    const dropdown = document.querySelector('.dropdown');
    dropdown.classList.toggle('show');  // Toggle the 'show' class
});
    // Check if the dropdown is being triggered correctly
    document.addEventListener('click', function (event) {
        if (!userImage.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.remove('show'); // Remove 'show' class to hide dropdown
            console.log("Dropdown hidden (click outside)"); // Debugging log
        }
    });
});


// ====================== DELETE JS ===========================
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Get the requestid from the hidden input field
        const requestid = this.closest('tr').querySelector('.request-id').value;
        
        // Confirm the delete action
        const confirmDelete = confirm('Are you sure you want to delete this request?');
        
        if (confirmDelete) {
            // Send a POST request to delete the item
            const formData = new FormData();
            formData.append('delete_requestid', requestid);  // Add the requestid to the form data

            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Alert the user about the deletion outcome (optional)
                if (data === 'success') {
                    alert('Successfully deleted.');
                } else {
                    alert('Successfully deleted.');
                }

                // Reload the page after the operation, regardless of success or failure
                location.reload();  // Reload the page to reflect the changes
            })
            .catch(error => {
                console.error('Error deleting request:', error);
                alert('Error occurred while deleting.');
                
                // Reload the page in case of error as well
                location.reload();
            });
        }
    });
});

// ============================== UPDATE JS ============================

</script>

    
    
</body>
</html>


            <!-- test git comment -->