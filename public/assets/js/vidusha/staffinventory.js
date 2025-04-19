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
        document.getElementById('updateid').value = id;
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
});
