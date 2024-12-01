document.addEventListener('DOMContentLoaded', () => {
    const dateDisplay = document.getElementById('currentDate');
    const timeSlotsContainer = document.getElementById('timeSlots');
    const facilityDropdown = document.getElementById('facility');

    let currentDate = new Date(); // Start with today

    // Event listeners for navigation and dropdown
    document.getElementById('prevDate').addEventListener('click', () => changeDate(-1));
    document.getElementById('nextDate').addEventListener('click', () => changeDate(1));
    facilityDropdown.addEventListener('change', populateTimeSlots); // Populate after facility is selected

    function changeDate(days) {
        currentDate.setDate(currentDate.getDate() + days);
        updateDateDisplay();
        if (facilityDropdown.value) {
            populateTimeSlots(); // Populate only after a facility is selected
        }
    }

    function updateDateDisplay() {
        dateDisplay.textContent = currentDate.toDateString();
    }

    function populateTimeSlots() {
        if (!facilityDropdown.value) {
            return; // Do nothing if no facility is selected
        }

        timeSlotsContainer.innerHTML = ''; // Clear previous slots

        // Time slot ranges (excluding 12:00 PM - 2:00 PM)
        const timeRanges = [
            '8:00 AM - 10:00 AM',
            '10:00 AM - 12:00 PM',
            '2:00 PM - 4:00 PM',
            '4:00 PM - 6:00 PM'
        ];

        // Example reservation details by date and time
        const reservations = {
            '2024-11-24': { // Yesterday
                '10:00 AM - 12:00 PM': {
                    event: 'Basketball Practice',
                    type: 'Internal',
                    reservedBy: 'John Doe',
                    participants: 12
                }
            },
            '2024-11-25': { // Today
                '2:00 PM - 4:00 PM': {
                    event: 'Cricket Tournament',
                    type: 'External',
                    reservedBy: 'Jane Smith',
                    participants: 20
                }
            },
            '2024-11-26': { // Tomorrow
                '8:00 AM - 10:00 AM': {
                    event: 'Tennis Match',
                    type: 'Internal',
                    reservedBy: 'Chris Evans',
                    participants: 8
                }
            }
        };

        // Get reservations for the selected date
        const dateKey = currentDate.toISOString().split('T')[0];
        const dateReservations = reservations[dateKey] || {};

        // Populate time slots dynamically
        timeRanges.forEach(range => {
            const slotDiv = document.createElement('div');
            slotDiv.classList.add('time-slot');

            if (dateReservations[range]) {
                // Reserved slot
                slotDiv.classList.add('reserved-slot');
                const details = dateReservations[range];
                slotDiv.innerHTML = `
                    <strong>${range}</strong><br>
                    <em>${details.event}</em><br>
                    Type: ${details.type}<br>
                    Reserved by: ${details.reservedBy}<br>
                    Participants: ${details.participants}
                `;
            } else {
                // Available slot
                slotDiv.innerText = range;
            }

            timeSlotsContainer.appendChild(slotDiv);
        });
    }

    // Initialize
    updateDateDisplay();
});


