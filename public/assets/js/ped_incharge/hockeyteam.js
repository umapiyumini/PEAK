// Get DOM elements
const form = document.getElementById("player-form");
const playerRegNo = document.getElementById("player-regno");
const playerPosition = document.getElementById("player-position");
const playerNumber = document.getElementById("player-number");
const rosterTable = document.getElementById("roster-table").getElementsByTagName("tbody")[0];

// Track the currently editing row
let editingRow = null;

// Function to add a player to the roster table
function addPlayerToRoster(regNo, position, number) {
    const row = rosterTable.insertRow();
    row.setAttribute("data-regno", regNo);

    row.innerHTML = `
         <td><a href="studentprofile?regNo=${regNo}" target="_blank">${regNo}</a></td>
        <td>${position}</td>
        <td>${number}</td>
        <td style="text-align: center;">
            <button class="btn-edit" onclick="editPlayer(this)">
                <i class="fas fa-edit"></i>
            </button>
            <button class="btn-delete" onclick="deletePlayer(this)">
                <i class="fas fa-trash-alt"></i>
            </button>
        </td>
    `;
}

// Function to handle form submission (Add Player)
form.addEventListener("submit", function (e) {
    e.preventDefault();

    const regNo = playerRegNo.value;
    const position = playerPosition.value;
    const number = playerNumber.value;

    if (editingRow) {
        // Update the existing row
        editingRow.cells[0].innerHTML = `<a href="../../../../app/views/sportscaptain/studentprofile?regNo=${editingRow.getAttribute("data-regno")}" class="profile-link">${regNo}</a>`;
        editingRow.cells[1].textContent = position;
        editingRow.cells[2].textContent = number;

        // Clear editing state
        editingRow = null;
    } else {
        // Add new player to the roster
        addPlayerToRoster(regNo, position, number);
    }

    // Clear the form
    playerRegNo.value = "";
    playerPosition.value = "";
    playerNumber.value = "";
});

// Function to edit player details
function editPlayer(button) {
    const row = button.closest("tr");

    // Prefill form fields with existing data
    playerRegNo.value = row.cells[0].textContent;
    playerPosition.value = row.cells[1].textContent;
    playerNumber.value = row.cells[2].textContent;

    // Set editing row
    editingRow = row;
}

// Function to delete player
function deletePlayer(button) {
    const row = button.closest("tr");

    if (confirm("Are you sure you want to delete this player?")) {
        row.remove();
    }
}

// Optional: Initialize the roster with sample data
function initializeRoster() {
    addPlayerToRoster("REG12345", "Forward", "10");
    addPlayerToRoster("REG12346", "Goalkeeper", "1");
}

initializeRoster();
