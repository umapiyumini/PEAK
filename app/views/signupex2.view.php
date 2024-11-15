<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PEAK Signup</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/mainsignup.css">
</head>
<body>
    
    <div class="top-border"></div>

    <div class="signup-container">
        <img src="<?=ROOT?>/assets/images/logo.png" alt="PEAK Logo" class="logo">
        <header>
            <h2>Create your Account...</h2>
            <p>Please fill in your details</p>
        </header>

        <main>
            <div class="role-selection">
            <form action="<?=ROOT?>/login" method="post" class="signup-form">
            <input type="text" placeholder="Username" required>
            <input type="password" placeholder="Password" required>
            <input type="password" placeholder="Confirm Password" required>

            <div class="terms-conditions">
                <input type="checkbox" id="terms" required>
                <label for="terms">I have read and agree to the <a href="#">Terms</a>, <a href="#">Privacy Policy</a>, and <a href="#">Cookies Policy</a>.</label>
            </div>

            <button type="submit" class="button">Sign Up</button>
        </form>  
            </div>
        </main>
    </div>
</body>
</html>

       









 
