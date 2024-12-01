// Function to handle approval
function approveRequest(studentId) {
  const messageContainer = document.getElementById('message-container');
  const message = document.createElement('div');
  message.className = 'message success';
  message.textContent = `Student ID ${studentId} has been approved!`;
  messageContainer.appendChild(message);

  // Auto-remove the message after 3 seconds
  setTimeout(() => message.remove(), 3000);
}

// Function to handle rejection
function rejectRequest(studentId) {
  const rejectionReason = prompt(`Please provide a rejection reason for Student ID ${studentId}:`);
  const messageContainer = document.getElementById('message-container');

  if (rejectionReason) {
    const message = document.createElement('div');
    message.className = 'message error';
    message.textContent = `Student ID ${studentId} has been rejected. Reason: ${rejectionReason}`;
    messageContainer.appendChild(message);

    // Auto-remove the message after 3 seconds
    setTimeout(() => message.remove(), 3000);
  } else {
    const message = document.createElement('div');
    message.className = 'message warning';
    message.textContent = `Rejection for Student ID ${studentId} was canceled as no reason was provided.`;
    messageContainer.appendChild(message);

    // Auto-remove the message after 3 seconds
    setTimeout(() => message.remove(), 3000);
  }
}

// Example of dynamically adding notifications
const notificationList = document.getElementById('notification-list');

// Add more notifications dynamically (example data)
const students = [
  { id: 23456, name: "Jane Smith", faculty: "Science", reason: "I was a school hockey team member" },
  { id: 34567, name: "Alice Johnson", faculty: "Management", reason: "I was a school hockey team member" },
];

students.forEach((student) => {
  const card = document.createElement('div');
  card.className = 'notification-card';
  card.innerHTML = `
    <p><strong>Student ID:</strong> ${student.id}</p>
    <p><strong>Name:</strong> ${student.name}</p>
    <p><strong>Faculty:</strong> ${student.faculty}</p>
    <p><strong>Reason:</strong> ${student.reason}</p>
    <div class="action-buttons">
      <button class="approve-btn" onclick="approveRequest(${student.id})">Approve</button>
      <button class="reject-btn" onclick="rejectRequest(${student.id})">Reject</button>
    </div>
  `;
  notificationList.appendChild(card);
});
