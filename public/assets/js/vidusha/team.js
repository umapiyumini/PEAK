// DOM Elements
const form = document.getElementById("player-form");
const playerRegNo = document.getElementById("player-regno");
const playerPosition = document.getElementById("player-position");
const playerNumber = document.getElementById("player-number");
const rosterTable = document.getElementById("roster-table").getElementsByTagName("tbody")[0];
const updateModal = document.getElementById("editModal");
const closeUpdateModalButton = updateModal.querySelector(".close");

// Hide modal initially
updateModal.style.display = 'none';

// Open Edit Modal when clicking the Update button
document.addEventListener("click", function (e) {
    if (e.target.closest(".update-btn")) {
        const button = e.target.closest(".update-btn");
        const row = button.closest("tr");

        if(!row) return;

        // Get player data from the row
        const regno = button.getAttribute("data-id");
        const position = row.cells[1].innerText;
        const jerseyno = row.cells[2].innerText;

        document.getElementById("edit-regno").value = regno;
        document.getElementById("edit-position").value = position;
        document.getElementById("edit-jerseyno").value = jerseyno;

        // Show the modal
        updateModal.style.display = 'block';
    }
});

// Close modal when clicking the close button
closeUpdateModalButton.addEventListener("click", () => {
    updateModal.style.display = "none";
});

// When clicking outside the modal, close it
window.addEventListener("click", (e) => {
    if (e.target === updateModal) {
        updateModal.style.display = "none";
    }
});

// Function to add player to roster
function addPlayerToRoster(regNo, position, number) {
    const row = rosterTable.insertRow();
    row.setAttribute("data-regno", regNo);

    row.innerHTML = `
        <td>${regNo}</td>
        <td>${position}</td>
        <td>${number}</td>
        <td>
            <button class="update-btn" data-id="${regNo}">
                <i class="fas fa-edit"></i>
            </button>
            <form method="POST" action="<?=ROOT?>/sportscaptain/team/deleteplayer" style="display: inline;">
                <input type="hidden" name="regno" value="${regNo}">
                <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this player?');">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </td>
    `;
}


