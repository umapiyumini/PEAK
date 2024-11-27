<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PEAK Login</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/login.css">
</head>
<body>
    <div class="container">
        <div class="left-side">
            <img src="<?=ROOT?>/assets/images/login.jpg" alt="purple" class="transparent">
            <div class="quote">
                <p>"Your gateway to seamless Physical Education management and interaction."</p>
            </div>
        </div>
        <div class="right-side">
            <div class="login-box">
                <img src="<?=ROOT?>/assets/images/logo.png" class="logo">
                <h1>Welcome to PEAK!</h1>
                <form  method="POST"> <!-- Form action set to login.php -->
                    <?php if(!empty($errors)): ?>
                       invalid login
                    <?php endif;?>

                    <label for="username">Email</label>
                    <input type="text" id="username" name="username" required>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <a href="<?=ROOT?>/forgotpassword" class="forgot-password">Forgot Password?</a>
                    <button type="submit">Login</button>
                </form>
                <p class="register">Not Registered? <a href="<?=ROOT?>/signup">Create an Account</a></p>
            </div>
        </div>
    </div>
</body>
</html>
