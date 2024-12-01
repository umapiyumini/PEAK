// DOM Elements
const addModal = document.getElementById('addModal');
const addProductForm = document.getElementById('addProductForm');
// const editModal = document.getElementById('editModal');
// const editProductForm = document.getElementById('editProductForm');
const searchInput = document.getElementById('searchInput');
const inventoryTableTeam = document.getElementById('inventoryTableTeam');
const inventoryTableRecreational = document.getElementById('inventoryTableRecreational');

// Track current active inventory type
let currentInventoryType = 'team';

// Function to switch between inventory types
function switchInventoryType(type) {
    const teamTable = document.querySelector('.inventory-table-team');
    const recTable = document.querySelector('.inventory-table-recreational');
    const teamButton = document.querySelector('.team');
    const recButton = document.querySelector('.recreational');

    if (type === 'team') {
        teamTable.style.display = 'block';
        recTable.style.display = 'none';
        teamButton.classList.add('active');
        recButton.classList.remove('active');
        currentInventoryType = 'team';
        // renderTable(inventoryDataTeam, 'team');
    } else {
        teamTable.style.display = 'none';
        recTable.style.display = 'block';
        teamButton.classList.remove('active');
        recButton.classList.add('active');
        currentInventoryType = 'recreational';
        // renderTable(inventoryDataRecreational, 'recreational');
    }
}


// Event listeners
document.addEventListener('DOMContentLoaded', () => {
    // initializeData();
    
    // Set initial view
    switchInventoryType('team');
    
    // Add click handlers for inventory type switching
    document.querySelector('.team').addEventListener('click', () => switchInventoryType('team'));
    document.querySelector('.recreational').addEventListener('click', () => switchInventoryType('recreational'));
    
    // Search input
    // searchInput.addEventListener('input', handleSearch);
    
    // Add product form
    // addProductForm.addEventListener('submit', handleAddProduct);
    
    // Add product button
    const openAddModalBtn = document.getElementById('openAddModal');
    if (openAddModalBtn) {
        openAddModalBtn.addEventListener('click', () => addModal.style.display = 'block');
    }

    // edit product button
    // const openEditModalBtn = document.getElementById('openEditModal');
    // if (openEditModalBtn) {
    //     openEditModalBtn.addEventListener('click', () => editModal.style.display = 'block');
    // }
    
    // Close buttons
    document.querySelectorAll('.modal .close').forEach(closeBtn => {
        closeBtn.addEventListener('click', () => closeBtn.closest('.modal').style.display = 'none');
    });
    
    // Cancel buttons
    document.querySelectorAll('.modal .btn-cancel').forEach(cancelBtn => {
        cancelBtn.addEventListener('click', () => cancelBtn.closest('.modal').style.display = 'none');
    });
    
    // Close modal when clicking outside
    window.addEventListener('click', (event) => {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = 'none';
        }
    });
});


//   inventory requests
  // Sample data
  let requests = [
    {
        id: 'REQ001',
        type: 'Team',
        sport: 'BasketBall',
        equipment: 'Basketball',
        quantity: 5,
        status: 'pending'
      
    },
    {
        id: 'REQ002',
        type: 'Recreational',
        sport: 'Table Tennis',
        equipment: 'Table Tennis Bats',
        quantity: 10,
        status: 'issued'
       
    },
    {
        id: 'REQ003',
        type: 'Team',
        sport: 'Cricket',
        equipment: 'Cricket Bats',
        quantity: 8,
        status: 'pending'
    }
];

// Update statistics
// function updateStats() {
//     document.getElementById('pending-count').textContent = 
//         requests.filter(r => r.status === 'pending').length;
//     document.getElementById('approved-count').textContent = 
//         requests.filter(r => r.status === 'approved').length;
//     document.getElementById('rejected-count').textContent = 
//         requests.filter(r => r.status === 'rejected').length;
// }

