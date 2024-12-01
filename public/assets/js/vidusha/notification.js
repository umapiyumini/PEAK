const notifications = [
    { type: "Sport Recruitment", message: "New request for soccer team recruitment.", details: "Player details: John Doe, Age: 20." },
    { type: "Gym Entry Approval", message: "Pending approval for gym access.", details: "Member: Jane Smith, Membership ID: 234." },
    { type: "Notice", message: "Maintenance scheduled for December 5th.", details: "Gym maintenance will occur from 8 AM to 12 PM." },
    { type: "Event", message: "Annual Sports Day on December 20th.", details: "Event starts at 9 AM at the Main Stadium." },
];

function displayNotifications() {
    const notificationList = document.getElementById("notification-list");
    notifications.forEach((notification, index) => {
        const notificationDiv = document.createElement("div");
        notificationDiv.classList.add("notification");

        notificationDiv.innerHTML = `
            <div class="notification-type">${notification.type}</div>
            <div class="notification-message">${notification.message}</div>
            <div class="notification-actions">
                <button class="view-details" onclick="viewDetails(${index})">View Details</button>
                
            </div>
        `;
        notificationList.appendChild(notificationDiv);
    });
}

function viewDetails(index) {
    alert(`Details: ${notifications[index].details}`);
}





function removeNotification(index) {
    const notificationList = document.getElementById("notification-list");
    notificationList.removeChild(notificationList.childNodes[index]);
    notifications.splice(index, 1); // Update the array
    // Re-render notifications
    notificationList.innerHTML = '';
    displayNotifications();
}

document.addEventListener("DOMContentLoaded", displayNotifications);
