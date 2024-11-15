<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Your Account</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/signup1.css">
</head>
<body>
   
    <div class="top-border"></div>
    
    
    <div class="logo-container">
        <img src="<?=ROOT?>/assets/images/logo.png" alt="PEAK Logo" class="logo">
    </div>
    <div class="box">
    <div class="signup-wrapper">
        <header>
            <h2>Enter your Registration number to get started: </h2>
        </header>
        <form action="<?=ROOT?>/signups2" method="post" class="signup-form">
            <input type="text" placeholder="Registration number" required>
            
            
            <button type="submit" class="next-button">Next</button>

        </form>
    </div></div>
</body>
</html>
