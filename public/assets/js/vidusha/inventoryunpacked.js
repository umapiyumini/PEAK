document.addEventListener("DOMContentLoaded", () => {
    const inventoryTableBody = document.querySelector("#inventoryTable tbody");
    const updateModal = document.getElementById("updateModal");
    const closeUpdateModalButton = updateModal.querySelector(".close");
    const updateQuantityForm = document.getElementById("updateQuantityForm");

    // Attach event listener to update buttons dynamically
    document.addEventListener("click", (e) => {
        if (e.target && e.target.classList.contains("update-btn")) {
            const row = e.target.closest("tr");
            const productName = row.cells[0].innerText;
            const productQuantity = row.cells[1].innerText;

            document.getElementById("updateProductName").value = productName;
            document.getElementById("updateProductQuantity").value = productQuantity;

            updateModal.style.display = "block";
        }
    });

    // Close update modal
    closeUpdateModalButton.addEventListener("click", () => {
        updateModal.style.display = "none";
    });

    // Handle form submission without JavaScript (commented out AJAX to use PHP post method)
    // updateQuantityForm.addEventListener("submit", function(event) {
    //     return true; // Let PHP handle the form submission
    // });

    // Function to add a request to the Request Table
    function addRequestToTable(productName, quantity, timeFrame) {
        const requestTableBody = document.querySelector("#requestTable tbody");
        const row = document.createElement("tr");
        const currentDate = new Date().toLocaleDateString();

        row.innerHTML = `
            <td>${productName}</td>
            <td>${quantity}</td>
            <td>${timeFrame}</td>
            <td>${currentDate}</td>
            <td><button class="delete-request-btn">Delete</button></td>
        `;

        requestTableBody.appendChild(row);

        // Add delete functionality
        row.querySelector(".delete-request-btn").addEventListener("click", () => {
            row.remove();
        });

        // Fix button styles
        row.querySelector(".delete-request-btn").style.cssText = `
            background-color: #5a2e8a;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            width: 100%;
            transition: background-color 0.3s ease;
        `;
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

    // addProductForm.addEventListener("submit", (e) => {
    //     e.preventDefault();

    //     const productName = document.getElementById("productName").value;
    //     const productQuantity = parseInt(document.getElementById("productQuantity").value);
    //     const timeFrame = document.getElementById("timeFrame").value;

    //     if (!productName || isNaN(productQuantity)) {
    //         alert("Please fill out all required fields.");
    //         return;
    //     }

    //     // Add to the Request Table only, do not modify the Inventory Table
    //     addRequestToTable(productName, productQuantity, timeFrame);

    //     addProductForm.reset();
    //     addModal.style.display = "none";
    // });

    // Close modals when clicking outside
    window.addEventListener("click", (e) => {
        if (e.target === addModal) addModal.style.display = "none";
        if (e.target === updateModal) updateModal.style.display = "none";
    });

    // Handle Edit Button Clicks
    document.addEventListener("click", (e) => {
        if (e.target && e.target.classList.contains("edit-btn")) {
            const equipmentId = e.target.getAttribute("data-id");
            console.log(`Editing item with ID: ${equipmentId}`);
            // Add logic to edit the item
        }
    });
});