// -------------to do list---------------
document.addEventListener('DOMContentLoaded', () => {
    const taskFilterSelect = document.getElementById('taskFilterSelect');
    const taskTableBody = document.querySelector('#taskTable tbody');

    // Example Data (can be replaced with actual backend data)
    let tasks = [
        { id: 1, task: 'Cleaning the Pavilion', dueDate: '2024-11-25', completed: false, completionTime: null, remarks: '', reason: '' },
        { id: 2, task: 'Drawing the Hockey Court', dueDate: '2024-11-27', completed: false, completionTime: null, remarks: '', reason: '' },
        { id: 3, task: 'Setup for Football Match', dueDate: '2024-11-29', completed: false, completionTime: null, remarks: '', reason: '' }
    ];

    // Render the Task Table
    function renderTasks() {
        taskTableBody.innerHTML = ''; // Clear existing rows
        const filteredTasks = filterTasks(tasks);

        filteredTasks.forEach(task => {
            const row = document.createElement('tr');

            // Task Name
            const taskCell = document.createElement('td');
            taskCell.textContent = task.task;
            row.appendChild(taskCell);

            // Due Date
            const dueDateCell = document.createElement('td');
            dueDateCell.textContent = task.dueDate;
            row.appendChild(dueDateCell);

            // Complete Checkbox + Early/Late Status
            const completeCell = document.createElement('td');
            const completeCheckbox = document.createElement('input');
            completeCheckbox.type = 'checkbox';
            completeCheckbox.classList.add('complete-checkbox');
            completeCheckbox.checked = task.completed;
            completeCheckbox.addEventListener('change', () => toggleTaskComplete(task.id));
            completeCell.appendChild(completeCheckbox);

            // Early/Late Status
            const earlyLateStatus = document.createElement('div');
            earlyLateStatus.classList.add('early-late-status');
            if (task.completed) {
                const currentDate = new Date();
                const dueDate = new Date(task.dueDate);
                const diffInTime = currentDate - dueDate;
                const diffInHours = diffInTime / (1000 * 3600);
                const lateStatus = diffInHours > 0 ? `Late by ${Math.round(diffInHours)} hours` : 'Completed Early';
                earlyLateStatus.textContent = lateStatus;
                earlyLateStatus.style.color = diffInHours > 0 ? 'red' : 'green';  // Red for late, green for early
            }
            completeCell.appendChild(earlyLateStatus);
            row.appendChild(completeCell);

            // Remarks
            const remarksCell = document.createElement('td');
            const remarksSelect = document.createElement('select');
            remarksSelect.classList.add('remarksSelect');
            const reasons = ['Completed successfully','Traffic', 'Personal Issues', 'Health Issues', 'Forgotten Deadline', 'Other'];
            reasons.forEach(reason => {
                const option = document.createElement('option');
                option.value = reason;
                option.textContent = reason;
                remarksSelect.appendChild(option);
            });
            remarksSelect.value = task.reason;
            remarksSelect.addEventListener('change', () => showRemarksField(task.id, remarksSelect.value));
            remarksCell.appendChild(remarksSelect);

            const remarksInput = document.createElement('textarea');
            remarksInput.classList.add('remarksTextArea');
            remarksInput.value = task.remarks;
            remarksInput.placeholder = 'Add remarks...';
            remarksInput.addEventListener('input', () => updateRemarks(task.id, remarksInput.value));

            const customRemarks = document.createElement('textarea');
            customRemarks.classList.add('customRemarks');
            customRemarks.placeholder = 'Type your reason here...';
            customRemarks.addEventListener('input', () => updateCustomRemarks(task.id, customRemarks.value));

            remarksCell.appendChild(remarksInput);  // This will be visible when "Other" is not selected
            remarksCell.appendChild(customRemarks); // This will be hidden until "Other" is selected
            row.appendChild(remarksCell);

            row.setAttribute('data-task-id', task.id);
            taskTableBody.appendChild(row);

            // Hide the regular remarks input initially
            remarksInput.style.display = 'none'; // Hide the regular remarks initially
            customRemarks.style.display = 'none'; // Ensure custom remarks are also hidden initially
        });
    }

    // Show remarks field based on selection
    function showRemarksField(taskId, selectedValue) {
        const task = tasks.find(t => t.id === taskId);
        const customRemarksField = document.querySelector(`#taskTable tbody tr[data-task-id='${taskId}'] .customRemarks`);
        const remarksInput = document.querySelector(`#taskTable tbody tr[data-task-id='${taskId}'] .remarksTextArea`);

        if (selectedValue === 'Other') {
            remarksInput.style.display = 'none';  // Hide the regular remarks field
            customRemarksField.style.display = 'block';  // Show the custom remarks field
        } else {
            remarksInput.style.display = 'none';  // Hide the regular remarks field
            customRemarksField.style.display = 'none';  // Hide the custom remarks field
        }

        task.reason = selectedValue;
    }

    // Filter Tasks
    function filterTasks(tasks) {
        const filterValue = taskFilterSelect.value;

        if (filterValue === 'completed') {
            return tasks.filter(task => task.completed);
        } else if (filterValue === 'notCompleted') {
            return tasks.filter(task => !task.completed);
        } else {
            return tasks;
        }
    }

    // Toggle Task Completion
    function toggleTaskComplete(taskId) {
        const task = tasks.find(t => t.id === taskId);
        task.completed = !task.completed;
        renderTasks();
    }

    // Update Task Remarks
    function updateRemarks(taskId, newRemarks) {
        const task = tasks.find(t => t.id === taskId);
        task.remarks = newRemarks;
    }

    // Update Custom Remarks (if "Other" was selected)
    function updateCustomRemarks(taskId, customRemarks) {
        const task = tasks.find(t => t.id === taskId);
        task.remarks = customRemarks;
    }

    // Filter change event
    taskFilterSelect.addEventListener('change', () => renderTasks());

    // Initial render
    renderTasks();
});








