// DOM Elements
const addModal = document.getElementById('addModal');
const editModal = document.getElementById('editModal');
const editStudentForm = document.getElementById('editStudentForm');
const editModalClose = editModal.querySelector('.close');
const editModalCancel = editModal.querySelector('.btn-cancel');
const openAddModalBtn = document.getElementById('openAddModal');
const closeBtn = document.querySelector('.close');
const cancelBtn = document.querySelector('.btn-cancel');
const addStudentForm = document.getElementById('addStudentForm');
const addProductForm = document.getElementById('addStudentForm');
const editForm = document.getElementById('editForm');
const inventoryTable = document.getElementById('studentTable');
const searchInput = document.getElementById('searchInput');






// Search functionality
searchInput.addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const filteredData = studentData.filter(student => 
        student.name.toLowerCase().includes(searchTerm) ||
        student.reg_no.toLowerCase().includes(searchTerm) 
    );
    renderTable(filteredData);
});

//addmodal


// Function to open modal
function openModal() {
    addModal.style.display = 'block';
    // Reset form when opening
    addStudentForm.reset();
}

// Function to close modal
function closeModal() {
    addModal.style.display = 'none';
}

// Event listeners
openAddModalBtn.addEventListener('click', openModal);
closeBtn.addEventListener('click', closeModal);
cancelBtn.addEventListener('click', closeModal);

// Close modal when clicking outside
window.addEventListener('click', (event) => {
    if (event.target === addModal) {
        closeModal();
    }
});

// Handle form submission
addStudentForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    // Get form values
    const formData = {
        regNo: document.getElementById('studentRegNo').value,
        name: document.getElementById('studentName').value,
        faculty: document.getElementById('studentFaculty').value,
        regDate: document.getElementById('studentRegDate').value,
        expireDate: document.getElementById('studentExpireDate').value,
        birthDate: document.getElementById('studentBirthDate').value,
        nic: document.getElementById('studentNIC').value,
        email: document.getElementById('studentEmail').value,
        contact: document.getElementById('studentContact').value,
        gender: document.getElementById('studentGender').value,
        address: document.getElementById('studentAddress').value,
        sports: document.getElementById('studentSports').value,
        achievements: document.getElementById('studentAchievements').value
    };

    // Here you would typically send the data to your backend
    console.log('Form submitted with data:', formData);
    
    closeModal();
    
    // Optional: Add the new student to the table immediately
    addStudentToTable(formData);
});

// Function to add student to table
function addStudentToTable(student) {
    const tbody = document.querySelector('#studentTable tbody');
    const row = document.createElement('tr');
    
    row.innerHTML = `
        <td>${student.regNo}</td>
        <td>${student.name}</td>
        <td>${student.faculty}</td>
        <td>${student.gender}</td>
        <td class="action-buttons">
                <button class="btn btn-update" onclick="openEditModal(${student.id})">
                    <i class="uil uil-edit"></i>
                </button>
                <button class="btn btn-delete" onclick="deleteStudent(${student.id})">
                    <i class="uil uil-trash-alt"></i>
                </button>
                <button class="btn btn-view" onclick="viewStudent(${student.id})">
                <i class="uil uil-eye"></i>
                </button>
            </td>
    `;
    
    tbody.appendChild(row);
}

// Edit Modal functionality


// Function to open edit modal
function openEditModal(studentId) {
    const student = studentData.find(s => s.id === studentId);
    if (student) {
        // Populate form fields with student data
        document.getElementById('editStudentId').value = student.id;
        document.getElementById('editStudentRegNo').value = student.reg_no;
        document.getElementById('editStudentName').value = student.name;
        document.getElementById('editStudentFaculty').value = student.faculty;
        document.getElementById('editStudentGender').value = student.gender;
        document.getElementById('editStudentRegDate').value = student.regDate;
        document.getElementById('editStudentExpireDate').value = student.expireDate;
        document.getElementById('editStudentBirthDate').value = student.birthDate;
        document.getElementById('editStudentNIC').value = student.nic;
        document.getElementById('editStudentEmail').value = student.email;
        document.getElementById('editStudentContact').value = student.contact;
        document.getElementById('editStudentAddress').value = student.address;
        document.getElementById('editStudentSports').value = student.sports;
        document.getElementById('editStudentAchievements').value = student.achievements;
        

        editModal.style.display = 'block';
    }
}

// Function to close edit modal
function closeEditModal() {
    editModal.style.display = 'none';
    editStudentForm.reset();
}

// Event listeners for edit modal
editModalClose.addEventListener('click', closeEditModal);
editModalCancel.addEventListener('click', closeEditModal);

// Close modal when clicking outside
window.addEventListener('click', (event) => {
    if (event.target === editModal) {
        closeEditModal();
    }
});

// Handle edit form submission
editStudentForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const studentId = parseInt(document.getElementById('editStudentId').value);
    
    // Create updated student object
    const updatedStudent = {
        id: studentId,
        reg_no: document.getElementById('editStudentRegNo').value,
        name: document.getElementById('editStudentName').value,
        faculty: document.getElementById('editStudentFaculty').value,
        gender: document.getElementById('editStudentGender').value,   
        regDate: document.getElementById('editStudentRegDate').value,
        expireDate: document.getElementById('editStudentExpireDate').value,
        birthDate: document.getElementById('editStudentBirthDate').value,
        nic: document.getElementById('editStudentNIC').value,
        email: document.getElementById('editStudentEmail').value,
        contact: document.getElementById('editStudentContact').value,
        address: document.getElementById('editStudentAddress').value,
        sports: document.getElementById('editStudentSports').value,
        achievements: document.getElementById('editStudentAchievements').value
        
    };

    // Update studentData array
    studentData = studentData.map(student => 
        student.id === studentId ? updatedStudent : student
    );

    // Update table display
    renderTable();
    closeEditModal();
    
    // Show success message (optional)
    alert('Student information updated successfully!');
});
document.addEventListener('DOMContentLoaded', function() {
    renderTable();
});