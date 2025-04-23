function filterTable() {
    const searchInput = document.getElementById("search-bar").value.toLowerCase();
    const table = document.getElementById("attendance-chart");
    const rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) { // Start from 1 to skip the header row
        const playerName = rows[i].getElementsByTagName("td")[0]?.textContent.toLowerCase();
        rows[i].style.display = playerName.includes(searchInput) ? "" : "none";
    }

    
}

document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("absentReasonModal");
    const closeBtn = document.querySelector(".close");
    const submitBtn = document.getElementById("submitReason");

    // When a cell with class "absent" is clicked
    document.querySelectorAll("td.absent").forEach(cell => {
        cell.addEventListener("click", () => {
            modal.style.display = "block";
        });
    });

    // Close modal
    closeBtn.onclick = function () {
        modal.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }

    // Submit button logic
    submitBtn.onclick = function () {
        const reason = document.getElementById("absentReason").value;
        if (reason.trim() === "") {
            alert("Please enter a reason.");
            return;
        }

        // You can now send this reason to the backend using fetch/AJAX here
        console.log("Absent reason submitted:", reason);

        // Optionally close modal after submission
        modal.style.display = "none";
        document.getElementById("absentReason").value = ""; // clear field
    }
});