// --------INVENTORY MANAGEMENT --------------------------------------
// Sample Data (You can replace this with dynamic data from your database)
// const inventoryData = [
//     { equipment: "Hockey Stick", quantity: 10 },
//     { equipment: "Cricket Bat", quantity: 15 },
//     { equipment: "Cricket Ball", quantity: 50 },
//     { equipment: "Football", quantity: 20 },
//     { equipment: "Tennis Racket", quantity: 8 }
// ];

// Populate the inventory table with sample data
// function populateInventoryTable() {
//     const tableBody = document.querySelector("#inventoryTable tbody");
//     tableBody.innerHTML = ""; // Clear existing rows

//     inventoryData.forEach(item => {
//         const row = document.createElement("tr");
//         row.innerHTML = `
//             <td>${item.equipment}</td>
//             <td>${item.quantity}</td>
//             <td><button class="editBtn" onclick="editEquipment('${item.equipment}')">Edit</button></td>
//         `;
//         tableBody.appendChild(row);
//     });
// }

// Function to filter inventory based on search input








function searchEquipment() {
    const searchQuery = document.getElementById("searchEquipment").value.toLowerCase();
    const rows = document.querySelectorAll("#inventoryTable tbody tr");

    rows.forEach(row => {
        const equipmentName = row.cells[0].textContent.toLowerCase();
        if (equipmentName.includes(searchQuery)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}

// Add event listener to the search bar to trigger searchEquipment() on input
document.getElementById("searchEquipment").addEventListener("input", searchEquipment);








// ------EDIT MODAL--------------------

// Edit equipment modal handling
function editEquipment(equipmentName) {
    const equipment = inventoryData.find(item => item.equipment === equipmentName);

    // Show edit modal and populate fields
    document.getElementById("equipmentName").value = equipment.equipment;
    document.getElementById("quantity").value = equipment.quantity;

    // Show the modal
    document.getElementById("editModal").style.display = "flex";
}

// Handle quantity adjustment in edit modal
document.getElementById("subtractQty").addEventListener("click", function() {
    const quantityField = document.getElementById("quantity");
    if (quantityField.value > 0) {
        quantityField.value--;
    }
});

document.getElementById("addQty").addEventListener("click", function() {
    const quantityField = document.getElementById("quantity");
    quantityField.value++;
});

// Submit the edit form and update inventory
document.getElementById("submitEdit").addEventListener("click", function() {
    const equipmentName = document.getElementById("equipmentName").value;
    const updatedQuantity = parseInt(document.getElementById("quantity").value);
    const reason = document.getElementById("reason").value;

    // Update the equipment quantity
    const equipment = inventoryData.find(item => item.equipment === equipmentName);
    equipment.quantity = updatedQuantity;

    // Close the modal
    document.getElementById("editModal").style.display = "none";

    // Re-populate the table with updated data
    populateInventoryTable();
});

// Close modal
document.getElementById("closeModal").addEventListener("click", function() {
    document.getElementById("editModal").style.display = "none";
});









// -----------------ADD REQUEST MODAL

// Add New Request functionality
document.getElementById("addNewRequestBtn").addEventListener("click", function() {
    document.getElementById("newRequestModal").style.display = "flex";
});

// Handle quantity adjustment in new request modal
document.getElementById("subtractRequestQty").addEventListener("click", function() {
    const requestQuantityField = document.getElementById("requestQuantity");
    if (requestQuantityField.value > 0) {
        requestQuantityField.value--;
    }
});

document.getElementById("addRequestQty").addEventListener("click", function() {
    const requestQuantityField = document.getElementById("requestQuantity");
    requestQuantityField.value++;
});


 
// Close new request modal
document.getElementById("closeRequestModal").addEventListener("click", function() {
    document.getElementById("newRequestModal").style.display = "none";
});

// Delete Request functionality (with confirmation)
document.querySelector("#requestsTable").addEventListener("click", function(event) {
    if (event.target && event.target.className === "deleteBtn") {
        if (confirm("Are you sure you want to delete this request?")) {
            const row = event.target.closest("tr");
            row.remove();
        }
    }
});

// Populate the equipment dropdown in the New Request Modal dynamically
function populateEquipmentDropdown() {
    const equipmentSelect = document.getElementById("equipmentSelect");
    inventoryData.forEach(item => {
        const option = document.createElement("option");
        option.value = item.equipment;
        option.textContent = item.equipment;
        equipmentSelect.appendChild(option);
    });
}

// Initial population of the inventory table



// =======================EDIT MODAL================================
// --------EDIT MODAL------------------------------- 
// Get all the edit buttons and add event listener to each 
document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Retrieve the equipment details from the data attributes
        const equipmentId = this.dataset.id;
        const equipmentName = this.dataset.name;
        const quantity = this.dataset.quantity;
        
        // Populate the modal with the retrieved information
        document.getElementById('equipmentId').value = equipmentId;
        document.getElementById('equipmentName').value = equipmentName;
        document.getElementById('quantity').value = quantity;
        
        // Show the modal
        document.getElementById('editModal').style.display = 'block';
    });
});

