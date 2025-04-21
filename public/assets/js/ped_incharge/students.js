
// Search students by Reg. No, Name, or Faculty
const searchInput = document.getElementById("searchInput");
const studentTable = document.getElementById("studentTable");
const tableRows = studentTable.querySelectorAll("tbody tr");

// Event listener for search input
searchInput.addEventListener("input", function () {
    const searchTerm = searchInput.value.toLowerCase(); // Convert search term to lowercase

    tableRows.forEach(row => {
        const registrationnumber = row.querySelector("td:nth-child(1)").textContent.trim().toLowerCase();
        const name = row.querySelector("td:nth-child(2)").textContent.trim().toLowerCase();
        const faculty = row.querySelector("td:nth-child(3)").textContent.trim().toLowerCase();

        // Show row if any of the fields contain the search term
        if (registrationnumber.includes(searchTerm) || name.includes(searchTerm) || faculty.includes(searchTerm)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});



