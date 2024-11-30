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
                <div>
                <div class="table-container">
                <div class="inventory-table">
                    <h2>Unpacked Items</h2>
                    <table id="inventoryTable">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Availability</th>
                                <th>Incharge</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="inventory-table">
                    <h2>Previous Requests</h2>
                    <table id="RequestTable">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            
            </section>
        </main>

        <!-- Add Product Modal -->
        <div id="addModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Request Inventory</h2>
                <form id="addProductForm">
                <div class="form-group">
                <label for="timeFrame">Time Frame:</label>
                <select id="timeFrame" required>
                    <option value="mid-year">Mid-Year</option>
                    <option value="year-end">Year-End</option>
                </select>
            </div>
                    <div class="form-group">
                        <label for="productName">Product Name:</label>
                        <input type="text" id="productName" required>
                    </div>
                    <div class="form-group">
                        <label for="productQuantity">Quantity:</label>
                        <input type="number" id="productQuantity" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="additionalNotes">Additional Details</label>
                        <textarea id="additionalNotes" rows="4" placeholder="Enter any additional notes"></textarea>
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
        <form id="updateQuantityForm">
            <div class="form-group">
                <label for="updateProductName">Product Name:</label>
                <input type="text" id="updateProductName" readonly>
            </div>
            <div class="form-group">
                <label for="updateProductQuantity">New Quantity:</label>
                <input type="number" id="updateProductQuantity" min="1" required>
            </div>
            <div class="form-group">
                <label for="updateReason">Reason for Update:</label>
                <textarea id="updateReason" rows="4" placeholder="Enter reason for the update" required></textarea>
            </div>
            <button type="submit" class="submit-btn">Update</button>
        </form>
    </div>
</div>
       
        
    </div>

    <script src="<?=ROOT?>/assets/js/vidusha/inventoryunpacked.js"></script>
</body>
</html>
