<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/forgotpassword.css">
</head>
<body>
    <div class="top-border"></div>
    
    <div class="logo-container">
        <img src="<?=ROOT?>/assets/images/logo.png" alt="PEAK Logo" class="logo">
    </div>
    
    <div class="box">
        <div class="signup-wrapper">
            <header>
                <h2>Forgot Your Password?</h2>
            </header>
            <form action="reset-password.html" method="post" class="forgot-password-form">
                <input type="email" placeholder="Enter your email address" required>
                
                <button type="submit" class="next-button">Send Reset Link</button>
            </form>
            <p class="back-to-login">Remembered your password? <a href="<?=ROOT?>/login">Login here</a>.</p>
        </div>
    </div>
</body>
</html>
