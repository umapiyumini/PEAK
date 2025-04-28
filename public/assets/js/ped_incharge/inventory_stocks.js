
// DOM Elements
const addModal = document.getElementById('addStockModal');
const issueModal = document.getElementById('issueModal');
const addStockForm = document.getElementById('addStockForm');
const searchInput = document.getElementById('searchInput');
const packedStocksTable = document.getElementById('packedStocksTable');


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


function openIssueModal(stock) {
    document.getElementById('stockId').value = stock.stockid; 
    issueModal.style.display = 'block';
}


// Close modal functions

function closeIssueModal() {
    issueModal.style.display = 'none';
}


function closeModal() {
    addModal.style.display = 'none';
    addStockForm.reset();
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
        alert(`Viewing stock: ${stock.name}`);
    }
}

// Event listeners
document.addEventListener('DOMContentLoaded', () => {

    
    searchInput.addEventListener('input', handleSearch);
    

    
    document.getElementById('openAddModal').addEventListener('click', openAddModal);
    
    document.querySelector('.close').addEventListener('click', closeModal);
    
    // Close modal when clicking outside
    window.addEventListener('click', (event) => {
        if (event.target === addModal) {
            closeModal();
        }
    });
    

});