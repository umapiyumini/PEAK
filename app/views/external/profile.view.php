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
                    <p><strong>Full name</strong> <span class="boxes"><?= htmlspecialchars($user->name) ?></span></p>
                    <p><strong>Email</strong> <span class="boxes"><?= htmlspecialchars($user->email) ?></span></p>
                    <p><strong>Company</strong> <span class="boxes"><?= htmlspecialchars($company_name) ?></span></p>
                    <p><strong>Phone</strong> <span class="boxes"><?= htmlspecialchars($user->contact_number) ?></span></p>
                    <p><strong>Address</strong> <span class="boxes"><?= htmlspecialchars($user->address) ?></span></p>

                        <button id="editProfileBtn">Edit Profile</button><br>
                        <button id="logoutBtn">Logout</button><br>
                        <button id="deleteaccount">Delete Account</button>
                    </div>
                    <!-- Image uploading box -->
                    <form id="profileImageForm" enctype="multipart/form-data">
                        <div class="imageUploadBox">
                        <div id="imagePreview" class="imagePreviewBox">
                            <div id="imageContainer">
                                <?php if (!empty($user->image)): ?>
                                    <img src="/PEAK/uploads/profile_pictures/<?= htmlspecialchars($user->image) ?>" 
                                        alt="Profile Picture"
                                        style="width:100%; height:100%; object-fit:cover;">
                                <?php endif; ?>
                            </div>
                        </div>

                            <input type="file" class="imageChooseInput" name="image" id="image"
                                accept="image/jpg, image/jpeg, image/png, image/webp"
                                onchange="previewImage(event)">
                            <button type="button" class="imageChooseBtn" onclick="triggerFileInput()">Choose</button>
                            <button type="button" class="imageRemoveBtn" onclick="removeImage()">Remove</button>
                            <button type="submit" class="imageChooseBtn">Upload</button>
                        </div>
                    </form>

                    
                </div>
            
            
            
            
            <div id="editProfileModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Edit Profile</h2>
                    <form id="editProfileForm" >
                    <input type="text" id="fullName" value="<?= htmlspecialchars($user->name) ?>">
                    <input type="email" id="email" value="<?= htmlspecialchars($user->email) ?>" >
                    <input type="text" id="company" value="<?= htmlspecialchars($company_name) ?>" disabled class="disabled-cursor">
                    
                    <input type="tel" id="phone" value="<?= htmlspecialchars($user->contact_number) ?>">
                    <input type="text" id="address" value="<?= htmlspecialchars($user->address) ?>">

            
                        <button type="button" id="confirmUpdateBtn">Confirm Update</button>
                    </form>
                </div>
            </div>
            </div>


        
            <script src="<?=ROOT?>/assets/js/uma/profile.js"></script>
        </body>
        </html>