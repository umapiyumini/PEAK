function approverequest(regno, btn) {
  if (!confirm("Are you sure you want to approve this request?")) return;

  fetch('<?= ROOT ?>/sportscaptain/recruitment/approverequest', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `regno=${encodeURIComponent(regno)}`
  })
  .then(response => response.json())  // Expecting JSON response
  .then(data => {
      if (data.success) {
          alert("Request approved successfully!");
          btn.closest('.notification-card').remove();  // Remove the card from UI
      } else {
          alert("Failed to approve the request.");
      }
  })
  .catch(error => {
      console.error("Error approving request:", error);
      alert("Something went wrong.");
  });
}

function rejectRequest(regno, btn) {
  if (!confirm("Are you sure you want to reject this request?")) return;

  fetch('<?= ROOT ?>/sportscaptain/recruitment/rejectrequest', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `regno=${encodeURIComponent(regno)}`
  })
  .then(response => response.json())  // Expecting JSON response
  .then(data => {
    if (data.success) {
      alert("Request rejected!");
      btn.closest('.notification-card').remove();
    } else {
      alert("Failed to reject the request.");
    }
  })
  .catch(error => {
    console.error("Error rejecting request:", error);
    alert("Something went wrong.");
  });
}
