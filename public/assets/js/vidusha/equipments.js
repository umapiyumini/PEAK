document.addEventListener("DOMContentLoaded", () => {
    const inventoryTableBody = document.querySelector("#inventoryTable tbody");

    // Inventory Data (For demonstration)
    const inventory = [
        { id: 1, name: "Weight Benches", quantity: 5, availability: "Available" },
        { id: 2, name: "Treadmills", quantity: 5, availability: "Available" },
        { id: 2, name: "Exercise Bikes", quantity: 3, availability: "Available" },
    ];

    // Populate Inventory Table
    function populateInventoryTable() {
        inventoryTableBody.innerHTML = ""; // Clear existing rows
        inventory.forEach((item) => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${item.name}</td>
                <td>${item.quantity}</td>
                <td>${item.availability}</td>
                <td>
                    <button class="update-btn" data-id="${item.id}">Update Quantity</button>
                </td>
            `;
            inventoryTableBody.appendChild(row);
        });
    }

    // Open Add Product Modal
    const addModal = document.getElementById("addModal");
    const openAddModalButton = document.getElementById("openAddModal");
    const closeAddModalButton = addModal.querySelector(".close");
    const addProductForm = document.getElementById("addProductForm");

    openAddModalButton.addEventListener("click", () => {
        addModal.style.display = "block";
    });

    closeAddModalButton.addEventListener("click", () => {
        addModal.style.display = "none";
    });

    // Handle Add Product Form Submission
    addProductForm.addEventListener("submit", (e) => {
        e.preventDefault();
        
        // Get form data
        const productName = document.getElementById("productName").value;
        const productQuantity = parseInt(document.getElementById("productQuantity").value);
        const additionalNotes = document.getElementById("additionalNotes").value;

        // Validate form inputs
        if (!productName || !productQuantity) {
            alert("Please fill out all required fields.");
            return;
        }

        
        // Reset the form and close the modal
        addProductForm.reset();
        addModal.style.display = "none";

        // Update inventory table
        populateInventoryTable();
    });

    // Open Update Quantity Modal
    const updateModal = document.getElementById("updateModal");
    const closeUpdateModalButton = updateModal.querySelector(".close");
    const updateQuantityForm = document.getElementById("updateQuantityForm");

    // Update Product Event Listener (bind to update buttons dynamically)
    inventoryTableBody.addEventListener("click", (e) => {
        if (e.target && e.target.classList.contains("update-btn")) {
            const productId = parseInt(e.target.dataset.id);
            const product = inventory.find(item => item.id === productId);

            // Populate Update Modal with current product data
            document.getElementById("updateProductName").value = product.name;
            document.getElementById("updateProductQuantity").value = product.quantity;
            document.getElementById("updateReason").value = "";

            // Open the update modal
            updateModal.style.display = "block";

            // Handle Update Quantity Form Submission
            updateQuantityForm.addEventListener("submit", (e) => {
                e.preventDefault();
                
                // Get updated data
                const newQuantity = parseInt(document.getElementById("updateProductQuantity").value);
                const reason = document.getElementById("updateReason").value;

                if (isNaN(newQuantity) || !reason) {
                    alert("Please provide a valid quantity and reason.");
                    return;
                }

                // Update the product quantity in inventory
                product.quantity = newQuantity;
                product.availability = newQuantity > 0 ? "In Stock" : "Out of Stock";

                // Close the modal
                updateModal.style.display = "none";

                // Reset the form
                updateQuantityForm.reset();

                // Update inventory table
                populateInventoryTable();
            });
        }
    });

    // Close Update Modal
    closeUpdateModalButton.addEventListener("click", () => {
        updateModal.style.display = "none";
    });

    // Close modal when clicking outside
    window.addEventListener("click", (e) => {
        if (e.target === addModal) {
            addModal.style.display = "none";
        }
        if (e.target === updateModal) {
            updateModal.style.display = "none";
        }
    });

    // Initialize the Inventory Table
    populateInventoryTable();
});