// Event listener for the submit button
document.getElementById('editEquipmentForm').addEventListener('submit', function(event) {
    // Get the form data
    const equipmentId = document.getElementById('equipmentId').value;
    const quantity = document.getElementById('quantity').value;
    const reason = document.getElementById('reason').value;
    
    // Perform form validation
    if (!equipmentId) {
        alert("Equipment ID is missing.");
        event.preventDefault();
        return;
    }

    if (!quantity) {
        alert("Please enter a quantity.");
        event.preventDefault();
        return;
    }

    if (!reason) {
        alert("Please select a reason for update.");
        event.preventDefault();
        return;
    }

    // Form will submit normally, no need to prevent default
});

// Close the modal when clicking close button
document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('editModal').style.display = 'none';
});

// Close the modal if clicked outside of it
window.addEventListener('click', function (event) {
    if (event.target === document.getElementById('editModal')) {
        document.getElementById('editModal').style.display = 'none';
        console.log('Modal is closed by clicking outside');
    }
});

// Add quantity increment/decrement functionality
document.getElementById('addQty').addEventListener('click', function() {
    const quantityInput = document.getElementById('quantity');
    quantityInput.value = parseInt(quantityInput.value || 0) + 1;
});

document.getElementById('subtractQty').addEventListener('click', function() {
    const quantityInput = document.getElementById('quantity');
    const currentValue = parseInt(quantityInput.value || 0);
    quantityInput.value = Math.max(0, currentValue - 1);
});

// ============================= LOG OUT ========================================================================


// Attach event listener for the logout button
document.getElementById("logout").addEventListener("click", handleLogout);

// Function to handle logout
function handleLogout() {
    const confirmLogout = confirm("Are you sure you want to log out?");
    if (confirmLogout) {
        // Clear session or perform any necessary cleanup actions
        console.log("User logged out");

        // Redirect to the login page
        window.location.href = "http://localhost/PEAK/public/login"; // Update with your actual login page URL
    }
}

// ================================================================================================================

