document.addEventListener('DOMContentLoaded', () => {
    // ====== EDIT MODAL ======
    const editModal = document.getElementById('editModal');
    const closeModalBtn = document.getElementById('closeModal');
    const editForm = document.getElementById('editEquipmentForm');

    window.openEditModal = (button) => {
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const quantity = button.getAttribute('data-quantity');

        document.getElementById('equipmentId').value = id;
        //document.getElementById('updateid').value = id;
        document.getElementById('equipmentName').value = name;
        document.getElementById('quantity').value = quantity;

        editModal.style.display = 'block';
    };

    closeModalBtn.addEventListener('click', () => {
        editModal.style.display = 'none';
    });

    // Quantity control (edit modal)
    document.getElementById('addQty').addEventListener('click', () => {
        let qty = parseInt(document.getElementById('quantity').value);
        document.getElementById('quantity').value = qty + 1;
    });

    document.getElementById('subtractQty').addEventListener('click', () => {
        let qty = parseInt(document.getElementById('quantity').value);
        if (qty > 0) {
            document.getElementById('quantity').value = qty - 1;
        }
    });

    // ====== NEW REQUEST MODAL ======
    const newRequestModal = document.getElementById('newRequestModal');
    const addNewRequestBtn = document.getElementById('addNewRequestBtn');
    const closeRequestModalBtn = document.getElementById('closeRequestModal');

    addNewRequestBtn.addEventListener('click', () => {
        newRequestModal.style.display = 'block';
    });

    closeRequestModalBtn.addEventListener('click', () => {
        newRequestModal.style.display = 'none';
    });

    // Quantity control (new request)
    document.getElementById('addRequestQty').addEventListener('click', () => {
        let qty = parseInt(document.getElementById('requestQuantity').value);
        document.getElementById('requestQuantity').value = qty + 1;
    });

    document.getElementById('subtractRequestQty').addEventListener('click', () => {
        let qty = parseInt(document.getElementById('requestQuantity').value);
        if (qty > 1) {
            document.getElementById('requestQuantity').value = qty - 1;
        }
    });

    // ====== DELETE BUTTONS ======
    const deleteButtons = document.querySelectorAll('.deleteBtn');
    deleteButtons.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            const form = btn.closest('form');
            if (confirm('Are you sure you want to delete this request?')) {
                form.submit();
            } else {
                e.preventDefault();
            }
        });
    });

    // Optional: Close modals if user clicks outside modal content
    window.onclick = function (event) {
        if (event.target === editModal) {
            editModal.style.display = 'none';
        }
        if (event.target === newRequestModal) {
            newRequestModal.style.display = 'none';
        }
    };

    // ====== UPDATE REQUEST MODAL ======
const updateRequestModal = document.getElementById('updaterequestModel');
const updateButtons = document.querySelectorAll('.update-btn');
const closeUpdateModalBtn = document.querySelector('#updaterequestModel .close');

// Add event listeners to all update buttons
updateButtons.forEach(button => {
    button.addEventListener('click', () => {
        const requestId = button.getAttribute('data-id');
        
        // Find the parent row to get the current values
        const row = button.closest('tr');
        const name = row.cells[0].textContent.trim();
        const quantity = row.cells[1].textContent.trim();
        const date = row.cells[2].textContent.trim();
        
        // Set values in the update form
        document.getElementById('updateRequestId').value = requestId;
        document.getElementById('updaterequestProductName').value = name;
        document.getElementById('updaterequestQuantity').value = quantity;
        
        // Set the date in the correct format (YYYY-MM-DD)
        const formattedDate = formatDateForInput(date);
        document.getElementById('updaterequestDate').value = formattedDate;
        
        // Display the modal
        updateRequestModal.style.display = 'block';
    });
});

// Close update request modal when clicking the close button
closeUpdateModalBtn.addEventListener('click', () => {
    updateRequestModal.style.display = 'none';
});

// Helper function to format date for input field
function formatDateForInput(dateString) {
    // Try to parse the date string
    const date = new Date(dateString);
    
    // Check if the date is valid
    if (isNaN(date.getTime())) {
        // If invalid, return today's date
        const today = new Date();
        return `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, '0')}-${String(today.getDate()).padStart(2, '0')}`;
    }
    
    // Format as YYYY-MM-DD for input type="date"
    return `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`;
}

// Add form validation for update request form
document.getElementById('updateRequestForm').addEventListener('submit', (e) => {
    const quantity = document.getElementById('updaterequestQuantity').value;
    const name = document.getElementById('updaterequestProductName').value;
    const date = document.getElementById('updaterequestDate').value;
    
    if (!name || name.trim() === '') {
        alert('Please enter a valid product name');
        e.preventDefault();
        return false;
    }
    
    if (quantity <= 0) {
        alert('Please enter a valid quantity greater than 0');
        e.preventDefault();
        return false;
    }
    
    if (!date) {
        alert('Please select a valid date');
        e.preventDefault();
        return false;
    }
    
    return true;
});

// Close update modal if user clicks outside modal content
window.onclick = function(event) {
    if (event.target === editModal) {
        editModal.style.display = 'none';
    }
    if (event.target === newRequestModal) {
        newRequestModal.style.display = 'none';
    }
    if (event.target === updateRequestModal) {
        updateRequestModal.style.display = 'none';
    }
};

});
