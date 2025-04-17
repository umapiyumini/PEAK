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
            <h1>Unpacked Inventory Management</h1>
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
            <section class="inventory-section">
                <div class="inventory-type">
                    <div class="grid-item team">
                        <a href="#">
                            <h3>Team</h3>
                        </a>
                    </div>
                    <div class="grid-item recreational">
                        <a href="#">
                            <h3>Recreational</h3>
                        </a>
                    </div>
                    <div class="grid-item all-requests">
                        <a href="inventory_requests">
                            <h3>Requests</h3>
                        </a>
                    </div>
                </div>

                <div class="unpacked-team">
                <div class="inventory-table-team in_table">
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
                        <!-- <div class="buttons">
                            <button class="add-product-btn" id="openAddModal">
                                <i class="uil uil-plus"></i> Add new product
                            </button>
                        </div> -->
                    </div>
                    <table id="inventoryTableTeam">
                        <h3>Team Equipment</h3>
                        <thead>
                            <tr>
                                <th>Equipment</th>
                                <th>Sport</th>
                                <th>Issued</th>
                                <th>Damaged/Lost</th>
                                <th>Remaining</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($listteam)):?>
                                <?php foreach($listteam as $i):?>
                                    <tr>
                                        <td><?php echo $i->name;?></td>
                                        <td><?php echo $i->sport_name;?></td>
                                        <td><?php echo $i->issued_quantity;?></td>
                                        <td><?php echo $i->damaged_quantity;?></td>
                                        <td><?php echo $i->remaining_quantity;?></td>
                                    </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
                    <div class="edit-reason">
                        <table id="edit-reasonTableTeam table">
                            <h3>Updates</h3>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Equipment</th>
                                    <th>Sport</th>
                                    <th>Quantity</th>
                                    <th>Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($updatesteam)):?>
                                    <?php foreach($updatesteam as $i):?>
                                        <tr>
                                            <td><?php echo $i->date ?></td>
                                            <td><?php echo $i->name;?></td>
                                            <td><?php echo $i->sport_name;?></td>
                                            <td><?php echo $i->quantity;?></td>
                                            <td><?php echo $i->reason;?></td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>

                <div class="inventory-table-recreational in_table" style="display:none;">
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
                        <!-- <button class="requests-btn" id="openRequests">
                        Requests
                        </button>  -->
                        <!-- <button class="add-product-btn" id="openAddModal">
                            <i class="uil uil-plus"></i> Add new product
                        </button> -->
                    </div>
                </div>
                <table id="inventoryTableRecreational">
                <h3>Recreational Equipment</h3>
                    <thead>
                        <tr>
                            <th>Equipment</th>
                            <th>Sport</th>
                            <th>Issued</th>
                            <th>Damaged/Lost</th>
                            <th>Remaining</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($listrec)):?>
                            <?php foreach($listrec as $i):?>
                                <tr>
                                    <td><?php echo $i->name;?></td>
                                    <td><?php echo $i->sport_name;?></td>
                                    <td><?php echo $i->issued_quantity;?></td>
                                    <td><?php echo $i->damaged_quantity;?></td>
                                    <td><?php echo $i->remaining_quantity;?></td>
                                </tr>
                            <?php endforeach;?>
                        <?php endif;?>
                    </tbody>
                </table>
                <div class="edit-reason">
                    <table id="edit-reasonTableTeam table">
                        <h3>Updates</h3>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Equipment</th>
                                <th>Sport</th>
                                <th>Quantity</th>
                                <th>Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($updatesrec)):?>
                                <?php foreach($updatesrec as $i):?>
                                    <tr>
                                        <td><?php echo $i->date ?></td>
                                        <td><?php echo $i->name;?></td>
                                        <td><?php echo $i->sport_name;?></td>
                                        <td><?php echo $i->quantity;?></td>
                                        <td><?php echo $i->reason;?></td>
                                    </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
            </section>
           
        </main>

        

    
	<script src="<?=ROOT?>/assets/js/ped_incharge/ped_unpackedinventory.js"></script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>

