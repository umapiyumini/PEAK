document.addEventListener("DOMContentLoaded", function () {
    const addPlayersBtn = document.querySelector(".add-btn");
    const addRecordsBtn = document.querySelector(".add-records-btn");
    const playersModal = document.getElementById("playersModal");
    const addRecordForm = document.getElementById("addrecordModal");
    const playerModal = document.getElementById("playerModal");

    // Open modal function
    window.openForm = function (formId) {
        playerModal.style.display = "block";
    };

    // Close modal by ID
    window.closeModal = function (modalId) {
        document.getElementById(modalId).style.display = "none";
    };

    // Open Players Modal
    addPlayersBtn.addEventListener("click", function () {
        playersModal.style.display = "block";
    });

    // Open Add Record Modal
    addRecordsBtn.addEventListener("click", function () {
        addrecordModal.style.display = "block";
        addrecordModal.scrollIntoView({ behavior: "smooth" });
    });

    // Filter functionality
    const yearInput = document.getElementById("yearFilter");
    const facultyFilter = document.getElementById("facultyFilter");
    const categoryFilter = document.getElementById("categoryFilter");
    const tableRows = document.querySelectorAll("#record-body tr");

    function applyFilters() {
        const yearVal = yearInput.value.trim().toLowerCase();
        const facultyVal = facultyFilter.value;
        const categoryVal = categoryFilter.value;

        tableRows.forEach(row => {
            const year = row.children[0].textContent.toLowerCase();
            const first = row.children[1].getAttribute('data-facultyid');
            const category = row.children[4].textContent.toLowerCase();

            const yearMatch = year.includes(yearVal);
            const facultyMatch = !facultyVal || first === facultyVal;
            const categoryMatch = category === categoryVal;

            row.style.display = (yearMatch && facultyMatch && categoryMatch) ? "" : "none";
        });
    }

    yearInput.addEventListener("input", applyFilters);
    facultyFilter.addEventListener("change", applyFilters);
    categoryFilter.addEventListener("change", applyFilters);

    // Close modals on outside click
    window.onclick = function (event) {
        if (event.target === playersModal) {
            closeModal('playersModal');
        }
        if (event.target === playerModal) {
            closeModal('playerModal');
        }
    };

    // Add listeners to action buttons (View, Edit, Delete)
    document.querySelectorAll(".view-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.getAttribute("data-id");
            alert("View record ID: " + id);
        });
    });

    document.querySelectorAll(".edit-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.getAttribute("data-id");
            alert("Edit record ID: " + id);
        });
    });

    document.querySelectorAll(".delete-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.getAttribute("data-id");
            if (confirm("Are you sure you want to delete this record?")) {
                window.location.href = `<?=ROOT?>/sportscaptain/interfaculty/deleterecord/${id}`;
            }
        });
    });
});
