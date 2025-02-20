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
       
       
        
        <div class="header">
            <button onclick="history.back()" class="goBackButton"><i class="uil uil-arrow-left"></i></button>
            <h1>Packed Stocks</h1>
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
            
            <button class="bell-icon"><a href="<?=ROOT?>/logout"><i class="uil uil-signout"></i></a></button>
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
                                <th>Issued Quantity</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="packedStocksBody">
                            <?php if(!empty($stockdatafiltered)): ?>
                                <?php foreach ($stockdatafiltered as $i): ?>
                                    <tr>
                                        <td><?=$i->equipmentid?></td>
                                        <td><?=$i->eqpname?></td>
                                        <td><?=$i->sport_name?></td>
                                        <td><?=$i->indent_no?></td>
                                        <td><?=$i->description?></td>
                                        <td><?=$i->unit?></td>
                                        <td><?=$i->quantity?></td>
                                        <td><?=$i->issued_quantity?></td>
                                        <td><?=$i->date?></td>

                                        <td>
                                            <button class="btn btn-update" id="openEditModal" onclick="openEditModal(<?= htmlspecialchars(json_encode($i), ENT_QUOTES, 'UTF-8') ?>)">
                                                <i class="uil uil-edit"></i>
                                            </button>
                                            <!-- <button class="btn btn-delete" onclick="deleteEquipment(<?= htmlspecialchars(json_encode($i), ENT_QUOTES, 'UTF-8') ?>)">
                                                <i class="uil uil-trash-alt"></i>
                                            </button> -->
                                            <!-- issue quantity button -->
                                             <button class="btn btn-issue" onclick="openIssueModal(<?= htmlspecialchars(json_encode($i), ENT_QUOTES, 'UTF-8')?>)">
                                                <i class="uil uil-minus-circle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
             
        <div class="modal" id="issueModal">
            <div class="modal-content" style="height:auto;">
                <div class="modal-header">
                    <h2>Issue Stock</h2>
                    <span class="close" onclick="closeIssueModal()">&times;</span>
                </div>
                <form id="issueStockForm" action="<?=ROOT?>/ped_incharge/inventory_stocks/issueStock" method="POST">
                    <div class="form-group">
                        <label for="issueQuantity">Issue Quantity</label>
                        <input type="number" id="issueQuantity" min="1" name="issueQuantity" required>
                    </div>
                    <input type="hidden" id="stockId" name="stockId">
                    <div class="form-group">
                        <button type="submit" class="btn-submit">Issue Stock</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- Add Modal -->
        <div id="addStockModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Add New Stock</h2>
                    <span class="close">&times;</span>
                </div>
                <form id="addStockForm" action="<?=ROOT?>/ped_incharge/inventory_stocks/addStockRecord" method="POST">
                    <div class="form-group">
                        <label for="equipmentid">Equipment ID</label>
                        <input type="text" id="equipmentid" name="equipmentid" value="<?= isset($i->equipmentid) ? htmlspecialchars($i->equipmentid, ENT_QUOTES, 'UTF-8') : '' ?>" required>
                    </div>
                    <!-- <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="sport">Sport</label>
                        <input type="text" id="sport" name="sport" required>
                    </div> -->
                    <div class="form-group">
                        <label for="indentNo">Indent Number</label>
                        <input type="text" id="indentNo" name="indentNo" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <input type="text" id="unit" name="unit" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" min="1" name="quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class=" btn btn-cancel">Cancel</button>
                        <button type="submit" class="btn btn-save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
	<script src="<?=ROOT?>/assets/js/ped_incharge/inventory_stocks.js"></script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>

