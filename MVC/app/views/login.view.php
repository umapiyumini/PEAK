<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PEAK Login</title>
    <link rel="stylesheet" href="MVC\public\assets\css\login.css">
</head>
<body>
    <div class="container">
        <div class="left-side">
            <img src="MVC\public\assets\images\login.jpg" alt="purple" class="transparent">
            <div class="quote" >
                <p >"Your gateway to seamless Physical Education management and interaction."</p>
            </div>
        </div>
        <div class="right-side">
            <div class="login-box">
		<img src="MVC\public\assets\images\logo.png" class="logo">
                <h1>Welcome to PEAK!</h1>
                <form action="#">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <a href="forgot.html" class="forgot-password">Forgot Password?</a>
                    <button type="submit">Login</button>
                </form>
                <p class="register">Not Registered? <a href="signup.html">Create an Account</a></p>
            </div>
        </div>
    </div>
</body>
</html>
