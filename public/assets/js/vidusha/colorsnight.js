// Set today's date
document.addEventListener("DOMContentLoaded", function () {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById("todayDate").value = today;
});

// Open modal
function openModal() {
    document.getElementById("studentModal").style.display = "block";
    document.getElementById("studentForm").reset();
    document.getElementById("editIndex").value = "";
}

// Close modal
function closeModal() {
    document.getElementById("studentModal").style.display = "none";
}

// Save student to table
function saveStudent() {
    const name = document.getElementById("studentName").value;
    const regNo = document.getElementById("registrationNumber").value;
    const performance = document.getElementById("interUniPerformance").value;
    const awards = document.getElementById("awards").value;
    const rewards = document.getElementById("rewards").value;
    const merit = document.getElementById("meritawards").value;
    const details = document.getElementById("details").value;
    const index = document.getElementById("editIndex").value;

    const tbody = document.getElementById("studentDetailsBody");

    if (index) {
        const row = tbody.children[index];
        row.innerHTML = getRowHTML(name, regNo, performance, awards, rewards, merit, details, index);
    } else {
        const newRow = document.createElement("tr");
        const newIndex = tbody.children.length;
        newRow.innerHTML = getRowHTML(name, regNo, performance, awards, rewards, merit, details, newIndex);
        tbody.appendChild(newRow);
    }

    closeModal();
}

// Create row HTML
function getRowHTML(name, regNo, performance, awards, rewards, merit, details, index) {
    return `
        <td><input type="hidden" name="students[${index}][name]" value="${name}">${name}</td>
        <td><input type="hidden" name="students[${index}][reg_no]" value="${regNo}">${regNo}</td>
        <td><input type="hidden" name="students[${index}][performance]" value="${performance}">${performance}</td>
        <td><input type="hidden" name="students[${index}][awards]" value="${awards}">${awards}</td>
        <td><input type="hidden" name="students[${index}][rewards]" value="${rewards}">${rewards}</td>
        <td><input type="hidden" name="students[${index}][merit]" value="${merit}">${merit}</td>
        <td><input type="hidden" name="students[${index}][details]" value="${details}">${details}</td>
        <td>
            <button type="button" onclick="editStudent(${index})">Edit</button>
            <button type="button" onclick="deleteStudent(this)">Delete</button>
        </td>
    `;
}

// Edit student
function editStudent(index) {
    const row = document.getElementById("studentDetailsBody").children[index];
    document.getElementById("studentName").value = row.children[0].textContent;
    document.getElementById("registrationNumber").value = row.children[1].textContent;
    document.getElementById("interUniPerformance").value = row.children[2].textContent;
    document.getElementById("awards").value = row.children[3].textContent;
    document.getElementById("rewards").value = row.children[4].textContent;
    document.getElementById("meritawards").value = row.children[5].textContent;
    document.getElementById("details").value = row.children[6].textContent;
    document.getElementById("editIndex").value = index;

    openModal();
}

// Delete student row
function deleteStudent(button) {
    const row = button.closest("tr");
    row.remove();
}
