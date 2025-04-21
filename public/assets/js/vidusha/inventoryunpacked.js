document.addEventListener("DOMContentLoaded", () => {
    const addModal = document.getElementById("addModal");
    const updateModal = document.getElementById("updateModal");
    const updateRequestModal = document.getElementById("updaterequestModel");

    const closeAddModalButton = addModal.querySelector(".close");
    const closeUpdateModalButton = updateModal.querySelector(".close");
    const closeUpdateRequestModalButton = updateRequestModal.querySelector(".close");

    document.getElementById("openAddModal").addEventListener("click", () => {
        addModal.style.display = "block";
    });

    closeAddModalButton.addEventListener("click", () => addModal.style.display = "none");
    closeUpdateModalButton.addEventListener("click", () => updateModal.style.display = "none");
    closeUpdateRequestModalButton.addEventListener("click", () => updateRequestModal.style.display = "none");

    window.addEventListener("click", (e) => {
        if (e.target === addModal) addModal.style.display = "none";
        if (e.target === updateModal) updateModal.style.display = "none";
        if (e.target === updateRequestModal) updateRequestModal.style.display = "none";
    });
});
    document.addEventListener("click", (e) => {
        if (e.target && e.target.classList.contains("update-btn")) {
            const row = e.target.closest("tr");
            const productName = row.cells[0].innerText.trim();
            const quantity = row.cells[1].innerText.trim();
            const equipmentId = e.target.getAttribute("data-id");
    
            document.getElementById("updateProductName").value = productName;
            document.getElementById("updateProductQuantity").value = quantity;
            document.getElementById("updateid").value = equipmentId;
    
            // You may add current date automatically
            const today = new Date().toISOString().split("T")[0];
            if (!document.getElementById("updateDate")) {
                const dateInput = document.createElement("input");
                dateInput.type = "hidden";
                dateInput.name = "date";
                dateInput.id = "updateDate";
                dateInput.value = today;
                document.getElementById("updateQuantityForm").appendChild(dateInput);
            } else {
                document.getElementById("updateDate").value = today;
            }
    
            updateModal.style.display = "block";
        }
    });
