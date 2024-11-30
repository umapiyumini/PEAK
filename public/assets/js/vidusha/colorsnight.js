let editingRow = null;

        // Open modal for adding/editing student
        function openModal(isEdit = false, row = null) {
            const modal = document.getElementById('studentModal');
            const form = document.getElementById('studentForm');

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
            } else {
                document.getElementById('modalTitle').textContent = "Add Student Details";
                form.reset();
                editingRow = null;
            }

            modal.style.display = 'block';
        }

        // Close modal
        function closeModal() {
            document.getElementById('studentModal').style.display = 'none';
        }

        // Save student details
        function saveStudent() {
            const name = document.getElementById('studentName').value;
            const regNo = document.getElementById('registrationNumber').value;
            const performance = document.getElementById('interUniPerformance').value;
            const awards = document.getElementById('awards').value;
            const rewards = document.getElementById('rewards').value;
            const meritAwards = document.getElementById('meritawards').value;
            const details = document.getElementById('details').value;

            if (name && regNo) {
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
            } else {
                alert('Please fill in required fields.');
            }
        }

        // Remove a row from the table
        function removeRow(button) {
            button.parentElement.parentElement.remove();
        }