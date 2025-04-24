// Open modal by ID
function openModal(modalId) {
    document.getElementById(modalId).style.display = "block";
}

// Close modal by ID
function closeModal(modalId) {
    document.getElementById(modalId).style.display = "none";
}

// Open Add Record Modal
document.getElementById("add-record-btn").addEventListener("click", function() {
    openModal("interUniAddModal");
});

// Open View Modal and populate player list
function openViewModal(type, recordId, playersRegNo) {
    const modalId = type === "interUni" ? "interuniViewModal" : "";
    const listElement = document.getElementById("interUniPlayerList");
    listElement.innerHTML = "";

    const players = playersRegNo.split(","); // Assuming comma-separated values
    players.forEach(player => {
        const li = document.createElement("li");
        li.textContent = player.trim();
        listElement.appendChild(li);
    });

    openModal(modalId);
}

// Open Edit Modal and fill the fields
function openEditModal(type, recordId, name, date, place, venue, noOfPlayers, category) {
    if (type !== "interUni") return;

    document.getElementById("interUniEditId").value = recordId;
    document.getElementById("interUniEditName").value = name;
    document.getElementById("interUniEditDate").value = date;
    document.getElementById("interUniEditPlace").value = place;
    document.getElementById("interUniEditVenue").value = venue;
    document.getElementById("interUniEditPlayers").value = noOfPlayers;

    document.getElementById("interUniModal").style.display = "block";
}

// Close modal on outside click
window.onclick = function(event) {
    const modals = document.querySelectorAll(".modal");
    modals.forEach(modal => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
}
