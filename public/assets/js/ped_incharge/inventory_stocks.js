// Sample initial data
let packedStocks = [
    {
        id: 'EQ001',
        name: 'Sticks',
        sport: 'Hockey',
        indentNo: 'IN2024001',
        description: 'carbon sticks',
        unit: '1',
        quantity: 20,
        date: '2024-02-15'
    },
    {
        id: 'EQ002',
        name: 'Balls',
        sport: 'Hockey',
        indentNo: 'IN2024761',
        description: 'white balls',
        unit: '6',
        quantity: 20,
        date: '2024-02-15'
    },
    {
        id: 'EQ002',
        name: 'Balls',
        sport: 'Hockey',
        indentNo: 'IN267751',
        description: 'white balls',
        unit: '9',
        quantity: 20,
        date: '2024-05-15'
    },
    {
        id: 'EQ012',
        name: 'Basketballs',
        sport: 'Basketball',
        indentNo: 'IN267678',
        description: '',
        unit: '1',
        quantity: 20,
        date: '2024-02-15'
    },
    // Add more sample data as needed
];

// DOM Elements
const addModal = document.getElementById('addStockModal');
const addStockForm = document.getElementById('addStockForm');
const searchInput = document.getElementById('searchInput');
const packedStocksTable = document.getElementById('packedStocksTable');

// Initialize data from localStorage
function initializeData() {
    const storedData = localStorage.getItem('packedStocks');
    if (storedData) {
        packedStocks = JSON.parse(storedData);
    }
}

// Store data in localStorage
function storeData() {
    localStorage.setItem('packedStocks', JSON.stringify(packedStocks));
}

// Render table function
function renderTable(data = packedStocks) {
    const tbody = document.getElementById('packedStocksBody');
    tbody.innerHTML = '';

    data.forEach(stock => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${stock.id}</td>
            <td>${stock.name}</td>
            <td>${stock.sport}</td>
            <td>${stock.indentNo}</td>
            <td>${stock.description}</td>
            <td>${stock.unit}</td>
            <td>${stock.quantity}</td>
            <td>${stock.date}</td>
            <td class="action-buttons">
                <button class="btn btn-update" onclick="viewStock('${stock.id}')">
                    <i class="uil uil-edit"></i>
                </button>
                <button class="btn btn-delete" onclick="deleteStock('${stock.id}')">
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
    const filteredData = packedStocks.filter(stock => 
        stock.id.toLowerCase().includes(searchTerm) ||
        stock.name.toLowerCase().includes(searchTerm) ||
        stock.sport.toLowerCase().includes(searchTerm) ||
        stock.indentNo.toLowerCase().includes(searchTerm)
    );
    renderTable(filteredData);
}

// Modal functions
function openAddModal() {
    addStockForm.reset();
    addModal.style.display = 'block';
}

function closeModal() {
    addModal.style.display = 'none';
    addStockForm.reset();
}

// Add stock form submission
function handleAddStock(e) {
    e.preventDefault();
    
    const newStock = {
        id: document.getElementById('equipmentId').value,
        name: document.getElementById('name').value,
        sport: document.getElementById('sport').value,
        indentNo: document.getElementById('indentNo').value,
        description: document.getElementById('description').value,
        unit: document.getElementById('unit').value,
        quantity: parseInt(document.getElementById('quantity').value),
        date: document.getElementById('date').value
    };
    
    packedStocks.push(newStock);
    storeData();
    renderTable();
    closeModal();
}

// Delete stock function
function deleteStock(stockId) {
    if (confirm('Are you sure you want to delete this stock?')) {
        packedStocks = packedStocks.filter(stock => stock.id !== stockId);
        storeData();
        renderTable();
    }
}

// View stock function
function viewStock(stockId) {
    const stock = packedStocks.find(s => s.id === stockId);
    if (stock) {
        // You can implement a view modal or redirect to a details page
        alert(`Viewing stock: ${stock.name}`);
    }
}

// Event listeners
document.addEventListener('DOMContentLoaded', () => {
    initializeData();
    renderTable();
    
    // Search input
    searchInput.addEventListener('input', handleSearch);
    
    // Add stock form
    addStockForm.addEventListener('submit', handleAddStock);
    
    // Add stock button
    document.getElementById('openAddModal').addEventListener('click', openAddModal);
    
    // Close button
    document.querySelector('.close').addEventListener('click', closeModal);
    
    // Close modal when clicking outside
    window.addEventListener('click', (event) => {
        if (event.target === addModal) {
            closeModal();
        }
    });
    
    // Cancel button
    document.querySelector('.btn btn-cancel').addEventListener('click', closeModal);
});