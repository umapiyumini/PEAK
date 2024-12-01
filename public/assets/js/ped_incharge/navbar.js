function toggleMenu() {
    const navMenu = document.querySelector('nav ul');
    navMenu.classList.toggle('active');
}
// Select the profile icon and dropdown menu
const profileIcon = document.querySelector('.profile-icon img');
const dropdownMenu = document.getElementById('dropdownMenu');

// Toggle dropdown menu visibility when profile icon is clicked
profileIcon.addEventListener('click', () => {
    // Toggle the 'active' class to show or hide the dropdown
    dropdownMenu.classList.toggle('active');
});

// Hide the dropdown if the user clicks anywhere else on the page
window.addEventListener('click', function (e) {
    if (!profileIcon.contains(e.target) && !dropdownMenu.contains(e.target)) {
        dropdownMenu.classList.remove('active');
    }
});

//  // Sample notification data
//  const notifications = [
//     {
//         id: 1,
//         message: "New order received #1234",
//         type: "order",
//         timestamp: new Date('2024-02-15T10:30:00')
//     },
//     {
//         id: 2,
//         message: "Inventory low on Product X",
//         type: "inventory",
//         timestamp: new Date('2024-02-14T15:45:00')
//     },
//     {
//         id: 3,
//         message: "Shipment delayed for Order #5678",
//         type: "shipping",
//         timestamp: new Date('2024-02-13T09:15:00')
//     }
// ];

// document.addEventListener('DOMContentLoaded', () => {
//     const bellIcon = document.querySelector('.bell-icon');
//     const notificationsDropdown = document.querySelector('.notifications-dropdown');
//     const notificationsList = document.getElementById('notificationsList');
//     const notificationBadge = document.querySelector('.notification-badge');

//     // Render notifications
//     function renderNotifications() {
//         notificationsList.innerHTML = notifications.map(notification => `
//             <li data-id="${notification.id}">
//                 <a href="#">${notification.message}</a>
//             </li>
//         `).join('');

//         // Update badge count
//         notificationBadge.textContent = notifications.length;
//     }

//     bellIcon.addEventListener('click', (event) => {
//         event.stopPropagation();
//         notificationsDropdown.classList.toggle('show');
//     });

//     // Close dropdown when clicking outside
//     document.addEventListener('click', (event) => {
//         if (!notificationsDropdown.contains(event.target) && 
//             !bellIcon.contains(event.target)) {
//             notificationsDropdown.classList.remove('show');
//         }
//     });

//     // Initial render
//     renderNotifications();
// });

const notifications = [
    {
        id: 1,
        message: "External Ground Reservation",
        type: "reservation",
        timestamp: new Date('2024-02-15T10:30:00')
    },
    {
        id: 2,
        message: "Inventory low on Product X",
        type: "inventory",
        timestamp: new Date('2024-02-14T15:45:00')
    },
    {
        id: 3,
        message: "Shipment delayed for Order #5678",
        type: "shipping",
        timestamp: new Date('2024-02-13T09:15:00')
    }
];

document.addEventListener('DOMContentLoaded', () => {
    const bellIcon = document.querySelector('.bell-icon');
    const notificationsDropdown = document.querySelector('.notifications-dropdown');
    const notificationsList = document.getElementById('notificationsList');
    const notificationBadge = document.querySelector('.notification-badge');
    const clearAllBtn = document.querySelector('.clear-all');

    function formatTimeAgo(date) {
        const now = new Date();
        const diffInMs = now - date;
        const diffInHours = Math.floor(diffInMs / (1000 * 60 * 60));
        
        if (diffInHours < 24) return `${diffInHours} hours ago`;
        return date.toLocaleDateString();
    }

    function renderNotifications() {
        notificationsList.innerHTML = notifications.map(notification => `
            <li class="notification-item" data-id="${notification.id}">
                <div class="notification-icon">
                    <i class="uil ${
                        notification.type === 'reservation' ? ' uil-calendar-alt' :
                        notification.type === 'inventory' ? 'uil-box' :
                        'uil-file-alt'
                    }"></i>
                </div>
                <div class="notification-content">
                    <div class="notification-message">${notification.message}</div>
                    <div class="notification-time">${formatTimeAgo(notification.timestamp)}</div>
                </div>
            </li>
        `).join('');

        notificationBadge.textContent = notifications.length;
    }

    bellIcon.addEventListener('click', (event) => {
        event.stopPropagation();
        notificationsDropdown.classList.toggle('show');
    });

    clearAllBtn.addEventListener('click', () => {
        notifications.length = 0;
        renderNotifications();
    });

    document.addEventListener('click', (event) => {
        if (!notificationsDropdown.contains(event.target) && 
            !bellIcon.contains(event.target)) {
            notificationsDropdown.classList.remove('show');
        }
    });

    renderNotifications();
});

