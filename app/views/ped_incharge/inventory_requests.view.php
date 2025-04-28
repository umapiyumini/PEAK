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
                    $sportGroups = array();
                    if (!empty($endreqdata)) {
                        foreach ($endreqdata as $item) {
                            $sportGroups[$item->sport_name][] = $item;
                        }
                        ksort($sportGroups);
                    }
                ?>
                    
                    
                <div class="year-end-requests" id="end-section">
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

    
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-requests');
    const statusFilter = document.getElementById('status-filter');
    const typeFilter = document.getElementById('request-type');
    const requestsTable = document.getElementById('requests-table');
    const requestsBody = document.getElementById('requests-body');
    
    function filterRequests() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value.toLowerCase();
        const typeValue = typeFilter.value.toLowerCase();
        
        const rows = requestsBody.querySelectorAll('tr');
        
        rows.forEach(row => {
            const requestId = row.cells[0].textContent.toLowerCase();
            const type = row.cells[1].textContent.toLowerCase();
            const sport = row.cells[2].textContent.toLowerCase();
            const equipment = row.cells[3].textContent.toLowerCase();
            const status = row.cells[6].textContent.toLowerCase();
            
            const matchesSearch = 
                requestId.includes(searchTerm) || 
                type.includes(searchTerm) || 
                sport.includes(searchTerm) || 
                equipment.includes(searchTerm);
                
            const matchesStatus = statusValue === 'all' || status === statusValue;
            const matchesType = typeValue === 'all' || type === typeValue;
            
            if (matchesSearch && matchesStatus && matchesType) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    if (searchInput) searchInput.addEventListener('keyup', filterRequests);
    if (statusFilter) statusFilter.addEventListener('change', filterRequests);
    if (typeFilter) typeFilter.addEventListener('change', filterRequests);
    
    const historyTable = document.getElementById('yearend-history-table');
    if (historyTable) {
        const searchHistoryInput = document.createElement('input');
        searchHistoryInput.type = 'text';
        searchHistoryInput.id = 'search-history';
        searchHistoryInput.placeholder = 'Search history...';
        searchHistoryInput.style.margin = '0 0 15px 0';
        searchHistoryInput.style.padding = '8px';
        searchHistoryInput.style.width = '100%';
        
        const historyList = document.getElementById('history-list');
        if (historyList) {
            historyList.insertBefore(searchHistoryInput, historyTable);
            
            searchHistoryInput.addEventListener('keyup', function() {
                const searchTerm = searchHistoryInput.value.toLowerCase();
                const historyRows = document.querySelectorAll('#yearend-history-body tr');
                
                historyRows.forEach(row => {
                    const requestId = row.cells[0].textContent.toLowerCase();
                    const sport = row.cells[1].textContent.toLowerCase();
                    const item = row.cells[2].textContent.toLowerCase();
                    const specs = row.cells[4].textContent.toLowerCase();
                    const status = row.cells[5].textContent.toLowerCase();
                    
                    if (requestId.includes(searchTerm) || 
                        sport.includes(searchTerm) || 
                        item.includes(searchTerm) || 
                        specs.includes(searchTerm) ||
                        status.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    }
});

</script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/ped_inventory.js"></script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>

