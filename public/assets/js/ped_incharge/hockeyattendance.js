function filterTable() {
    const searchInput = document.getElementById("search-bar").value.toLowerCase();
    const table = document.getElementById("attendance-chart");
    const rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) { // Start from 1 to skip the header row
        const playerName = rows[i].getElementsByTagName("td")[0]?.textContent.toLowerCase();
        rows[i].style.display = playerName.includes(searchInput) ? "" : "none";
    }
}
