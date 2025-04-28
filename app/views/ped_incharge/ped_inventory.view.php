<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/ped_inventory.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <?php $current_page = 'inventory'; include 'sidebar.view.php'?>
    <div class="main-content">
        <div class="header">
            <h1>Packed Inventory Management</h1>
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
            <section class="inventory-section">
                <div class="inventory-type">
                    <div class="grid-item team" id="team">
                        <a>
                            <h3>Team</h3>
                        </a>
                    </div>
                    <div class="grid-item recreational" id="rec">
                        <a>
                            <h3>Recreational</h3>
                        </a>
                    </div>
                    <div class="grid-item all-requests">
                        <a href="inventory_requests">
                            <h3>Requests</h3>
                        </a>
                    </div>
                </div>

                <div class="inventory-table-team in_table" id="in_team">
                    <div class="inventory-controls">
                        <div class="filter-bar">
                            <div class="search-bar">
                                <input type="text" id="searchInput" placeholder="Search inventory...">
                                <i class="uil uil-search"></i>
                            </div>
                            <select id="status-filter">
                                    <option value="all">All Sports</option>
                                    <option value="pending">Athletics</option>
                                    <option value="approved">Basketball</option>
                                    <option value="rejected">Badminton</option>
                                    <option value="issued">Baseball</option>
                                    <option value="issued">Carrom</option>
                                    <option value="issued">Cricket</option>
                                    <option value="issued">Elle</option>
                                    <option value="issued">Hockey</option>
                                    <option value="issued">Football</option>
                                    <option value="issued">Rowing</option>
                            </select>
                        </div>
                        <div class="buttons">
                            <button class="add-product-btn" id="openAddModal">
                                <i class="uil uil-plus"></i> Add new product
                            </button>
                        </div>
                    </div>
                    <table id="inventoryTableTeam">
                        <h3>Team Equipment</h3>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Sport</th>
                                <th>Description</th>
                                <th>Issued</th>
                                <th>Available</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($eqpdata)): ?>
                                <?php foreach ($eqpdata as $i): ?>
                                    <tr>
                                        <td><?=$i->name?></td>
                                        <td><?=$i->sport_name?></td>
                                        <td><?=$i->description?></td>
                                        <td><?=$i->issued?></td>
                                        <td><?=$i->available?></td>
                                        <td>
                                            <button class="btn btn-view" id="openStockView" onclick="openStockView(<?= htmlspecialchars(json_encode($i), ENT_QUOTES, 'UTF-8') ?>)">
                                                <i class="uil uil-eye"></i>
                                            </button>
                                            <button class="btn btn-update" id="openEditModal" onclick="openEditModal(<?= htmlspecialchars(json_encode($i), ENT_QUOTES, 'UTF-8') ?>)">
                                                <i class="uil uil-edit"></i>
                                            </button>
                                            <button class="btn btn-delete" onclick="deleteEquipment(<?= htmlspecialchars(json_encode($i), ENT_QUOTES, 'UTF-8') ?>)">
                                                <i class="uil uil-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>

                <div class="inventory-table-recreational in_table" id="in_rec" style="display:none;">
                    <div class="inventory-controls">
                        <div class="filter-bar">
                            <div class="search-bar">
                                <input type="text" id="searchInput" placeholder="Search inventory...">
                                <i class="uil uil-search"></i>
                            </div>
                        </div>
                        <div class="buttons">
                        <button class="add-product-btn" id="openAddModal2">
                            <i class="uil uil-plus"></i> Add new product
                        </button>
                    </div>
                </div>
                <table id="inventoryTableRecreational">
                <h3>Recreational Equipment</h3>
                    <thead>
                        <tr>
                            <th>Equipment</th>
                            <th>Sport</th>
                            <th>Description</th>
                            <th>Issued</th>
                            <th>Available</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($eqpdatarecreational)): ?>
                                <?php foreach ($eqpdatarecreational as $i): ?>
                                    <tr>
                                        <td><?=$i->name?></td>
                                        <td><?=$i->sport_name?></td>
                                        <td><?=$i->description?></td>
                                        <td><?=$i->issued?></td>
                                        <td><?=$i->available?></td>
                                        <td>
                                            <button class="btn btn-view">
                                                <i class="uil uil-eye"></i>
                                            </button>
                                            <button class="btn btn-update" id="openEditModal" onclick="openEditModal(<?= htmlspecialchars(json_encode($i), ENT_QUOTES, 'UTF-8') ?>)">
                                                <i class="uil uil-edit"></i>
                                            </button>
                                            <button class="btn btn-delete" onclick="deleteEquipment(<?= htmlspecialchars(json_encode($i), ENT_QUOTES, 'UTF-8') ?>)">
                                                <i class="uil uil-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                <?php endif;?>
                    </tbody>
                </table>
            </div>
            </section>
           
        </main>

        <!-- Add Product Modal -->
        <div id="addModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeAdd">&times;</span>
                <h2>Add New Equipment</h2>
                <form action="ped_inventory/addEquipment" method="POST" id="addProductForm">
                    <div class="form-group">
                        <label for="name">Product Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="sport_id">Sport:</label>
                        <select id="sport_id" name="sport_id" required>
                            <option value="">Select Sport</option>
                            <?php foreach ($sportdata as $sport): ?>
                                <option value="<?=$sport->sport_id?>"><?=$sport->sport_name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Type:</label>
                        <select id="type" name="type" required>
                            <option value="Team">Team</option>
                            <option value="Recreational">Recreational</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Product description:</label>
                        <input type="text" id="description" name="description">
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel">Cancel</button>
                        <button type="submit" class="btn btn-save">Add Product</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- edit Product Modal -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Edit Equipment Details</h2>
                <form action="ped_inventory/editEquipment" method="POST" id="editProductForm">
                    <input type="hidden" id="equipmentid" name="equipmentid">
                    <div class="form-group">
                        <label for="editname">Product Name:</label>
                        <input type="text" id="editname" name="editname">
                    </div>
                    <div class="form-group">
                        <label for="editsport_id">Sport:</label>
                        <select id="editsport_id" name="editsport_id">
                            <option value="">Select Sport</option>
                            <?php foreach ($sportdata as $sport): ?>
                                <option value="<?=$sport->sport_id?>"><?=$sport->sport_name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edittype">Type:</label>
                        <select id="edittype" name="edittype">
                            <option value="Team">Team</option>
                            <option value="Recreational">Recreational</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editdescription">Product description:</label>
                        <input type="text" id="editdescription" name="editdescription">
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel">Cancel</button>
                        <button type="submit" class="btn btn-save">Update</button>
                    </div>
                </form>
            </div>
        </div>

    
	<script src="<?=ROOT?>/assets/js/ped_incharge/ped_inventory.js"></script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("team").addEventListener("click", function() {
        let team = document.getElementById("in_team");
        let rec = document.getElementById("in_rec");
        team.style.display = "block";
        rec.style.display = "none";
    });

    document.getElementById("rec").addEventListener("click", function() {
        let team = document.getElementById("in_team");
        let rec = document.getElementById("in_rec");
        team.style.display = "none";
        rec.style.display = "block";
    });

    document.getElementById("openAddModal").addEventListener("click", function() {
        let addnewmodal = document.getElementById("addModal");
        addnewmodal.style.display = "block";
    });
    document.getElementById("openAddModal2").addEventListener("click", function() {
        let addnewmodal = document.getElementById("addModal");
        addnewmodal.style.display = "block";
    });

    document.getElementById("closeAdd").addEventListener("click", function() {
        let addnewmodal = document.getElementById("addModal");
        addnewmodal.style.display = "none";
    });
});
</script>

