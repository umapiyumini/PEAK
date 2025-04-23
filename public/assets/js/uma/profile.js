// --- Profile update modal logic ---
var modal = document.getElementById("editProfileModal");
var btn = document.getElementById("editProfileBtn");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
    modal.style.display = "flex";
    document.body.style.overflow = "hidden";
};

span.onclick = function() {
    modal.style.display = "none";
    document.body.style.overflow = "auto";
};

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
        document.body.style.overflow = "auto";
    }
};

document.getElementById("confirmUpdateBtn").onclick = function(e) {
    e.preventDefault();

    var fullName = document.getElementById("fullName").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var address = document.getElementById("address").value;

    if (confirm("Are you sure you want to update your details?")) {
        fetch('/PEAK/public/external/profile/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                name: fullName,
                email: email,
                phone: phone,
                address: address
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the DOM with new values
                var boxes = document.querySelectorAll(".details-column .boxes");
                boxes[0].innerText = fullName;
                boxes[1].innerText = email;
                boxes[3].innerText = phone;
                boxes[4].innerText = address;

                modal.style.display = "none";
                document.body.style.overflow = "auto";
                alert('Profile updated successfully!');
            } else {
                alert('Update failed: ' + data.message);
            }
        })
        .catch(error => {
            alert('An error occurred: ' + error);
        });
    }
};

// --- Profile picture preview ---
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

// --- Remove profile picture (AJAX) ---
function removeImage() {
    if (!confirm('Are you sure you want to remove your profile picture?')) {
        return;
    }

    fetch('/PEAK/public/external/profile/remove_image', {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('image').value = '';
            document.getElementById('imageContainer').innerHTML = '';
            alert('Profile picture removed!');
        } else {
            alert('Failed to remove profile picture: ' + data.message);
        }
    })
    .catch(error => {
        alert('An error occurred: ' + error);
    });
}

// --- Logout ---
document.getElementById("logoutBtn").onclick = function() {
    if (confirm("Are you sure you want to log out?")) {
        window.location.href = "http://localhost/PEAK/public/login";
    }
};

// --- Delete account ---
document.getElementById("deleteaccount").onclick = function() {
    if (confirm("Are you sure you want to delete your account? This action cannot be undone.")) {
        // TODO: Call backend to delete account
        window.location.href = "#";
    }
};

// --- Profile image upload (AJAX) ---
document.getElementById('profileImageForm').onsubmit = function(e) {
    e.preventDefault();

    var fileInput = document.getElementById('image');
    if (fileInput.files.length === 0) {
        alert('Please select an image to upload.');
        return;
    }

    var formData = new FormData();
    formData.append('image', fileInput.files[0]);

    fetch('/PEAK/public/external/profile/upload_image', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Profile picture uploaded successfully!');
            // Optionally update the preview with the new image from server
            // document.getElementById('imageContainer').innerHTML = '<img src="' + data.image_url + '" alt="Profile Picture">';
        } else {
            alert('Upload failed: ' + data.message);
        }
    })
    .catch(error => {
        alert('An error occurred: ' + error);
    });
};
