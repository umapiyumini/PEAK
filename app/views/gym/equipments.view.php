<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Equipments</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/ped.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/equipments.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
<div class="main-content">
    <main>
        <section class="inventory-section">
            <div class="header">
                <h1>Gym Equipments</h1>
                <div class="inventory-controls">
                    <!-- <div class="search-bar">
                        <input type="text" id="searchInput" placeholder="Search ...">
                        <i class="uil uil-search"></i>
                    </div> -->
                    <button class="add-product-btn" id="openAddModal">
                        <i class="uil uil-plus"></i> Add equipment
                    </button>
                </div>
            </div>

            <div class="inventory-table">
                <h2>Items</h2>
                
                <table id="inventoryTable">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tbody>
    <?php if (!empty($data['gymequimentview'])): ?>
        <?php foreach ($data['gymequimentview'] as $equipment): ?>
            <tr>
                <td><?= htmlspecialchars($equipment->equipmentname) ?></td>
                <td><?= htmlspecialchars($equipment->quantity) ?></td>
                <td><?= htmlspecialchars($equipment->description) ?></td>
                <td>
                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this equipment?');">
                        <input type="hidden" name="delete_gymequipmentid" value="<?= $equipment->gymequipmentid ?>">
                        <button type="submit" class="delete-btn" >Delete</button>
                        <button type="button" class="edit-btn" onclick="openUpdateModal('<?= htmlspecialchars($equipment->gymequipmentid) ?>', '<?= htmlspecialchars($equipment->equipmentname) ?>', '<?= htmlspecialchars($equipment->quantity) ?>', '<?= htmlspecialchars($equipment->description) ?>')">
    Edit
</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="4">No equipment found.</td>
        </tr>
    <?php endif; ?>
</tbody>

                              
                    
                </table>
            </div>
        </section>
    </main>
</div>








<!-- ===================ADD MODAL=============== -->

       <!-- Add Product Modal -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Add Equipment</h2>
        <form id="addProductForm" action="equipments/addEquipment" method="POST">

            <div class="form-group">
                <label for="productName">Equipment Name:</label>
                <input type="text" id="productName" name="equipmentname" required>
            </div>
            <div class="form-group">
                <label for="productQuantity">Quantity:</label>
                <input type="number" id="productQuantity" name="quantity" min="1" required>
            </div>
            <div class="form-group">
                <label for="additionalNotes">Description</label>
                <textarea id="additionalNotes" name="description" rows="4" placeholder="Enter any additional notes"></textarea>
            </div>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
</div>


















<!-- ===================EDIT MODAL=============== -->
<div id="updateModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Update Quantity</h2>
        <form id="updateQuantityForm" action="equipments/editEquipment" method="POST">
            <div class="form-group">
                <!-- Hidden input to store the gymequipmentid -->
                <input type="hidden" id="updateid" name="gymequipmentid">

                <label for="updateProductName">Product Name:</label>
                <input type="text" id="updateProductName" name="editname" >
            </div>
            <div class="form-group">
                <label for="updateProductQuantity">New Quantity:</label>
                <input type="number" id="updateProductQuantity" name="editquantity" min="1" required>
            </div>
            <div class="form-group">
                <label for="updatedescription">Description</label>
                <textarea id="updatedescription" name="editdescription" rows="4" placeholder="Enter description here" required></textarea>
            </div>
            <button type="submit" class="submit-btn">Update</button>
        </form>
    </div>
</div>


   

    <script>
// Function to open the update modal and populate the fields with data
function openUpdateModal(id, name, quantity, description) {
    // Get modal elements
    const modal = document.getElementById('updateModal');
    const productNameInput = document.getElementById('updateProductName');
    const productQuantityInput = document.getElementById('updateProductQuantity');
    const descriptionInput = document.getElementById('updatedescription');
    const equipmentIdInput = document.getElementById('updateid');
    
    // Set the values for the modal fields
    productNameInput.value = name;
    productQuantityInput.value = quantity;
    descriptionInput.value = description; // Populate description field
    equipmentIdInput.value = id; // Set the hidden field with the equipment ID
    
    // Show the modal
    modal.style.display = 'flex'; // Or 'block' based on your preferred display method
}

// Close modal when close button is clicked
document.querySelectorAll('.close').forEach(closeButton => {
    closeButton.addEventListener('click', function() {
        const modal = this.closest('.modal');
        modal.style.display = 'none';
    });
});

// Close modal when clicking outside the modal content
window.addEventListener('click', function(event) {
    const modal = document.getElementById('updateModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});
        </script>
	<script src="<?=ROOT?>/assets/js/vidusha/equipments.js"></script>
	<script src="<?=ROOT?>/assets/js/vidusha/navbar.js"></script>
</body>
</html>

