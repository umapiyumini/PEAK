<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>External customers</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/external_customers.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <?php $current_page = 'externalcustomers'; include 'sidebar.view.php'?>
    <div class="main-content">
        <div class="header">
            
            <h1>Customer Data</h1>  
            <button class="bell-icon"><i class="uil uil-bell"></i></button>
            <!-- <div class="notifications-dropdown">
                <div class="notifications-header">
                    <h3>Notifications</h3>
                    <span class="clear-all">Clear All</span>
                </div>
                <div class="notifications-list">
                    <ul id="notificationsList"></ul>
                </div>
              </div> -->




            <button class="bell-icon"><i class="uil uil-signout"></i></button>
        </div>
        <main>
            <div class="controls">
                <div class="search-bar">
                    <input type="text" id="searchInput" placeholder="Search customers...">
                    <i class="uil uil-search"></i>
                </div>
            </div>
            <div>
                <div class="customer-table">
                    <table id="customerTable">
                        <thead>
                            <tr>
                                <th>Customer ID</th>
                                <th>Name</th>
                                <th>Company</th>
                                <th>NIC</th>
                                <th>Email</th>
                                <th>Contact number</th>
                                <th>Address</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
<?php if (!empty($external_users)): ?>
    <?php foreach ($external_users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user->userid) ?></td>
            <td><?= htmlspecialchars($user->name) ?></td>
            <td><?= htmlspecialchars($user->company_name) ?></td>
            <td><?= htmlspecialchars($user->nic) ?></td>
            <td><?= htmlspecialchars($user->email) ?></td>
            <td><?= htmlspecialchars($user->contact_number) ?></td>
            <td><?= htmlspecialchars($user->address) ?></td>
            <td>
    <a href="<?=ROOT?>/ped_incharge/external_Profile/index/<?= $user->userid ?>" title="View">
        <i class="uil uil-eye"></i>
    </a>
</td>

        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr><td colspan="8">No external users found.</td></tr>
<?php endif; ?>
</tbody>

                    </table>
                </div>
            </div>

            <section class="feedbacks">
    <h2>Customer Feedbacks</h2>
    <div class="row">
        <?php if (!empty($feedbacks)): ?>
            <?php foreach ($feedbacks as $feedback): ?>
                <div class="feed-col facility">
                    <img 
                        src="<?=LINKROOT?>/uploads/profile_pictures/<?=htmlspecialchars($feedback['user_image'])?>"
                        alt="<?=htmlspecialchars($feedback['user_name'])?>"
                        onerror="this.onerror=null;this.src='<?=ROOT?>/uploads/profile_pictures/default.jpg';"
                    >
                    <div>
                        <p><?=htmlspecialchars($feedback['content'])?></p>
                        <h3><?=htmlspecialchars($feedback['user_name'])?></h3>
                        <?php
                            $filled = intval($feedback['rating']);
                            $empty = 5 - $filled;
                            for ($i = 0; $i < $filled; $i++) echo '<span class="star">&#9733;</span>';
                            for ($i = 0; $i < $empty; $i++) echo '<span class="star">&#9734;</span>';
                        ?>
                        <div class="feedback-date"><?=date('d.m.Y', strtotime($feedback['date']))?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No feedbacks available yet.</p>
        <?php endif; ?>
    </div>
</section>

        </main>
           

    
	<script src="<?=ROOT?>/assets/js/ped_incharge/external_customers.js"></script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>

