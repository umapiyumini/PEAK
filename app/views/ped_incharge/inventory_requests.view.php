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
                    <div class="stat-card" id="mid">
                        <h3>Mid year Requests</h3>
                        <div class="number" id="midyear-count"><?php echo $counts['midcount']; ?></div>
                    </div>
                    <div class="stat-card" id="end">
                        <h3>End year Requests</h3>
                        <div class="number" id="endyear-count"><?php echo $counts['endcount']; ?></div>
                    </div>
                </div>

                <div class="requests-section" id="mid-section">
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
                
                
                <?php
                    // Group records by sport
                    $sportGroups = array();
                    if (!empty($endreqdata)) {
                        foreach ($endreqdata as $item) {
                            $sportGroups[$item->sport_name][] = $item;
                        }
                        ksort($sportGroups);
                    }
                ?>
                    
                    
                <div class="year-end-requests" id="end-section">
                    <!-- tab switching buttons within the year end requests tab -->
                    <button class="btn btn-pending" id="pendingBtn">
                        <i class="uil uil-clock"></i> Pending Requests
                    </button>
                    <button class="btn btn-history" id="historyBtn">
                        <i class="uil uil-history"></i> Request History
                    </button>

                    <div class="request-card-list" id="request-card-list">
                        <?php if(empty($endreqdata)):?>
                            <div class="emptymessage" style="color:Red">No Pending Requests</div>
                        <?php else:?>
                            <?php foreach ($sportGroups as $sport => $requests): ?>
                            <div class="request-card">
                                <h1><?= htmlspecialchars($sport) ?></h1>

                                <table id="yearend-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Item</th>
                                            <th>Required Quantity</th>
                                            <th>Specifications</th>
                                        </tr>
                                    </thead>
                                    <tbody id="yearend-body">
                                    <?php foreach ($requests as $i): ?>
                                        <tr>
                                            <td><?=$i->requestid?></td>
                                            <td><?=$i->name?></td>
                                            <td><?=$i->quantityrequested?></td>
                                            <td><?=$i->specifications?></td>
                                        </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                                <button class="btn btn-save" onClick="saveRequest(<?= htmlspecialchars(json_encode($sport), ENT_QUOTES, 'UTF-8') ?>)">
                                    <i class="uil uil-save"></i> Save
                                </button>
                                <button class="btn btn-reject" onClick="rejectRequest(<?= htmlspecialchars(json_encode($sport), ENT_QUOTES, 'UTF-8') ?>)">
                                    <i class="uil uil-cross"></i> Reject
                                </button>
                            </div>
                            <?php endforeach;?>
                        <?php endif;?>
                    </div>

                    <div class="history-list" id="history-list" style="display:none">
                        <h1 style="margin-bottom:1rem">Processed Request History</h1>
                        <?php if(empty($allrequests)):?>
                            <div class="emptymessage" style="color:Red">No Processed Request History</div>
                        <?php else:?>
                            <table id="yearend-history-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Sport</th>
                                        <th>Item</th>
                                        <th>Required Quantity</th>
                                        <th>Specifications</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="yearend-history-body">
                                    <?php foreach ($allrequests as $j): ?>
                                        <tr>
                                            <td><?=$j->requestid?></td>
                                            <td><?=$j->sport_name?></td>
                                            <td><?=$j->name?></td>
                                            <td><?=$j->quantityrequested?></td>
                                            <td><?=$j->specifications?></td>
                                            <td><?=$j->status?></td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </main>
    </div>
             

           

        
<script>
    function saveRequest(sport) {
        confirm("Are you sure you want to save this request?") ? window.location.href = "<?=ROOT?>/ped_incharge/inventory_requests/processRequest/" + sport + "/approved" : null;
    }

    function rejectRequest(sport) {
        confirm("Are you sure you want to reject this request?") ? window.location.href = "<?=ROOT?>/ped_incharge/inventory_requests/processRequest/" + sport + "/rejected" : null;
    }

</script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/ped_inventory.js"></script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>

