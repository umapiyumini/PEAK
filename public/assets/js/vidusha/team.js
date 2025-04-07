

// DOM Elements

const form = document.getElementById("player-form");
const playerRegNo = document.getElementById("player-regno");
const playerPosition = document.getElementById("player-position");
const playerNumber = document.getElementById("player-number");
const rosterTable = document.getElementById("roster-table").getElementsByTagName("tbody")[0];
const span = document.getElementsByClassName('close')[0];
const editForm = document.getElementById("edit-form");
const updateModal = document.getElementById("editModal");
const closeUpdateModalButton = updateModal.querySelector(".close");

updateModal.style.display = 'none';
// Open Edit Modal when clicking the Update button
document.addEventListener("click", function (e) {
    if (e.target.closest(".update-btn")) {
        console.log("Update button clicked")
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

// Handle Edit Form Submission
editForm.addEventListener('submit', function (e) {
    //e.preventDefault();

    const regno = document.getElementById('edit-regno').value.trim();
    const position = document.getElementById('edit-position').value.trim();
    const jerseyno = document.getElementById('edit-jerseyno').value.trim();

    if (!regno || !position || !jerseyno) {
        alert('Please fill in all fields');
        return;
    }

    fetch(`${ROOT}/sportscaptain/team/updateplayer`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ regno, position, jerseyno })
    })
    .then(response => response.json())
    .then(data => {

        console.log("Response from server:", data);

        if (data.success) {
            alert("Player updated successfully!");
            updateModal.style.display = "none";
            location.reload(); // Reload to update the table
        } else {
            alert(data.message || 'Update failed');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update player');
    });
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

// Delete confirmation for existing delete buttons
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function(e) {
        if (!confirm('Are you sure you want to delete this player?')) {
            e.preventDefault();
        }
    });
});

// Success/Error message auto-hide
document.addEventListener('DOMContentLoaded', function() {
    // Auto hide success message after 3 seconds
    const successAlert = document.querySelector('.alert-success');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.opacity = '0';
            setTimeout(() => {
                successAlert.style.display = 'none';
            }, 300);
        }, 3000);
    }

    // Auto hide error message after 5 seconds
    const errorAlert = document.querySelector('.alert-danger');
    if (errorAlert) {
        setTimeout(() => {
            errorAlert.style.opacity = '0';
            setTimeout(() => {
                errorAlert.style.display = 'none';
            }, 300);
        }, 5000);
    }
});
