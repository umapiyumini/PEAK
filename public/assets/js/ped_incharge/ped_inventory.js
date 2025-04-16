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

//function to switch between requests types

document.getElementById("mid").addEventListener("click", function() {
    let mid = document.getElementById("mid-section");
    let end = document.getElementById("end-section");
    mid.style.display = "block";
    end.style.display = "none";
});

document.getElementById("end").addEventListener("click", function() {
    let mid = document.getElementById("mid-section");
    let end = document.getElementById("end-section");
    mid.style.display = "none";
    end.style.display = "block";
});

document.getElementById("pendingBtn").addEventListener("click", function() {
    let reqcardlist = document.getElementById("request-card-list");
    let historylist = document.getElementById("history-list");
    let historybtn = document.getElementById("historyBtn");
    let pendingbtn = document.getElementById("pendingBtn");
    historybtn.style.opacity = 1;
    pendingbtn.style.opacity = 0.2;
    reqcardlist.style.display = "block";
    historylist.style.display = "none";
});

document.getElementById("historyBtn").addEventListener("click", function() {
    let reqcardlist = document.getElementById("request-card-list");
    let historylist = document.getElementById("history-list");
    let historybtn = document.getElementById("historyBtn");
    let pendingbtn = document.getElementById("pendingBtn");
    historybtn.style.opacity = 0.2;
    pendingbtn.style.opacity = 1;
    reqcardlist.style.display = "none";
    historylist.style.display = "block";
});

function openStockView(equipment) {
    window.location.href = `inventory_stocks/filterStocks/${equipment.equipmentid}`;
}

function openEditModal(equipment) {
    console.log('Equipment data:', equipment);
    // Populate form with equipment data
    document.getElementById('equipmentid').value = equipment.equipmentid; // Hidden input
    document.getElementById('editname').value = equipment.name; // Name field
    document.getElementById('editsport_id').value = equipment.sport_id; // Sport dropdown
    document.getElementById('edittype').value = equipment.type; // Type dropdown

    // Display the modal
    document.getElementById('editModal').style.display = 'block';
}

function deleteEquipment(equipment) {
    if (confirm('Are you sure you want to delete this equipment?')) {
        // Create the URL using the equipment ID
        window.location.href = `ped_inventory/deleteEquipment/${equipment.equipmentid}`;
    }
}

// Event listeners
document.addEventListener('DOMContentLoaded', () => {
    initializeYearEnd();
    
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

function acceptRequest(request) {
    if (confirm("Are you sure you want to accept this request?")) {
        window.location.href = `inventory_requests/updateStatus/${request.requestid}/Approved`;
    }
}

function deleteRequest(request) {
    if (confirm("Are you sure you want to delete this request?")) {
        window.location.href = `inventory_requests/deleteRequest/${request.requestid}`;
    }
}

document.getElementById('status-filter').addEventListener('change', filterRequests);


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