// Render requests table
function renderRequests(filtered = requests) {
    const tbody = document.getElementById('requests-body');
    tbody.innerHTML = '';

    filtered.forEach(request => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${request.id}</td>
            <td>${request.type}</td>
            <td>${request.sport}</td>
            <td>${request.equipment}</td>
            <td>${request.quantity}</td>
            <td><span class="status-badge status-${request.status}">${request.status}</span></td>
            <td>
                ${request.status === 'pending' ? `
                    <button class="btn btn-approve" onclick="updateRequest('${request.id}', 'approved')">Approve</button>
                    <button class="btn btn-reject" onclick="updateRequest('${request.id}', 'rejected')">Reject</button>
                ` : request.status === 'approved' ? `
                    <button class="btn btn-issue" onclick="updateRequest('${request.id}', 'issued')">Issue</button>
                ` : ''}
            </td>
        `;
        tbody.appendChild(tr);
    });
}

// Update request status
function updateRequest(id, status) {
    const request = requests.find(r => r.id === id);
    if (request) {
        request.status = status;
        updateStats();
        renderRequests();
        
        // Save to localStorage
        localStorage.setItem('requests', JSON.stringify(requests));
    }
}

// Filter functionality
// document.getElementById('search-requests').addEventListener('input', filterRequests);
document.getElementById('status-filter').addEventListener('change', filterRequests);
// document.getElementById('request-type').addEventListener('change', filterRequests);

function filterRequests() {
    const searchTerm = document.getElementById('search-requests').value.toLowerCase();
    const statusFilter = document.getElementById('status-filter').value;
    const typeFilter = document.getElementById('request-type').value;

    const filtered = requests.filter(request => {
        const matchesSearch = 
            request.requester.toLowerCase().includes(searchTerm) ||
            request.equipment.toLowerCase().includes(searchTerm) ||
            request.id.toLowerCase().includes(searchTerm);
        
        const matchesStatus = statusFilter === 'all' || request.status === statusFilter;
        const matchesType = typeFilter === 'all' || request.type === typeFilter;

        return matchesSearch && matchesStatus && matchesType;
    });

    renderRequests(filtered);
}

// Load saved data from localStorage
function loadSavedData() {
    const savedRequests = localStorage.getItem('requests');
    if (savedRequests) {
        requests = JSON.parse(savedRequests);
    }
}

// Initial load
// loadSavedData();
// updateStats();
// renderRequests();




// Year-end requests data
let yearEndRequests = [
    { id: 1, item: 'Hockey Sticks', requiredQuantity: 10, remarks: 'Need replacement for worn out sticks' },
    { id: 2, item: 'Hockey Balls', requiredQuantity: 24, remarks: 'For practice sessions' },
    { id: 3, item: 'Goalkeeper Kit', requiredQuantity: 2, remarks: 'Current kit is damaged' },
    { id: 4, item: 'Training Cones', requiredQuantity: 30, remarks: 'For drills setup' }
];

// Function to render year-end table
function renderYearEndTable() {
    const tbody = document.getElementById('yearend-body');
    if (!tbody) return; // Guard clause if element doesn't exist

    tbody.innerHTML = '';

    yearEndRequests.forEach((request, index) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${index + 1}</td>
            <td>${request.item}</td>
            <td>${request.requiredQuantity}</td>
            <td>${request.remarks}</td>
        `;
        tbody.appendChild(tr);
    });
}

// Function to store year-end data in localStorage
function storeYearEndData() {
    localStorage.setItem('yearEndRequests', JSON.stringify(yearEndRequests));
}

// Function to load year-end data from localStorage
function loadYearEndData() {
    const savedData = localStorage.getItem('yearEndRequests');
    if (savedData) {
        yearEndRequests = JSON.parse(savedData);
    }
    return yearEndRequests;
}

// Function to handle save button click
function handleYearEndSave() {
    storeYearEndData();
    alert('Year-end entries saved successfully!');
}

// Function to handle reject button click
function handleYearEndReject() {
    if (confirm('Are you sure you want to reject all year-end entries?')) {
        yearEndRequests = [];
        renderYearEndTable();
        storeYearEndData();
        alert('Year-end entries rejected!');
    }
}

// Initialize year-end functionality
function initializeYearEnd() {
    const yearEndTable = document.getElementById('yearend-body');
    if (!yearEndTable) return; // Only run on year-end page

    // Load saved data
    loadYearEndData();
    
    // Render the table
    renderYearEndTable();

    // Add event listeners to buttons
    const saveButton = document.querySelector('.btn-save');
    const rejectButton = document.querySelector('.btn-reject');

    if (saveButton) {
        saveButton.addEventListener('click', handleYearEndSave);
    }
    if (rejectButton) {
        rejectButton.addEventListener('click', handleYearEndReject);
    }
}

// Add to your DOMContentLoaded event listener
document.addEventListener('DOMContentLoaded', () => {
    // Initialize year-end functionality
    initializeYearEnd();
});



