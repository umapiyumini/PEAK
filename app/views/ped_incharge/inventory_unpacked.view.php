<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unpacked inventory</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/ped_inventory.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
<?php $current_page = 'inventory'; include 'sidebar.view.php'?>
    <div class="main-content">
        <header>
            <div class="header-container">
                <div class="breadcrumb">
                    <span>
                        <a href="#">Home</a> 
                        <span class="breadcrumb-arrow">▶</span> 
                        <a href="#">Dashboard</a> 
                        <span class="breadcrumb-arrow">▶</span>
                        <a href="#" class="active">Inventory</a>
                    </span>
                </div>
                <button class="bell-icon"><i class="uil uil-bell"></i></button>
                <div class="profile-icon">
                    <img src="<?=ROOT?>/assets/images/ped_incharge/pro_icon.png" alt="Profile Icon">
                </div>
            </div>
            <div class="dropdown-menu" id="dropdownMenu">
                <ul>
                    <li><a href="#"><i class="uil uil-user"></i> My Profile</a></li>
                    <li><a href="#"><a href="<?=ROOT?>/logout"><i class="uil uil-signout"></i></a> Log out</a></li>
                </ul>
            </div>
        </header>
        
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
                        <i class="uil uil-plus"></i> Add New Product
                    </button>
                </div>
                <div>

                <div class="inventory-table">
                    <h2>Non-refundable Items</h2>
                    <table id="inventoryTable">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Type</th>
                                <th>Quantity</th>
                                <th>Sport</th>
                                <th>Availability</th>
                                <th>Incharge</th>
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
                <h2>Add New Product</h2>
                <form id="addProductForm">
                    <div class="form-group">
                        <label for="productName">Product Name:</label>
                        <input type="text" id="productName" required>
                    </div>
                    <div class="form-group">
                        <label for="productType">Type:</label>
                        <select id="productType" required>
                            <option value="Team">Team</option>
                            <option value="Recreational">Recreational</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="productQuantity">Quantity:</label>
                        <input type="number" id="productQuantity" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="productSport">Sport:</label>
                        <input type="text" id="productSport" required>
                    </div>
                    <div class="form-group">
                        <label for="productAvailability">Availability:</label>
                        <select id="productAvailability" required>
                            <option value="Available">Available</option>
                            <option value="Not Available">Not Available</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="productIncharge">Incharge:</label>
                        <input type="text" id="productIncharge" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel">Cancel</button>
                        <button type="submit" class="btn btn-save">Add Product</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Modal -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Edit Product</h2>
                <form id="editForm">
                    <input type="hidden" id="editProductId">
                    <div class="form-group">
                        <label for="editProductName">Product Name:</label>
                        <input type="text" id="editProductName" disabled>
                    </div>
                    <div class="form-group">
                        <label for="editType">Type:</label>
                        <select id="editType" required>
                            <option value="Team">Team</option>
                            <option value="Recreational">Recreational</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editQuantity">Quantity:</label>
                        <input type="number" id="editQuantity" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="editSport">Sport:</label>
                        <input type="text" id="editSport" disabled>
                    </div>
                    <div class="form-group">
                        <label for="editAvailability">Availability:</label>
                        <select id="editAvailability" required>
                            <option value="Available">Available</option>
                            <option value="Not Available">Not Available</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editIncharge">Incharge:</label>
                        <input type="text" id="editIncharge" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel">Cancel</button>
                        <button type="submit" class="btn btn-save">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
	<script src="<?=ROOT?>/assets/js/ped_incharge/inventory_packed.js"></script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>

