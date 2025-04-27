<?php
if (session_status() == PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../../models/User.php'; // Adjust path as needed

$profile_img = "/PEAK/assets/images/user1.jpg"; // default

if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
    $userModel = new User();
    $user_data = $userModel->getUser($userid);
    $user = (!empty($user_data)) ? $user_data[0] : null;

    if ($user && !empty($user->image)) {
        $profile_img = "/PEAK/uploads/profile_pictures/" . htmlspecialchars($user->image);
    }
}


$notifications = [];
$userId = $_SESSION['userid'] ?? null;

if ($userId) {
    $notificationsModel = new Notifications();
    $notifications = $notificationsModel->getActiveUnreadNotifications($userId);
}
?>





<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-1.0">
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/enav.css">
        <title>External User Dashboard</title>
    </head>


    <body>
        <!-- navigation bar -->
        

       

        
        <div class="topbar">
    <!-- Notification Icon -->
    <div class="notification">
    <a href="javascript:void(0);" onclick="toggleNotifications()">
        <div class="notification-icon">
            <!-- Paste SVG code here -->
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 22C13.1 22 14 21.1 14 20H10C10 21.1 10.9 22 12 22ZM18 16V11C18 7.93 16.37 5.36 13.5 4.68V4C13.5 3.17 12.83 2.5 12 2.5C11.17 2.5 10.5 3.17 10.5 4V4.68C7.64 5.36 6 7.92 6 11V16L4 18V19H20V18L18 16ZM16 17H8V11C8 8.52 9.51 6.5 12 6.5C14.49 6.5 16 8.52 16 11V17Z" fill="#360335"/>
            </svg>
           
        </div>
    </a>
        <!-- Notification Dropdown -->
        <div class="notification-dropdown" id="notificationDropdown">
        <div class="notification-header">
    <h3>Notifications</h3>
    
</div>

            <!-- In top.view.php -->
<div class="notification-list">
    <?php if (!empty($notifications)) : ?>
        <?php foreach ($notifications as $notification) : ?>
            <div class="notification-item">
                
                <div class="notification-content">
                    <p><?= htmlspecialchars($notification->content) ?></p>
                    <span class="notification-time">
                        <?= timeAgo(strtotime($notification->created_at)) ?>
                    </span>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="notification-item">
            <div class="notification-content">
                <p>No notifications found.</p>
            </div>
        </div>
    <?php endif; ?>
</div>


<?php
function timeAgo($timestamp) {
    $time = time() - $timestamp; // time difference in seconds

    if ($time < 60) return 'just now';
    elseif ($time < 3600) return floor($time / 60) . ' minutes ago';
    elseif ($time < 86400) return floor($time / 3600) . ' hours ago';
    elseif ($time < 604800) return floor($time / 86400) . ' days ago';
    else return date('M j, Y', $timestamp);
}
?>

          
        </div>
    </div>

    

    <div class="user">
        <a href="profile">
            <img src="<?= $profile_img ?>" alt="Profile Picture">
        </a>
    </div>
</div>

                

            <script >
                // Toggle notification dropdown
function toggleNotifications() {
    const dropdown = document.getElementById('notificationDropdown');
    dropdown.classList.toggle('show');
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const isClickInside = dropdown.contains(event.target) || 
                             event.target.closest('.notification-icon');
        
        if (!isClickInside && dropdown.classList.contains('show')) {
            dropdown.classList.remove('show');
        }
    });
}

// Mark notification as read when clicked
document.addEventListener('DOMContentLoaded', function() {
    const notificationItems = document.querySelectorAll('.notification-item');
    
    notificationItems.forEach(item => {
        item.addEventListener('click', function() {
            this.classList.remove('unread');
            this.querySelector('.notification-dot')?.remove();
            
            // Update badge count
            updateNotificationBadge();
        });
    });
    
    // Mark all as read functionality
    const markAllReadBtn = document.querySelector('.mark-all-read');
    if (markAllReadBtn) {
        markAllReadBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            
            const unreadItems = document.querySelectorAll('.notification-item.unread');
            unreadItems.forEach(item => {
                item.classList.remove('unread');
                item.querySelector('.notification-dot')?.remove();
            });
            
            // Update badge count
            updateNotificationBadge();
        });
    }
});

// Update notification badge count
function updateNotificationBadge() {
    const unreadCount = document.querySelectorAll('.notification-item.unread').length;
    const badge = document.querySelector('.notification-badge');
    
    if (unreadCount > 0) {
        badge.textContent = unreadCount;
        badge.style.display = 'flex';
    } else {
        badge.style.display = 'none';
    }
}

            </script>
    </body>
</html>