




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unpacked Inventory</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/inventoryunpacked.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/ped.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>


<div class="main-content">
        <main>
            <section class="inventory-section">
             <div class="header">
                <h1>Unpacked Inventory</h1>
                <div class="inventory-controls">
                    <div class="search-bar">
                        <input type="text" id="searchInput" placeholder="Search inventory...">
                        <i class="uil uil-search"></i>
                    </div>
                    <button class="add-product-btn" id="openAddModal">
                        <i class="uil uil-plus"></i> Request Inventory
                    </button>
                </div>
            </div>
                
            <div class="table-container">
    <!-- Unpacked Items Table -->
    <div class="inventory-table"> 
        <h2>Unpacked Items</h2>
        <table id="inventoryTable">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($unpackedItems)): ?>
                    <?php foreach ($unpackedItems as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item->name) ?></td>
                            <td><?= htmlspecialchars($item->issued_quantity) ?></td>
                            <td><button class="update-btn" 
                                data-id="<?= $item->stocktid ?>" 
                                data-name="<?= htmlspecialchars($item->name) ?>"
                                data-quantity="<?= $item->issued_quantity ?>">Edit</button></td>    
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No unpacked items found for your sport.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Previous Requests Table -->
    <div class="inventory-table">
        <h2>Previous Requests</h2>
        <table id="RequestTable">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Time Frame</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($requests)): ?>
                    <?php foreach ($requests as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item->name) ?></td>
                            <td><?= htmlspecialchars($item->quantityrequested) ?></td>
                            <td><?= htmlspecialchars($item->timeframe) ?></td> 
                            <td><?= htmlspecialchars($item->date) ?></td>
                            <td><button class="update-btn" data-id="<?= $item->requestid ?>"> Edit</button>
                            <form action="<?=ROOT?>/sportscaptain/inventoryunpacked/deleteRequest" method="POST">
                                <input type="hidden" name="requestid" value="<?= $item->requestid ?>">
                                <button class="delete-btn">Delete</button>
                            </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No unpacked items found for your sport.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

            </section>
        </main>

        <!-- Add Product Modal -->
        <!--div id="addModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Request Inventory</h2>
                <form id="addProductForm" action="<?= ROOT ?>/sportscaptain/inventoryunpacked/addrequest" method="POST">
                <div class="form-group">
                <label for="timeFrame">Time Frame:</label>
                <select id="timeFrame" name="timeframe" required>
                    <option value="mid-year">Mid-Year</option>
                    <option value="year-end">Year-End</option>
                </select>
            </div>
                    <div class="form-group">
                        <label for="productName">Product Name:</label>
                        <input type="text" id="productName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="productQuantity">Quantity:</label>
                        <input type="number" id="productQuantity" name="quantityrequested" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="additionalNotes">Additional Details</label>
                        <textarea id="additionalNotes" name="addnotes" rows="4" placeholder="Enter any additional notes"></textarea>
                    </div>
                    <button type="submit" class="submit-btn">Submit</button>
                </form>
                
            </div>
        </div-->

        <div id="addModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Request Year End Inventory</h2>
        <form id="addProductForm" action="<?= ROOT ?>/sportscaptain/inventoryunpacked/addrequest" method="POST">
            <div class="form-group">
                <label for="timeFrame">Time Frame:</label>
                <select id="timeFrame" name="timeframe" required>
                    <option value="mid-year">Mid-Year</option>
                    <option value="year-end">Year-End</option>
                </select>

            </div>
            
            <div id="equipment-container">
    <!-- Initial equipment item -->
    <div class="equipment-item">
        <div class="form-row">
            <div class="form-group">
                <label for="productName_0">Product Name:</label>
                <input type="text" id="productName_0" name="name[]" required>
            </div>
            <div class="form-group">
                <label for="productQuantity_0">Quantity:</label>
                <input type="number" id="productQuantity_0" name="quantityrequested[]" min="1" required>
            </div>
            <button type="button" class="remove-equipment-btn" style="display:none;">Remove</button>
        </div>
    </div>
</div>
            
            <button type="button" id="add-equipment-btn" class="btn">Add Another Equipment</button>
            
            <div class="form-group">
                <label for="additionalNotes">Additional Details</label>
                <textarea id="additionalNotes" name="addnotes" rows="4" placeholder="Enter any additional notes"></textarea>
            </div>
            
            <button type="submit" class="submit-btn">Submit Request</button>
        </form>
    </div>
</div>

        <!-- Update Quantity Modal -->
<div id="updateModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Update Quantity</h2>
        <form id="updateQuantityForm" action="<?= ROOT ?>/sportscaptain/inventoryunpacked/editquantity" method="POST">
           
  
            <input type="hidden" id="updateid" name="editid">
            <input type="hidden" name="date" value="<?= date('Y-m-d') ?>">
            <div class="form-group">
                <label for="updateProductName">Product Name:</label>
                <input type="text" id="updateProductName" name="name" readonly required>
            </div>
            <div class="form-group">
                <label for="updateProductQuantity">New Quantity:</label>
                <input type="number" id="updateProductQuantity" name="quantity" min="1"  required>
            </div>
            <div class="form-group">
                <label for="updateReason">Reason for Update:</label>
                <textarea id="updateReason" name="reason" rows="4" placeholder="Enter reason for the update" required></textarea>
            </div>
            <button type="submit" name="submit_update" class="submit-btn">Update</button>
        </form>
    </div>
</div>
     
    <div id="updaterequestModel" class="modal">
        <div class = "modal-content">
        <span class="close">&times;</span>
        <h2>Update Request</h2>
        <form id ="updateRequestForm" action="<?= ROOT ?>/sportscaptain/inventoryunpacked/editrequest" method="POST">
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
                <input type="date" id="updaterequestDate" name="date" required>
            </div>

            <button type="submit" class="submit-btn">Update</button>
        </form>

    </div>
</div>


    <script src="<?=ROOT?>/assets/js/vidusha/inventoryunpacked.js"></script>
</body>
</html>
