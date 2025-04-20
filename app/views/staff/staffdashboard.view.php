<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-1.0">
    
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/sportcaptaindashboard.css">
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/ped.css">

        <title>Staff Dashboard</title>
    </head>


    <body>
    <header>
        <div class="header-container">
            <div class="breadcrumb-bar">
                <span>Home</a></span> > <span>Dashboard</span> > <span id="currentPage">Todo list</span>
            </div>
           
            <div class="profile-icon">
                <img src="<?=ROOT?>/assets/images/vidusha/pro_icon.png" alt="Profile Icon">
            </div>
        </div>
        <div class="dropdown-menu" id="dropdownMenu">
        <ul>
            <li><a href="studentprofiles"><i class="uil uil-user"></i> My Profile</a></li>
            <li><a href="../login"><i class="uil uil-signout"></i> Log out</a></li>
        </ul>
    </div>
    </header>
        <!-- navigation bar -->
        <div class="sidebar">
        <img src="<?=ROOT?>/assets/images/vidusha/pedlogo.png" alt="PEAK Logo" class="ped-logo">
        <ul>
            <li>
                <img src="<?=ROOT?>/assets/images/vidusha/sport.png" alt="Sport Icon" class="icon">
                <a href="#" onclick="loadContent('stafftodo', 'Todo List')">Todo List</a>
            </li>
            <li>
                <img src="<?=ROOT?>/assets/images/vidusha/event.png" alt="Reservation Icon" class="icon">
                <a href="#" onclick="loadContent('staffreservation', 'Reservation')">Reservation</a>
            </li>
            <li>
                <img src="<?=ROOT?>/assets/images/vidusha/inventory.png" alt="Unpacked Icon" class="icon">
                <a href="#" onclick="loadContent('staffinventory', 'Inventory')">Inventory</a>
            </li>
            <li>
                <img src="<?=ROOT?>/assets/images/vidusha/logout.png" alt="Logout Icon" class="icon">
                <a href="../login">Log out</a>    
            </li>
        </ul>
    </div>

    <!-- Content Area -->
    <div class="dashboard">
        <iframe id="contentFrame" class="embedded-content" src="stafftodo"></iframe>
    </div>   

       

        
    
    



    <script src="<?=ROOT?>/assets/js/uma/staff.js"></script>
    <script src="<?=ROOT?>/assets/js/vidusha/sportcaptaindashboard.js"></script>
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


</script>
 
    
</body>
</html>


            