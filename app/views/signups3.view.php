<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Your Account</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/signup2.css">
</head>
<body>
    <!-- Purple top border -->
    <div class="top-border"></div>
    
    <!-- Logo placed below the top border -->
    <div class="logo-container">
        <img src="<?=ROOT?>/assets/images/logo.png" alt="PEAK Logo" class="logo">
    </div>
    <div class="box">
    <div class="signup-wrapper">
        <header>
            <h2>Create your Account...</h2>
        </header>
        <form action="<?=ROOT?>/login" method="post" class="signup-form">
            <input type="text" placeholder="Username" required>
            <input type="password" placeholder="Password" required>
            <input type="password" placeholder="Confirm Password" required>

            <div class="terms-conditions">
                <input type="checkbox" id="terms" required>
                <label for="terms">I have read and agree to the <a href="#">Terms</a>, <a href="#">Privacy Policy</a>, and <a href="#">Cookies Policy</a>.</label>
            </div>

            <button type="submit" class="signup-button">Sign Up</button>
        </form>
    </div></div>
</body>
</html>
