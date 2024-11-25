<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-1.0">
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/profile.css">
        <title>External User Dashboard</title>
    </head>


    <body>
        <!-- navigation bar -->
        <?php include 'enav.view.php'; ?>
        <div class="main">
        <?php include 'top.view.php'; ?>
            
        <div class="details-column">
                <h1>Account Details</h1>
                <div class="details-row">
                    <div class="profile-details">
                        <p><strong>Full name</strong><span class="boxes">Uma Piyumini</span></p>
                        <p><strong>User name</strong><span class="boxes">Umz2002</span></p>
                        <p><strong>Company</strong> <span class="boxes">ABC Company Pvt(ltd)</span></p>
                        <p><strong>Email</strong> <span class="boxes">your.email@example.com</span></p>
                        <p><strong>Phone</strong> <span class="boxes">0705691983</span></p>
                        <p><strong>Address</strong> <span class="boxes">w/3/2, Anderson Flats, Colombo 05</span></p>
                        <button id="editProfileBtn">Edit Profile</button><br>
                        <button id="logoutBtn">Logout</button><br>
                        <button id="deleteaccount">Delete Account</button>
                    </div>
                    <!-- Image uploading box -->
        <div class="imageUploadBox">
            <div id="imagePreview" class="imagePreviewBox">
                <div id="imageContainer"></div>
            </div>

            
            <input type="file" class="imageChooseInput" name="image" id="image" 
                accept="image/jpg, image/jpeg, image/png, image/webp" 
                onchange="previewImage(event)">
            
            
            <button type="button" class="imageChooseBtn" onclick="triggerFileInput()">Choose</button>
            <button type="button" class="imageRemoveBtn" onclick="removeImage()">Remove</button>

           
        </div>
                    
                </div>
            
            
            
            
            <div id="editProfileModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Edit Profile</h2>
                    <form id="editProfileForm">
                        <label for="fullName">Full Name:</label>
                        <input type="text" id="fullName" value="Uma Piyumini">
            
                        <label for="userName">User Name:</label>
                        <input type="text" id="userName" value="Umz2002">
            
                        <label for="company">Company:</label>
                        <input type="text" id="company" value="ABC Company Pvt(ltd)" disabled class="disabled-cursor">
            
                        <label for="email">Email:</label>
                        <input type="email" id="email" value="your.email@example.com" disabled class="disabled-cursor">
            
                        <label for="phone">Phone:</label>
                        <input type="tel" id="phone" value="0705691983">
            
                        <label for="address">Address:</label>
                        <input type="text" id="address" value="w/3/2, Anderson Flats, Colombo 05">
            
                        <button type="button" id="confirmUpdateBtn">Confirm Update</button>
                    </form>
                </div>
            </div>
            </div>


        
            <script src="<?=ROOT?>/assets/js/uma/profile.js"></script>
        </body>
        </html>