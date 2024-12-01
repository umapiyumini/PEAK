<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/inventory_stocks.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <?php $current_page = 'inventory'; include 'sidebar.view.php'?>
    <div class="main-content">
       
            <!-- <div class="notifications-dropdown">
            <div class="notifications-header">
                <h3>Notifications</h3>
                <span class="clear-all">Clear All</span>
            </div>
            <div class="notifications-list">
                <ul id="notificationsList"></ul>
            </div>
        </div>
             -->
        
             <div class="header">
             <h1>Packed Stocks</h1>
             </div>
        <main>
  
        <div class="inventory-section">
                <div class="actions-bar">
        <div class="search-bar">
        <i class="uil uil-search"></i>
        <input type="text" id="searchInput" placeholder="Search packed stocks...">
        </div>
         <button id="openAddModal" class="btn-add">
        <i class="uil uil-plus"></i> Add New Stock
         </button>
        </div>

<div class="table-container">
    <table id="packedStocksTable">
        <thead>
            <tr>
                <th>Equipment ID</th>
                <th>Name</th>
                <th>Sport</th>
                <th>Indent No.</th>
                <th>Description</th>
                <th>Unit</th>
                <th>Quantity</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="packedStocksBody">
            <!-- Table content will be dynamically populated -->
        </tbody>
    </table>
</div>
    
        </div>
             

</main>
             
<!-- Add Modal -->
<div id="addStockModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Add New Stock</h2>
            <span class="close">&times;</span>
        </div>
        <form id="addStockForm">
            <div class="form-group">
                <label for="equipmentId">Equipment ID</label>
                <input type="text" id="equipmentId" required>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" required>
            </div>
            <div class="form-group">
                <label for="sport">Sport</label>
                <input type="text" id="sport" required>
            </div>
            <div class="form-group">
                <label for="indentNo">Indent Number</label>
                <input type="text" id="indentNo" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description"></textarea>
            </div>
            <div class="form-group">
                <label for="unit">Unit</label>
                <input type="text" id="unit" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" min="1" required>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" id="date" required>
            </div>
            <div class="modal-footer">
                <button type="button" class=" btn btn-cancel">Cancel</button>
                <button type="submit" class="btn btn-save">Save</button>
            </div>
        </form>
    </div>
</div>
           

        

    
	<script src="<?=ROOT?>/assets/js/ped_incharge/inventory_stocks.js"></script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>

