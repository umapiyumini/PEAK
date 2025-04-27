document.addEventListener("DOMContentLoaded", () => {
    const addModal = document.getElementById("addModal");
    const updateModal = document.getElementById("updateModal");
    const updateRequestModal = document.getElementById("updaterequestModel");

    const closeAddModalButton = addModal.querySelector(".close");
    const closeUpdateModalButton = updateModal ? updateModal.querySelector(".close") : null;
    const closeUpdateRequestModalButton = updateRequestModal ? updateRequestModal.querySelector(".close") : null;

    // Open add modal button event
    const openAddModalBtn = document.getElementById("openAddModal");
    if (openAddModalBtn) {
        openAddModalBtn.addEventListener("click", () => {
            addModal.style.display = "block";
        });
    }

    // Close modal buttons
    if (closeAddModalButton) {
        closeAddModalButton.addEventListener("click", () => addModal.style.display = "none");
    }
    if (closeUpdateModalButton) {
        closeUpdateModalButton.addEventListener("click", () => updateModal.style.display = "none");
    }
    if (closeUpdateRequestModalButton) {
        closeUpdateRequestModalButton.addEventListener("click", () => updateRequestModal.style.display = "none");
    }

    // Close modals when clicking outside
    window.addEventListener("click", (e) => {
        if (e.target === addModal) addModal.style.display = "none";
        if (updateModal && e.target === updateModal) updateModal.style.display = "none";
        if (updateRequestModal && e.target === updateRequestModal) updateRequestModal.style.display = "none";
    });

    // Add equipment button functionality
    const addEquipmentBtn = document.getElementById("add-equipment-btn");
    if (addEquipmentBtn) {
        addEquipmentBtn.addEventListener("click", () => {
            const container = document.getElementById("equipment-container");
            const equipmentItems = container.querySelectorAll(".equipment-item");
            const newIndex = equipmentItems.length;
            
            // Create new equipment item
            const newItem = document.createElement("div");
            newItem.className = "equipment-item";
            newItem.innerHTML = `
                <div class="form-row">
                    <div class="form-group">
                        <label for="productName_${newIndex}">Product Name:</label>
                        <input type="text" id="productName_${newIndex}" name="name[]" required>
                    </div>
                    <div class="form-group">
                        <label for="productQuantity_${newIndex}">Quantity:</label>
                        <input type="number" id="productQuantity_${newIndex}" name="quantityrequested[]" min="1" required>
                    </div>
                    <button type="button" class="remove-equipment-btn">Remove</button>
                </div>
            `;
            
            container.appendChild(newItem);
            
            // Show remove buttons if there's more than one item
            if (equipmentItems.length > 0) {
                document.querySelectorAll(".remove-equipment-btn").forEach(btn => {
                    btn.style.display = "inline-block";
                });
            }
        });
    }

    // Handle removal of equipment items
    document.addEventListener("click", (e) => {
        if (e.target && e.target.classList.contains("remove-equipment-btn")) {
            const item = e.target.closest(".equipment-item");
            const container = document.getElementById("equipment-container");
            
            container.removeChild(item);
            
            // Hide remove button on the last item if only one remains
            const remainingItems = container.querySelectorAll(".equipment-item");
            if (remainingItems.length === 1) {
                remainingItems[0].querySelector(".remove-equipment-btn").style.display = "none";
            }
        }
    });

   // Handle Update Quantity button click
document.querySelectorAll(".update-quantity-btn").forEach(button => {
    button.addEventListener("click", () => {
        const id = button.getAttribute("data-id");
        const name = button.getAttribute("data-name");
        const quantity = button.getAttribute("data-quantity");

        document.getElementById("updateid").value = id;
        document.getElementById("updateProductName").value = name;
        document.getElementById("updateProductQuantity").value = quantity;

        updateModal.style.display = "block";
    });
});

// Handle Update Request button click
document.querySelectorAll(".update-request-btn").forEach(button => {
    button.addEventListener("click", () => {
        const id = button.getAttribute("data-id");
        const name = button.getAttribute("data-name");
        const quantity = button.getAttribute("data-quantity");
        const timeframe = button.getAttribute("data-timeframe");
        const date = button.getAttribute("data-date");

        document.getElementById("updateRequestId").value = id;
        document.getElementById("updaterequestProductName").value = name;
        document.getElementById("updaterequestQuantity").value = quantity;
        document.getElementById("updaterequesttimeframe").value = timeframe;
        document.getElementById("updaterequestDate").value = date;

        updateRequestModal.style.display = "block";
    });
});

    

    // Delete button confirmation
    const deleteButtons = document.querySelectorAll('.delete-btn');
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
});

// Function to show popup message
function showPopupMessage(message, type) {
    const popup = document.getElementById("popupMessage");
    const popupText = document.getElementById("popupText");

    // Set message and type (success or error)
    popupText.textContent = message;
    popup.classList.remove("hidden");
    popup.classList.add(type === "success" ? "success" : "error");

    // Auto-hide the popup after 3 seconds
    setTimeout(() => {
        popup.classList.add("hidden");
    }, 3000);
}

// Close popup manually
document.getElementById("closePopup").addEventListener("click", () => {
    const popup = document.getElementById("popupMessage");
    popup.classList.add("hidden");
});

// Example usage: Replace these with your actual success/error triggers
document.addEventListener("DOMContentLoaded", () => {
    // Simulate success message
   // Example: Replace this
// alert("Operation completed successfully!");

// With this
showPopupMessage("Operation completed successfully!", "success");

// Example: Replace this
// alert("An error occurred!");

// With this
showPopupMessage("An error occurred!", "error");
});