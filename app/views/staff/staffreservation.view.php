<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-1.0">
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/todo.css">
        <title>External User Dashboard</title>
    </head>


    <body>
             

            <!-- ----------------- main content ------------------ -->

            <div class="container">
        <!-- Reservations Section -->
        <div class="reservations">
            <h2>View Reservations</h2>
            <label for="facility">Select Facility:</label>
            <select id="facility">
                <option value="" disabled selected>Select...</option>
                <option value="ground">Ground</option>
                <option value="basketball">Basketball Court</option>
                <option value="tennis">Tennis Court</option>
                <option value="indoor">Indoor Stadium</option>
            </select>
            <div id="dateNavigation">
    <button id="prevDate"><</button>
    <span id="currentDate"></span>
    <button id="nextDate">></button>
</div>
<div id="timeSlots" class="time-slots"></div>

            <div id="timeSlots" class="time-slots">
                <!-- Time slots will populate dynamically -->
            </div>
        </div>

    
    <script src="<?=ROOT?>/assets/js/uma/staff.js"></script>
    <script>
   document.addEventListener('DOMContentLoaded', function () {
    const userImage = document.getElementById('userImage');
    const dropdownMenu = document.getElementById('dropdownMenu');

    // Listen for the profile image click
    userImage.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default action (e.g., navigating away)
        console.log("User image clicked!"); // Debugging log

  
    });

    document.querySelector('.user').addEventListener('click', function () {
    const dropdown = document.querySelector('.dropdown');
    dropdown.classList.toggle('show');  // Toggle the 'show' class
});
    // Check if the dropdown is being triggered correctly
    document.addEventListener('click', function (event) {
        if (!userImage.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.remove('show'); // Remove 'show' class to hide dropdown
            console.log("Dropdown hidden (click outside)"); // Debugging log
        }
    });
});


// ====================== DELETE JS ===========================
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Get the requestid from the hidden input field
        const requestid = this.closest('tr').querySelector('.request-id').value;
        
        // Confirm the delete action
        const confirmDelete = confirm('Are you sure you want to delete this request?');
        
        if (confirmDelete) {
            // Send a POST request to delete the item
            const formData = new FormData();
            formData.append('delete_requestid', requestid);  // Add the requestid to the form data

            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Alert the user about the deletion outcome (optional)
                if (data === 'success') {
                    alert('Successfully deleted.');
                } else {
                    alert('Successfully deleted.');
                }

                // Reload the page after the operation, regardless of success or failure
                location.reload();  // Reload the page to reflect the changes
            })
            .catch(error => {
                console.error('Error deleting request:', error);
                alert('Error occurred while deleting.');
                
                // Reload the page in case of error as well
                location.reload();
            });
        }
    });
});

// ============================== UPDATE JS ============================

</script>

    
    
</body>
</html>


            <!-- test git comment -->