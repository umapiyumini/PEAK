// DOM Elements
const addModal = document.getElementById('addModal');
const editModal = document.getElementById('editModal');
const addProductForm = document.getElementById('addProductForm');
const editForm = document.getElementById('editForm');
const inventoryTable = document.getElementById('inventoryTable');
const searchInput = document.getElementById('searchInput');

// Sample initial data
let inventoryData = [
    { id: 1, name: 'Running shoes', type: 'Team', quantity: 1, sport: 'Athletics', availability: 'Available', incharge: 'John Doe' },
    { id: 2, name: 'Shoes', type: 'Recreational', quantity: 1, sport: 'Badminton', availability: 'Available', incharge: 'Jane Smith' },
    { id: 3, name: 'Shoes', type: 'Team', quantity: 1, sport: 'Cricket', availability: 'Available', incharge: 'Mike Johnson' },
    { id: 4, name: 'Turf shoes', type: 'Team', quantity: 1, sport: 'Hockey', availability: 'Available', incharge: 'Sarah Connor' }
];

// Render table
function renderTable(data = inventoryData) {
    const tbody = document.querySelector('#inventoryTable tbody');
    tbody.innerHTML = '';

    data.forEach(product => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${product.name}</td>
            <td>${product.type}</td>
            <td>${product.quantity}</td>
            <td>${product.sport}</td>
            <td>
                <span class="availability-badge ${product.availability.toLowerCase().replace(' ', '-')}">
                    ${product.availability}
                </span>
            </td>
            <td>${product.incharge}</td>
            <td class="action-buttons">
                <button class="btn btn-update" onclick="openEditModal(${product.id})">
                    <i class="uil uil-edit"></i>
                </button>
                <button class="btn btn-delete" onclick="deleteProduct(${product.id})">
                    <i class="uil uil-trash-alt"></i>
                </button>
            </td>
        `;
        tbody.appendChild(tr);
    });
    
    updateInventoryCounters();
}

// Search functionality
searchInput.addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const filteredData = inventoryData.filter(product => 
        product.name.toLowerCase().includes(searchTerm) ||
        product.sport.toLowerCase().includes(searchTerm)
    );
    renderTable(filteredData);
});

// Update quantity in edit modal
function updateQuantityInModal(change) {
    const quantityInput = document.getElementById('editQuantity');
    const currentValue = parseInt(quantityInput.value) || 0;
    const newValue = currentValue + change;
    if (newValue >= 0) {
        quantityInput.value = newValue;
    }
}

// Modal functions
function openAddModal() {
    addModal.style.display = 'block';
}

function openEditModal(productId) {
    const product = inventoryData.find(p => p.id === productId);
    if (product) {
        document.getElementById('editProductId').value = product.id;
        document.getElementById('editProductName').value = product.name;
        document.getElementById('editType').value = product.type;
        document.getElementById('editSport').value = product.sport;
        document.getElementById('editAvailability').value = product.availability;
        document.getElementById('editIncharge').value = product.incharge;

        // Create quantity control container
        const quantityContainer = document.createElement('div');
        quantityContainer.className = 'quantity-control';
        quantityContainer.innerHTML = `
             <button type="button" class="quantity-btn decrease-btn" onclick="updateQuantityInModal(-1)">-</button>
            <input type="number" id="editQuantity" min="0" value="${product.quantity}" required>
             <button type="button" class="quantity-btn increase-btn" onclick="updateQuantityInModal(1)">+</button>
        `;

        // Replace existing quantity input with the new control
        const oldQuantityInput = document.getElementById('editQuantity');
        oldQuantityInput.parentElement.replaceChild(quantityContainer, oldQuantityInput);

        editModal.style.display = 'block';
    }
}

function closeModal(modalElement) {
    modalElement.style.display = 'none';
    // Reset the quantity input to original state when closing
    const quantityControl = document.querySelector('.quantity-control');
    if (quantityControl) {
        const originalInput = document.createElement('input');
        originalInput.type = 'number';
        originalInput.id = 'editQuantity';
        originalInput.min = '0';
        originalInput.required = true;
        quantityControl.parentElement.replaceChild(originalInput, quantityControl);
    }
}
// Delete product
function deleteProduct(productId) {
    if (confirm('Are you sure you want to delete this product?')) {
        inventoryData = inventoryData.filter(product => product.id !== productId);
        renderTable();
    }
}

// Form submissions
addProductForm.addEventListener('submit', function(e) {
    e.preventDefault();

    const newProduct = {
        id: Date.now(), // Generate unique ID
        name: document.getElementById('productName').value,
        type: document.getElementById('productType').value,
        quantity: parseInt(document.getElementById('productQuantity').value),
        sport: document.getElementById('productSport').value,
        availability: document.getElementById('productAvailability').value,
        incharge: document.getElementById('productIncharge').value,
    };

    inventoryData.push(newProduct);
    renderTable();
    closeModal(addModal);
    this.reset();
});

editForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const productId = parseInt(document.getElementById('editProductId').value);
    const type = document.getElementById('editType').value;
    const quantity = parseInt(document.getElementById('editQuantity').value);
    const availability = document.getElementById('editAvailability').value;
    const incharge = document.getElementById('editIncharge').value;

    inventoryData = inventoryData.map(product => {
        if (product.id === productId) {
            return {
                ...product,
                quantity: quantity,
                type: type,
                availability: availability,
                incharge: incharge, 
                
            };
        }
        return product;
    });

    renderTable();
    closeModal(editModal);
});

// Event listeners for modal controls
document.getElementById('openAddModal').addEventListener('click', openAddModal);

document.querySelectorAll('.modal .close').forEach(closeBtn => {
    closeBtn.onclick = function() {
        closeModal(this.closest('.modal'));
    };
});

document.querySelectorAll('.modal .btn-cancel').forEach(cancelBtn => {
    cancelBtn.onclick = function() {
        closeModal(this.closest('.modal'));
    };
});

window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        closeModal(event.target);
    }
};


// Initialize the table on page load
document.addEventListener('DOMContentLoaded', function() {
    renderTable();
});