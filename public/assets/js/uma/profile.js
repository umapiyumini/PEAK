//  update profile pop up---------------------------------
var modal = document.getElementById("editProfileModal");
var btn = document.getElementById("editProfileBtn");
var span = document.getElementsByClassName("close")[0];

// Open the modal when the edit button is clicked
btn.onclick = function() {
    modal.style.display = "flex"; // Show the modal
    document.body.style.overflow = "hidden"; // Prevent background scrolling
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none"; // Hide the modal
    document.body.style.overflow = "auto"; // Enable background scrolling
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none"; // Hide the modal
        document.body.style.overflow = "auto"; // Enable background scrolling
    }
}

// Confirm update button functionality
document.getElementById("confirmUpdateBtn").onclick = function() {
    var fullName = document.getElementById("fullName").value;
    var userName = document.getElementById("userName").value;
    var company = document.getElementById("company").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var address = document.getElementById("address").value;

    // Confirmation dialog
    if (confirm("Are you sure you want to update your details?")) {
        // Update displayed profile details
        var boxes = document.querySelectorAll(".details-column .boxes");
        boxes[0].innerText = fullName; // Full name
        boxes[1].innerText = userName; // User name
        boxes[2].innerText = company;   // Company
        boxes[3].innerText = email;     // Email
        boxes[4].innerText = phone;     // Phone
        boxes[5].innerText = address;   // Address

        // Close the modal
        modal.style.display = "none";
        document.body.style.overflow = "auto"; // Enable background scrolling
    }
}

// -----------------profile pic----------------------------------

            function triggerFileInput() {
                document.getElementById('image').click();
            }

            function previewImage(event) {
                const imageContainer = document.getElementById('imageContainer');
                imageContainer.innerHTML = '';

                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = 'Image Preview';
                        img.style.width = '100%';
                        img.style.height = '100%';
                        img.style.objectFit = 'cover';
                        imageContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            }

            function removeImage() {
                document.getElementById('image').value = '';
                document.getElementById('imageContainer').innerHTML = '';
            }
    
// -----------------logout---------------
// Attach event listeners for the buttons
document.getElementById("logoutBtn").addEventListener("click", handleLogout);
document.getElementById("deleteaccount").addEventListener("click", handleDeleteAccount);

// Function to handle logout
function handleLogout() {
    const confirmLogout = confirm("Are you sure you want to log out?");
    if (confirmLogout) {
        // Perform logout logic (e.g., API call or session clearing)
        console.log("User logged out");

        // Redirect to the login page
        window.location.href = "http://localhost/PEAK/public/login"; // Update with your actual login page URL
    }
}



// ---------------deleteaccount----------------------
// Function to handle account deletion
function handleDeleteAccount() {
    const confirmDelete = confirm("Are you sure you want to delete your account? This action cannot be undone.");
    if (confirmDelete) {
        // Perform account deletion logic (e.g., API call to delete user data)
        console.log("Account deleted");

      
        window.location.href = "#"; // Update with your actual redirection page URL
    }
}
