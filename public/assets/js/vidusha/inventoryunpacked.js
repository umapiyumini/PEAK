document.addEventListener("DOMContentLoaded", () => {
    // Inventory data (for demonstration)
    const inventory = [
        { id: 1, name: "Sticks", quantity: 10, availability: "In Stock", incharge: "John Doe" },
        { id: 2, name: "Skates", quantity: 5, availability: "Out of Stock", incharge: "Jane Smith" },
    ];

    const inventoryTableBody = document.querySelector("#inventoryTable tbody");
    const requestTableBody = document.querySelector("#RequestTable tbody");

    // Function to populate the Inventory Table
    function populateInventoryTable() {
        inventoryTableBody.innerHTML = ""; // Clear the table first
        inventory.forEach(item => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${item.name}</td>
                <td>${item.quantity}</td>
                <td>${item.availability}</td>
                <td>${item.incharge}</td>
                <td>
                    <button class="update-btn" data-id="${item.id}">Update Quantity</button>
                </td>
            `;
            inventoryTableBody.appendChild(row);
        });

        document.querySelectorAll('.update-btn').forEach(button => {
            
            button.style.backgroundCcolor='#5a2e8a';
            button.style.color=' #000';
            button.style.border='none';
            button.style.padding='10px 15px';
            button.style.borderRadius= '6px';
            button.style.cursor= 'pointer';
            button.style.fontSize= '12px';
            button.style.width= '100%';
            button.style.transition= 'background-color 0.3s ease';
        });
    }

    // Function to add a request to the Request Table
    function addRequestToTable(productName, quantity,timeFrame) {
        const row = document.createElement("tr");
        const currentDate = new Date().toLocaleDateString(); // Current date
        row.innerHTML = `
            <td>${productName}</td>
            <td>${quantity}</td>
            <td>${timeFrame}</td>
            <td>${currentDate}</td>
            <td><button class="delete-request-btn">Delete</button></td>
        `;
        requestTableBody.appendChild(row);

        // Add delete functionality to the new request
        row.querySelector(".delete-request-btn").addEventListener("click", () => {
            row.remove();
        });

        document.querySelectorAll('.delete-request-btn').forEach(button => {
            
            button.style.backgroundCcolor='#5a2e8a';
            button.style.color=' #000';
            button.style.border='none';
            button.style.padding='10px 15px';
            button.style.borderRadius= '6px';
            button.style.cursor= 'pointer';
            button.style.fontSize= '12px';
            button.style.width= '100%';
            button.style.transition= 'background-color 0.3s ease';
        });
    }

    // Add Product Modal Logic
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

    addProductForm.addEventListener("submit", (e) => {
        e.preventDefault();

        const productName = document.getElementById("productName").value;
        const productQuantity = parseInt(document.getElementById("productQuantity").value);
        const timeFrame = document.getElementById("timeFrame").value;

        if (!productName || isNaN(productQuantity)) {
            alert("Please fill out all required fields.");
            return;
        }

        // Add to the Request Table only, do not modify the Inventory Table
        addRequestToTable(productName, productQuantity,timeFrame);

        addProductForm.reset();
        addModal.style.display = "none";
    });

    // Update Quantity Modal Logic
    const updateModal = document.getElementById("updateModal");
    const closeUpdateModalButton = updateModal.querySelector(".close");
    const updateQuantityForm = document.getElementById("updateQuantityForm");

    inventoryTableBody.addEventListener("click", (e) => {
        if (e.target && e.target.classList.contains("update-btn")) {
            const productId = parseInt(e.target.dataset.id);
            const product = inventory.find(item => item.id === productId);

            // Populate update modal with product data
            document.getElementById("updateProductName").value = product.name;
            document.getElementById("updateProductQuantity").value = product.quantity;
            document.getElementById("updateReason").value = "";

            updateModal.style.display = "block";

            updateQuantityForm.onsubmit = (e) => {
                e.preventDefault();

                const newQuantity = parseInt(document.getElementById("updateProductQuantity").value);
                const reason = document.getElementById("updateReason").value;

                if (isNaN(newQuantity) || !reason.trim()) {
                    alert("Please provide a valid quantity and reason.");
                    return;
                }

                // Update product in the inventory
                product.quantity = newQuantity;
                product.availability = newQuantity > 0 ? "In Stock" : "Out of Stock";

                updateModal.style.display = "none";
                updateQuantityForm.reset();
                populateInventoryTable(); // Only update Inventory Table here
            };
        }
    });

    closeUpdateModalButton.addEventListener("click", () => {
        updateModal.style.display = "none";
    });

    window.addEventListener("click", (e) => {
        if (e.target === addModal) addModal.style.display = "none";
        if (e.target === updateModal) updateModal.style.display = "none";
    });

    populateInventoryTable();
});
