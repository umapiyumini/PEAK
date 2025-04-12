// Function to handle approval
function approveRequest(studentId) {
  updateStatus(studentId, 'Approved');

  showMessage(`Student ID ${studentId} has been approved!`, 'success');
}

// Function to handle rejection
function rejectRequest(studentId) {
  const rejectionReason = prompt(`Please provide a rejection reason for Student ID ${studentId}:`);
  
  if (rejectionReason) {
    updateStatus(studentId, 'Rejected', rejectionReason);
    showMessage(`Student ID ${studentId} has been rejected. Reason: ${rejectionReason}`, 'error');
  } else {
    showMessage(`Rejection for Student ID ${studentId} was canceled as no reason was provided.`, 'warning');
  }
}

// Function to show feedback messages
function showMessage(text, type) {
  const messageContainer = document.getElementById('message-container');
  const message = document.createElement('div');
  message.className = `message ${type}`;
  message.textContent = text;
  messageContainer.appendChild(message);

  // Auto-remove message after 3 seconds
  setTimeout(() => message.remove(), 3000);
}

// Function to send status update to the backend
function updateStatus(studentId, action, reason = '') {
  fetch('approve_reject.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      id: studentId,
      action: action.toLowerCase(), // 'approved' or 'rejected'
      reason: reason
    })
  })
  .then(res => res.text())
  .then(response => {
    console.log('Server response:', response);
    // Optionally remove the card or mark it as processed
  })
  .catch(err => {
    console.error('Error updating status:', err);
    showMessage(`Failed to update status for Student ID ${studentId}.`, 'error');
  });
}
