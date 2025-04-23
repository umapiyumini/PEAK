
    document.addEventListener("DOMContentLoaded", function () {
        // ADD MODAL
        const addModal = document.getElementById("addModal");
        const openAddModalBtn = document.getElementById("openAddModal");
        const closeAddBtn = addModal.querySelector(".close");
        const cancelAddBtn = addModal.querySelector(".btn-cancel");

        openAddModalBtn.addEventListener("click", () => {
            addModal.style.display = "block";
        });

        closeAddBtn.addEventListener("click", () => {
            addModal.style.display = "none";
        });

        cancelAddBtn.addEventListener("click", () => {
            addModal.style.display = "none";
        });

        // EDIT MODAL
        const editModal = document.getElementById("editModal");
        const closeEditBtn = editModal.querySelector(".close");
        const cancelEditBtn = editModal.querySelector(".btn-cancel");

        
        closeEditBtn.addEventListener("click", () => {
            editModal.style.display = "none";
        });

        cancelEditBtn.addEventListener("click", () => {
            editModal.style.display = "none";
        });

        // CLOSE when clicking outside both modals
        window.addEventListener("click", (e) => {
            if (e.target === addModal) {
                addModal.style.display = "none";
            }
            if (e.target === editModal) {
                editModal.style.display = "none";
            }
        });

        //search staff
        const searchInput = document.getElementById("searchInput");
        const staffTable = document.getElementById("groundStaffTable");
        const tableRows = staffTable.querySelectorAll("tbody tr");
    
        // Event listener for search input
        searchInput.addEventListener("input", function () {
            const searchTerm = searchInput.value.toLowerCase(); // Get the search term and convert it to lowercase
            tableRows.forEach(row => {
                const fullNameCell = row.querySelector("td:nth-child(2)"); // Full Name is the 2nd column
                const fullName = fullNameCell.textContent.trim().toLowerCase(); // Get the full name text
    
                // Check if the full name matches the search term
                if (fullName.includes(searchTerm)) {
                    row.style.display = ""; // Show row if search term is found
                } else {
                    row.style.display = "none"; // Hide row if no match
                }
            });
        });
    });



    function openEditModal(data) {
        document.getElementById("editStaffId").value = data.dataset.id;
        document.getElementById("editFullName").value = data.dataset.name;
        document.getElementById("editEmpNo").value = data.dataset.emp_no;
        document.getElementById("editRegNo").value = data.dataset.reg_no;
        document.getElementById("editDesignation").value = data.dataset.designation;
        document.getElementById("editDateOfAppointment").value = data.dataset.appointment_date;
        document.getElementById("editNic").value = data.dataset.nic;
        document.getElementById("editDob").value = data.dataset.dob;
        document.getElementById("editContactNumber").value = data.dataset.phone;
        document.getElementById("editAddress").value = data.dataset.address;
        document.getElementById("editStaffType").value = data.dataset.type;

        editModal.style.display = "block";
    }

    function deleteStaff(data) {
        if (confirm("Are you sure you want to delete this staff member?")) {
            window.location.href = `groundindoorstaff/deleteStaff/${data.dataset.id}`;
        }
    }

    function deletePedStaff(data) {
        if (confirm("Are you sure you want to delete this staff member?")) {
            window.location.href = `ped_staff/deleteStaff/${data.dataset.id}`;
        }
    }

