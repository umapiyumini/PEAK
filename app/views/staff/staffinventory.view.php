<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-1.0">
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/todo.css">
        <title>Staff Dashboard</title>
    </head>


    <body>
        
        <div class="container">
        <!-- Inventory Management Section -->
        
            <h2>Inventory Management</h2>
            <div class="containers">
                <div class="inventory-container">
                <h3>Inventory</h3>
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
            <?php if (!empty($stock)): ?>
                <?php foreach ($stock as $item): ?>
                    <tr>
                    
                        <td><?php echo $item->name; ?></td>
                        <td><?php echo $item->issued_quantity; ?></td>
                        <td>
                            <button class="edit-btn"
                            data-id="<?= $item->stockid ?>" 
                                data-name="<?= htmlspecialchars($item->name) ?>"
                                data-quantity="<?= $item->issued_quantity ?>"
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
        <form method="POST" action="<?=ROOT?>/staff/staffinventory/editEquipment" id="editEquipmentForm">
            
            <!-- Hidden input for equipmentId -->
            <input type="hidden" id="equipmentId" name="equipmentid">
            
            <input type="hidden" id="updatedate" name="date" value="<?= date('Y-m-d') ?>">

            <label for="equipmentName">Equipment Name:</label>
            <input type="text" id="equipmentName" name="name" disabled>

            <label for="quantity">Quantity:</label>
            <div class="quantity-container">
                <button type="button" id="subtractQty">-</button>
                <input type="number" id="quantity" name="quantity" value="0">
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
                <?php if (!empty($requests)): ?>
                    <?php foreach ($requests as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item->name); ?></td>
                            <td><?php echo htmlspecialchars($item->quantityrequested); ?></td>
                            <td><?php echo htmlspecialchars($item->date); ?></td>
                            <td>
                                <button class="update-btn" data-id="<?= $item->requestid ?>">Edit</button>
                                <form action="<?=ROOT?>/staff/staffinventory/deleterequest" method="POST">
                                <input type="hidden" name="requestid" value="<?= $item->requestid ?>">
                                <button class="deleteBtn">Delete</button>
                                </form>
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

        <form action="<?=ROOT?>/staff/staffinventory/addrequest" method="POST">
            <label for="equipmentSelect">Equipment:</label>
            <select id="equipmentSelect" name="name">
                <?php if (!empty($stock)): ?>
                    <?php foreach ($stock as $item): ?>
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

<!--update request modal-->
<div id="updaterequestModel" class="modal">
        <div class = "modal-content">
        <span class="close">&times;</span>
        <h2>Update Request</h2>
        <form id ="updateRequestForm" action="<?= ROOT ?>/staff/staffinventory/editrequest" method="POST">
            <input type="hidden" id="updateRequestId" name="requestid">

            <div class="form-group">
                <label for="productName">Product Name: </label>
                <input type="text" id="updaterequestProductName" name="name" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity: </label>
                <input type="number" id="updaterequestQuantity" name="quantityrequested" required>
            </div>

            <div class="form-group">
                <label for="timeframe">Time Frame: </label>
                <select id="updaterequesttimeframe" name="timeframe" required>
                    <option value="mid-year">Mid-year</option>
                    <option value="year-end">Year-end</option>
                </select>
            </div>

            <div class="form-group">
                <label for="date">Date: </label>
                <input type="date" id="updaterequestDate" name="date" value="required>
            </div>

            <button type="submit" class="submit-btn">Update</button>
        </form>

    </div>
</div>

    </div>
</div>



        </div>
    </div>
    </div>
    </div>
 
    <script src="<?=ROOT?>/assets/js/vidusha/staffinventory.js"></script>
  
</body>
</html>


           