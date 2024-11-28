function filterTable() {
    const filter = document.getElementById("statusFilter").value;
    const rows = document.querySelectorAll(".reservation-history tbody tr");

    rows.forEach(row => {
        const status = row.cells[2].textContent;
        if (filter === "all" || status === filter) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}