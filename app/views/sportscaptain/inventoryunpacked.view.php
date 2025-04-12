




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
                    <th>Availability</th>
                    <th>Incharge</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($unpackedItems)): ?>
                    <?php foreach ($unpackedItems as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item->name) ?></td>
                            <td><?= htmlspecialchars($item->quantity) ?></td>
                            <td><?= htmlspecialchars($item->availability) ?></td> 
                            <td><?= htmlspecialchars($item->incharge) ?></td>
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
            <?php if (!empty($inventoryrequests)): ?>
                    <?php foreach ($inventoryrequests as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item->name) ?></td>
                            <td><?= htmlspecialchars($item->quantityrequested) ?></td>
                            <td><?= htmlspecialchars($item->timeframe) ?></td> 
                            <td><?= htmlspecialchars($item->date) ?></td>
                            <td><button class="update-btn" data-id="<?= $item->equipmentid ?>">Edit</button></td>
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
        <div id="addModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Request Inventory</h2>
                <form id="addProductForm" action="<?= ROOT ?>/sportscaptain/inventoryunpacked/addrequest" method="POST">
                <div class="form-group">
                <input type = "hidden" id="sportid" name="sport_id">
                <input type = "hidden" id="date" name="date">
                <input type = "hidden" id="userid" name="requested_by">
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
                        <input type="number" id="productQuantity" name="quantity" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="additionalNotes">Additional Details</label>
                        <textarea id="additionalNotes" name="addnotes" rows="4" placeholder="Enter any additional notes"></textarea>
                    </div>
                    <button type="submit" class="submit-btn">Submit</button>
                </form>
                
            </div>
        </div>

        <!-- Update Quantity Modal -->
<div id="updateModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Update Quantity</h2>
        <form id="updateQuantityForm" action="inventoryunpacked/editQuantity" method="POST">
            <div class="form-group">

            <input type="hidden" id="updateid" name="equipmentid">

                <label for="updateProductName">Product Name:</label>
                <input type="text" id="updateProductName" name="name" readonly required>
            </div>
            <div class="form-group">
                <label for="updateProductQuantity">New Quantity:</label>
                <input type="number" id="updateProductQuantity" name="quantity" min="1" required>
            </div>
            <div class="form-group">
                <label for="updateReason">Reason for Update:</label>
                <textarea id="updateReason" name="reason" rows="4" placeholder="Enter reason for the update" required></textarea>
            </div>
            <button type="submit" name="submit_update" class="submit-btn">Update</button>
        </form>
    </div>
</div>
       
        
    </div>

    <script src="<?=ROOT?>/assets/js/vidusha/inventoryunpacked.js"></script>
</body>
</html>
