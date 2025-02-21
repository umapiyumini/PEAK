<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/inventory_requests.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <?php $current_page = 'inventory'; include 'sidebar.view.php'?>
    <div class="main-content">
        
        <div class="header">
            <button onclick="history.back()" class="goBackButton"><i class="uil uil-arrow-left"></i></button>
            <h1>Inventory Requests</h1>
        </div>
        
        <main>
            <div class="inventory-section">
                <div class="stats-container">
                    <div class="stat-card">
                        <h3>Pending Requests</h3>
                        <div class="number" id="pending-count">0</div>
                    </div>
                    <div class="stat-card">
                        <h3>Approved Requests</h3>
                        <div class="number" id="approved-count">0</div>
                    </div>
                    <div class="stat-card">
                        <h3>Rejected Requests</h3>
                        <div class="number" id="rejected-count">0</div>
                    </div>
                    <div class="stat-card">
                        <h3>End year Requests</h3>
                        <div class="number" id="endyear-count">0</div>
                    </div>
                </div>

                <div class="requests-section">
                    <h4 class="card-title">Pending Requests</h4>

                    <div class="filter-bar">
                        <input type="text" id="search-requests" placeholder="Search requests..." style="flex: 1;">
                        <select id="status-filter">
                            <option value="all">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                            <option value="issued">Issued</option>
                        </select>
                        <select id="request-type">
                            <option value="all">All Types</option>
                            <option value="team">Team</option>
                            <option value="recreational">Recreational</option>
                        </select>
                    </div>
                    <table id="requests-table">
                        <thead>
                            <tr>
                                <th>Request ID</th>
                                <th>Type</th>
                                <th>Sport</th>
                                <th>Equipment</th>
                                <th>Quantity</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="requests-body">
                            <?php if(!empty($reqdata)): ?>
                                <?php foreach ($reqdata as $i): ?>
                                    <tr>
                                        <td><?=$i->requestid?></td>
                                        <td><?=$i->type?></td>
                                        <td><?=$i->sport_name?></td>
                                        <td><?=$i->name?></td>
                                        <td><?=$i->quantityrequested?></td>
                                        <td><?=$i->date?></td>
                                        <td><?=$i->status?></td>
                                        <td>
                                            <!-- <button class="btn btn-view" id="openRequest" onclick="openRequest(<?= htmlspecialchars(json_encode($i), ENT_QUOTES, 'UTF-8') ?>)">
                                                <i class="uil uil-eye"></i>
                                            </button> -->
                                            <button class="btn btn-update <?= ($i->status === 'Approved') ? 'disabled-btn' : '' ?>" 
                                                    id="acceptRequest" 
                                                    onclick="acceptRequest(<?= htmlspecialchars(json_encode($i), ENT_QUOTES, 'UTF-8') ?>)"
                                                    <?= ($i->status === 'Approved') ? 'disabled' : '' ?>>
                                                <i class="uil uil-check-circle"></i>
                                            </button>

                                            <button class="btn btn-delete" onclick="deleteRequest(<?= htmlspecialchars(json_encode($i), ENT_QUOTES, 'UTF-8') ?>)">
                                                <i class="uil uil-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
                <div class="year-end-requests">
                    <h2>Hockey</h2>
                    <table id="yearend-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Item</th>
                                <th>Required Quantity</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody id="yearend-body">
                        </tbody>
                    </table>
                    <button class="btn btn-save">
                        <i class="uil uil-save"></i> Save
                    </button>
                    <button class="btn btn-reject">
                        <i class="uil uil-cross"></i> Reject
                    </button>
                </div>
            </div>
        </main>
    </div>
             

           

        

    
	<script src="<?=ROOT?>/assets/js/ped_incharge/ped_inventory.js"></script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>

