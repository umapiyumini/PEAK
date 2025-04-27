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
    <!-- Add this near the top of your view file -->

    <?php $current_page = 'externalcustomers'; include 'sidebar.view.php'?>
    <div class="main-content">
        <div class="header">
        <?php if(isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['success'] ?>
        <?php unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>

<?php if(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error'] ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

            <h1>Customer Data</h1>  
            <button class="bell-icon"><i class="uil uil-bell"></i></button>
            




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

    <div class="feedback-message-container">
        <!-- Feedback section (existing) -->
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

        <!-- Messages section (new) -->
        <section class="feedbacks">
            <h2>Customer Messages</h2>
            <div class="row">
                <?php if (!empty($messages)): ?>
                    <?php foreach ($messages as $message): ?>
                        <?php error_log('Message user_id: ' . ($message['user_id'] ?? 'not set')); ?>
                        <div class="message-col facility" data-message-id="<?=htmlspecialchars($message['id'] ?? '')?>" data-user-id="<?=htmlspecialchars($message['user_id'] ?? '')?>">

                            <img 
                                src="<?=LINKROOT?>/uploads/profile_pictures/<?=htmlspecialchars($message['user_image'])?>"
                                alt="<?=htmlspecialchars($message['user_name'])?>"
                                onerror="this.onerror=null;this.src='<?=ROOT?>/uploads/profile_pictures/default.jpg';"
                            >
                            <div>
                                <p><?=htmlspecialchars($message['content'])?></p>
                                <h3><?=htmlspecialchars($message['user_name'])?></h3>
                                <div class="message-datetime">
                                    <?=date('d.m.Y', strtotime($message['date']))?> at <?=date('H:i', strtotime($message['time']))?>
                                </div>
                                <button class="reply-btn" > Reply</button>
                            </div>
                           
                        </div>
                       
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No messages available yet.</p>
                <?php endif; ?>
            </div>
        </section>
    </div>
</main>

           
<!-- Reply Modal -->
<!-- Reply Modal -->
<div id="replyModal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h2>Reply to <span id="customerName"></span></h2>
        <form id="replyForm" action="<?=ROOT?>/ped_incharge/external_customer/send_reply" method="POST">
       
            <input type="hidden" id="messageId" name="messageId">
            <input type="hidden" id="toUserId" name="toUserId">
            <div class="form-group">
                <label for="replyMessage">Your Reply:</label>
                <textarea id="replyMessage" name="replyMessage" rows="4" required></textarea>
            </div>
            <div class="form-actions">
                <button type="button" class="cancel-btn">Cancel</button>
                <button type="submit" class="send-btn">Send Reply</button>
            </div>
        </form>
    </div>
</div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('replyModal');
    const closeBtn = document.querySelector('.close-modal');
    const cancelBtn = document.querySelector('.cancel-btn');
    const replyBtns = document.querySelectorAll('.reply-btn');
    const replyForm = document.getElementById('replyForm');
    const customerNameSpan = document.getElementById('customerName');
    
    // Open modal when reply button is clicked
    replyBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const messageCol = this.closest('.message-col');
            const customerName = messageCol.querySelector('h3').textContent;
            const toUserId = messageCol.dataset.userId;
            const messageId = messageCol.dataset.messageId;

            // Set values in the modal
            customerNameSpan.textContent = customerName;
            document.getElementById('toUserId').value = toUserId;
            document.getElementById('messageId').value = messageId;
             // Add this line right here
        // console.log("toUserId value set to:", document.getElementById('toUserId').value);
        // console.log("messageId value set to:", document.getElementById('messageId').value);

        console.log("messageCol dataset:", messageCol.dataset);
console.log("toUserId value set to:", document.getElementById('toUserId').value);



            // Show the modal
            modal.style.display = 'block';
        });
    });
    
    // Close modal functions
    function closeModal() {
        modal.style.display = 'none';
        replyForm.reset();
    }
    
    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);
    
    // Close modal when clicking outside of it
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeModal();
        }
    });
});

        </script>
    
	<script src="<?=ROOT?>/assets/js/ped_incharge/external_customers.js"></script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>


<!--     -->