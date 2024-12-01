document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.querySelector("#searchInput");
    const inventoryTableBody = document.querySelector("#inventoryTable tbody");

    // Function to filter and display rows based on search input
    function filterTable() {
        const filter = searchInput.value.toLowerCase();
        const rows = inventoryTableBody.querySelectorAll("tr");

        rows.forEach(row => {
            const productName = row.querySelector("td:first-child").textContent.toLowerCase();
            if (productName.includes(filter)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }





    // Event listener for search input
    searchInput.addEventListener("input", filterTable);
});





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

    
        
        

      






    // ==================================== EDIT ============================================


    
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



    // ---------------DELETE FUNCTION----------------
    
