<?php
if (session_status() == PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../../models/User.php'; // Adjust path as needed

$profile_img = "/PEAK/assets/images/user1.jpg"; // default

if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
    $userModel = new User();
    $user_data = $userModel->getUser($userid);
    $user = (!empty($user_data)) ? $user_data[0] : null;

    if ($user && !empty($user->image)) {
        $profile_img = "/PEAK/uploads/profile_pictures/" . htmlspecialchars($user->image);
    }
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-1.0">
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/enav.css">
        <title>External User Dashboard</title>
    </head>


    <body>
        <!-- navigation bar -->
        

       

        
            <div class="topbar">
                

                <div class="user">
                <a href="profile">
                <img src="<?= $profile_img ?>" alt="Profile Picture">
    </a>
                </div>
            </div>
                

            <script >
                let toggle = document.querySelector(".toggle");
                let navigation = document.querySelector(".navigation");
                let main = document.querySelector(".main");

                toggle.onclick = function(){
                navigation.classList.toggle("active");
                main.classList.toggle("active");
  
            }
            </script>
    </body>
</html>