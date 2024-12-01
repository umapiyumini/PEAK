let editingRow = null;

// Open modal for adding/editing student
function openModal(isEdit = false, row = null) {
    const modal = document.getElementById('studentModal');
    const form = document.getElementById('studentForm');
    const todayDateField = document.getElementById('todayDate');

    // Set today's date for todayDate field
    const today = new Date().toISOString().split('T')[0];
    todayDateField.value = today;


    if (isEdit && row) {
        document.getElementById('modalTitle').textContent = "Edit Student Details";
        editingRow = row;

        // Populate modal form with row data
        document.getElementById('studentName').value = row.cells[0].textContent;
        document.getElementById('registrationNumber').value = row.cells[1].textContent;
        document.getElementById('interUniPerformance').value = row.cells[2].textContent;
        document.getElementById('awards').value = row.cells[3].textContent;
        document.getElementById('rewards').value = row.cells[4].textContent;
        document.getElementById('meritawards').value = row.cells[5].textContent;
        document.getElementById('details').value = row.cells[6].textContent;
        todayDateField.value = row.cells[7].textContent; 
    } else {
        document.getElementById('modalTitle').textContent = "Add Student Details";
        form.reset();
        todayDateField.value = today;
        editingRow = null;
    }

    modal.style.display = 'block';
    document.getElementById('overlay').style.display = 'block'; // Show overlay
}

// Close modal
function closeModal() {
    document.getElementById('studentModal').style.display = 'none';
    document.getElementById('overlay').style.display = 'none'; // Hide overlay
}

// Save student details
function saveStudent() {
    const name = document.getElementById('studentName').value.trim();
    const regNo = document.getElementById('registrationNumber').value.trim();
    const performance = document.getElementById('interUniPerformance').value.trim();
    const awards = document.getElementById('awards').value.trim();
    const rewards = document.getElementById('rewards').value.trim();
    const meritAwards = document.getElementById('meritawards').value.trim();
    const details = document.getElementById('details').value.trim();
    

    if (!name || !regNo) {
        alert('Please fill in the required fields: Student Name and Registration Number.');
        return;
    }

    if (editingRow) {
        // Update existing row
        editingRow.cells[0].textContent = name;
        editingRow.cells[1].textContent = regNo;
        editingRow.cells[2].textContent = performance;
        editingRow.cells[3].textContent = awards;
        editingRow.cells[4].textContent = rewards;
        editingRow.cells[5].textContent = meritAwards;
        editingRow.cells[6].textContent = details;
        
    } else {
        // Add a new row
        const tableBody = document.getElementById('studentDetailsBody');
        const row = tableBody.insertRow();

        row.innerHTML = `
            <td>${name}</td>
            <td>${regNo}</td>
            <td>${performance}</td>
            <td>${awards}</td>
            <td>${rewards}</td>
            <td>${meritAwards}</td>
            <td>${details}</td>
            <td>
                <button type="button" onclick="openModal(true, this.parentElement.parentElement)">Edit</button>
                <button type="button" onclick="removeRow(this)">Remove</button>
            </td>
        `;
    }

    closeModal();
}

// Remove a row from the table
function removeRow(button) {
    if (confirm("Are you sure you want to remove this student?")) {
        button.parentElement.parentElement.remove();
    }
}
