// DOM Elements
const addModal = document.getElementById('addModal');
const editModal = document.getElementById('editModal');
const addStaffForm = document.getElementById('addStaffForm');
const editStaffForm = document.getElementById('editStaffForm');
const searchInput = document.getElementById('searchInput');

// Sample initial data
let staffData = [
    {
        id: 1,
        customerId: 'GS001',
        fullName: 'N.D Senarathne',
        empNo: 'EMP001',
        regNo: 'REG001',
        designation: 'Ground Keeper',
        dateOfAppointment: '2023-01-15',
        nic: '891234567V',
        dob: '1989-05-20',
        contactNumber: '0771234567',
        address: '123 Main St, Colombo'
    },
    {
        id: 2,
        customerId: 'GS002',
        fullName: 'L.H Hewage',
        empNo: 'EMP002',
        regNo: 'REG002',
        designation: 'Indoor Staff',
        dateOfAppointment: '2023-02-20',
        nic: '901234567V',
        dob: '1990-08-15',
        contactNumber: '0777654321',
        address: '456 Park Ave, Kandy'
    }
];

// Render table function
function renderTable(data = staffData) {
    const tbody = document.querySelector('#groundStaffTable tbody');
    tbody.innerHTML = '';

    data.forEach(staff => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${staff.customerId}</td>
            <td>${staff.fullName}</td>
            <td>${staff.empNo}</td>
            <td>${staff.regNo}</td>
            <td>${staff.designation}</td>
            <td>${staff.dateOfAppointment}</td>
            <td>${staff.nic}</td>
            <td>${staff.dob}</td>
            <td>${staff.contactNumber}</td>
            <td>${staff.address}</td>
            <td class="action-buttons">
                <button class="btn btn-update" onclick="openEditModal(${staff.id})">
                    <i class="uil uil-edit"></i>
                </button>
                <button class="btn btn-delete" onclick="deleteStaff(${staff.id})">
                    <i class="uil uil-trash-alt"></i>
                </button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

// Search functionality
function handleSearch(e) {
    const searchTerm = e.target.value.toLowerCase();
    const filteredData = staffData.filter(staff => 
        staff.fullName.toLowerCase().includes(searchTerm) ||
        staff.empNo.toLowerCase().includes(searchTerm) ||
        staff.regNo.toLowerCase().includes(searchTerm) ||
        staff.designation.toLowerCase().includes(searchTerm)
    );
    renderTable(filteredData);
}

// Generate Customer ID
function generateCustomerId() {
    const lastStaff = staffData[staffData.length - 1];
    if (!lastStaff) return 'GS001';
    
    const lastId = parseInt(lastStaff.customerId.slice(2));
    return `GS${String(lastId + 1).padStart(3, '0')}`;
}

// Add staff form submission
function handleAddStaff(e) {
    e.preventDefault();
    
    const newStaff = {
        id: Date.now(),
        customerId: generateCustomerId(),
        fullName: document.getElementById('fullName').value,
        empNo: document.getElementById('empNo').value,
        regNo: document.getElementById('regNo').value,
        designation: document.getElementById('designation').value,
        dateOfAppointment: document.getElementById('dateOfAppointment').value,
        nic: document.getElementById('nic').value,
        dob: document.getElementById('dob').value,
        contactNumber: document.getElementById('contactNumber').value,
        address: document.getElementById('address').value
    };
    
    staffData.push(newStaff);
    renderTable();
    storeData();
    closeModal(addModal);
    addStaffForm.reset();
}

// Open edit modal
function openEditModal(staffId) {
    const staff = staffData.find(s => s.id === staffId);
    if (!staff) return;

    document.getElementById('editStaffId').value = staff.id;
    document.getElementById('editFullName').value = staff.fullName;
    document.getElementById('editEmpNo').value = staff.empNo;
    document.getElementById('editRegNo').value = staff.regNo;
    document.getElementById('editDesignation').value = staff.designation;
    document.getElementById('editDateOfAppointment').value = staff.dateOfAppointment;
    document.getElementById('editNic').value = staff.nic;
    document.getElementById('editDob').value = staff.dob;
    document.getElementById('editContactNumber').value = staff.contactNumber;
    document.getElementById('editAddress').value = staff.address;

    editModal.style.display = 'block';
}

// Handle edit form submission
function handleEditStaff(e) {
    e.preventDefault();
    
    const staffId = parseInt(document.getElementById('editStaffId').value);
    const staffIndex = staffData.findIndex(s => s.id === staffId);
    
    if (staffIndex === -1) return;

    staffData[staffIndex] = {
        ...staffData[staffIndex],
        fullName: document.getElementById('editFullName').value,
        empNo: document.getElementById('editEmpNo').value,
        regNo: document.getElementById('editRegNo').value,
        designation: document.getElementById('editDesignation').value,
        dateOfAppointment: document.getElementById('editDateOfAppointment').value,
        nic: document.getElementById('editNic').value,
        dob: document.getElementById('editDob').value,
        contactNumber: document.getElementById('editContactNumber').value,
        address: document.getElementById('editAddress').value
    };

    renderTable();
    storeData();
    closeModal(editModal);
}

// Delete staff function
function deleteStaff(staffId) {
    if (confirm('Are you sure you want to delete this staff member?')) {
        staffData = staffData.filter(staff => staff.id !== staffId);
        renderTable();
        storeData();
    }
}

// Modal functions
function closeModal(modal) {
    modal.style.display = 'none';
    if (modal === addModal) {
        addStaffForm.reset();
    }
}

// Store data in localStorage
function storeData() {
    localStorage.setItem('groundStaffData', JSON.stringify(staffData));
}

// Initialize data from localStorage
function initializeData() {
    const storedData = localStorage.getItem('groundStaffData');
    if (storedData) {
        staffData = JSON.parse(storedData);
    }
}

// Event listeners
document.addEventListener('DOMContentLoaded', () => {
    initializeData();
    renderTable();
    
    // Search input
    searchInput.addEventListener('input', handleSearch);
    
    // Add staff form
    addStaffForm.addEventListener('submit', handleAddStaff);
    
    // Edit staff form
    editStaffForm.addEventListener('submit', handleEditStaff);
    
    // Add staff button
    const openAddModalBtn = document.getElementById('openAddModal');
    if (openAddModalBtn) {
        openAddModalBtn.addEventListener('click', () => addModal.style.display = 'block');
    }
    
    // Close buttons
    document.querySelectorAll('.modal .close').forEach(closeBtn => {
        closeBtn.addEventListener('click', () => closeModal(closeBtn.closest('.modal')));
    });
    
    // Cancel buttons
    document.querySelectorAll('.modal .btn-cancel').forEach(cancelBtn => {
        cancelBtn.addEventListener('click', () => closeModal(cancelBtn.closest('.modal')));
    });
    
    // Close modal when clicking outside
    window.addEventListener('click', (event) => {
        if (event.target.classList.contains('modal')) {
            closeModal(event.target);
        }
    });
});


//todo list
let tasks = JSON.parse(localStorage.getItem('tasks')) || [];

function addTask() {
    const taskName = document.getElementById('taskName').value;
    const assignDate = document.getElementById('assignDate').value;
    const assignTime = document.getElementById('assignTime').value;
    const deadline = document.getElementById('deadline').value;
    const description = document.getElementById('description').value;

    if (!taskName || !assignDate || !assignTime || !deadline) {
        alert('Please fill in all required fields');
        return;
    }

    const task = {
        id: Date.now(),
        name: taskName,
        assignDate,
        assignTime,
        deadline,
        description,
        status: 'pending'
    };

    tasks.push(task);
    saveTasks();
    displayTasks();
    clearForm();
}

function toggleStatus(taskId) {
    const task = tasks.find(t => t.id === taskId);
    if (task) {
        task.status = task.status === 'pending' ? 'completed' : 'pending';
        saveTasks();
        displayTasks();
    }
}

function deleteTask(taskId) {
    tasks = tasks.filter(task => task.id !== taskId);
    saveTasks();
    displayTasks();
}

function filterTasks() {
    const filterValue = document.getElementById('filterStatus').value;
    displayTasks(filterValue);
}

function displayTasks(filter = 'all') {
    const taskList = document.getElementById('taskList');
    // taskList.innerHTML = '<h2>Assigned Tasks</h2>';

    let filteredTasks = tasks;
    if (filter !== 'all') {
        filteredTasks = tasks.filter(task => task.status === filter);
    }

    filteredTasks.forEach(task => {
        const taskElement = document.createElement('div');
        taskElement.className = 'task-item';
        taskElement.innerHTML = `
            <div class="task-info">
                <h3>${task.name}</h3>
                <p><strong>Assign Date:</strong> ${task.assignDate} at ${task.assignTime}</p>
                <p><strong>Deadline:</strong> ${new Date(task.deadline).toLocaleString()}</p>
                <p><strong>Description:</strong> ${task.description}</p>
                <p><strong>Status:</strong> <span class="status-${task.status}">${task.status}</span></p>
            </div>
            <div>
                <button class="btn btn-mark" onclick="toggleStatus(${task.id})">${task.status === 'pending' ? 'Mark Complete' : 'Mark Pending'}</button>
                <button class="btn btn-delete" onclick="deleteTask(${task.id})">Delete</button>
            </div>
        `;
        taskList.appendChild(taskElement);
    });
}

function saveTasks() {
    localStorage.setItem('tasks', JSON.stringify(tasks));
}

function clearForm() {
    document.getElementById('taskName').value = '';
    document.getElementById('assignDate').value = '';
    document.getElementById('assignTime').value = '';
    document.getElementById('deadline').value = '';
    document.getElementById('description').value = '';
}

// Initial display
displayTasks();