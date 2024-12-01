function handleApprove(name, username, time) {
    openModal(name, username, time, "approved");
  }
  
  function handleReject(name, username, time) {
    openModal(name, username, time, "rejected");
  }
  
  function openModal(name, username, time, action) {
    document.getElementById("modalTitle").textContent = name + " will be " + action;
    document.getElementById("modalUsername").textContent = username;
    document.getElementById("modalRequestTime").textContent = "Requested for: " + time;
    document.getElementById("confirmButton").textContent = "Confirm " + action;
    document.getElementById("confirmButton").onclick = () => {
      alert(name + " has been " + action + " for gym entry.");
      closeModal();
    };
    document.getElementById("modal").style.display = "flex";
  }
  
  function closeModal() {
    document.getElementById("modal").style.display = "none";
  }
  