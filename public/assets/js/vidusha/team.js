/*Get DOM elements
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
// form.addEventListener("submit", function (e) {
//     e.preventDefault();

//     const regNo = playerRegNo.value.trim();
//     const position = playerPosition.value.trim();
//     const number = playerNumber.value.trim();

//     if (!regNo || !position || !number) {
//         alert("All fields are required.");
//         return;
//     }

//     if (editingRow) {
//         // Update the existing row
//         editingRow.cells[0].innerHTML = `<a href="studentprofile?regNo=${regNo}" target="_blank">${regNo}</a>`;
//         editingRow.cells[1].textContent = position;
//         editingRow.cells[2].textContent = number;
//         editingRow = null;
//     } else {
//         // Add new player to the roster and database
//         addPlayerToRoster(regNo, position, number);
//         savePlayerToDatabase(regNo, position, number);
//     }

//     // Clear the form
//     form.reset();
// });

// Function to send player data to the backend (AJAX)
function savePlayerToDatabase(regNo, position, number) {
    fetch("<?= ROOT ?>/sportscaptain/addplayer", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
            regno: regNo,
            position: position,
            jersyno: number,
        }),
    })
    .then((response) => response.text())
    .then((data) => {
        console.log(data);
        alert("Player added successfully!");
    })
    .catch((error) => {
        console.error("Error:", error);
        alert("Failed to add player.");
    });
}

// Function to edit player
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('editModal');
    const span = document.getElementsByClassName('close')[0];
    const editForm = document.querySelector('.edit-form');
    
    // Function to handle edit button clicks
    document.querySelectorAll('.update-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const row = this.closest('tr');
            
            // Get data from the row
            const regno = this.getAttribute('data-id');
            const position = row.cells[1].textContent.trim();
            const jerseyno = row.cells[2].textContent.trim();
            
            // Populate the edit form
            document.getElementById('edit-regno').value = regno;
            document.getElementById('edit-position').value = position;
            document.getElementById('edit-jerseyno').value = jerseyno;
            
            // Show the modal with animation
            modal.style.display = 'block';
            modal.style.opacity = '0';
            setTimeout(() => {
                modal.style.opacity = '1';
            }, 10);
        });
    });
    
    // Close modal when clicking the X
    span.onclick = function() {
        closeModal();
    }
    
    // Close modal when clicking outside
    window.onclick = function(event) {
        if (event.target == modal) {
            closeModal();
        }
    }
    
    // Function to close modal with animation
    function closeModal() {
        modal.style.opacity = '0';
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }
    
    // Handle form submission
    editForm.addEventListener('submit', function(e) {
        // You can add form validation here if needed
        const regno = document.getElementById('edit-regno').value;
        const position = document.getElementById('edit-position').value;
        const jerseyno = document.getElementById('edit-jerseyno').value;
        
        if (!position || !jerseyno) {
            e.preventDefault();
            alert('Please fill in all fields');
            return;
        }
    });
});


// Function to delete player
function deletePlayer(button) {
    const row = button.closest("tr");
    const regNo = row.getAttribute("data-regno");

    if (confirm("Are you sure you want to delete this player?")) {
        row.remove();
        deletePlayerFromDatabase(regNo);
    }
}

// Function to delete player from database (AJAX)
function deletePlayerFromDatabase(regNo) {
    fetch("<?= ROOT ?>/sportscaptain/deleteplayer", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
            regno: regNo,
        }),
    })
    .then((response) => response.text())
    .then((data) => {
        console.log(data);
        alert("Player deleted successfully!");
    })
    .catch((error) => {
        console.error("Error:", error);
        alert("Failed to delete player.");
    });
}*/

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

// Open Edit Modal when clicking the Update button
document.addEventListener("click", function (e) {
    if (e.target.closest("update-btn")) {
        const button = e.target.closet(".update-btn");
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
    e.preventDefault();

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
        if (data.success) {
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
