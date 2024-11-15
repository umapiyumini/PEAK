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
            <form action="<?=ROOT?>/signupex2" method="post" class="signup-form">
            <input type="text" name="fullName" placeholder="Full Name with Initials" required>
            <input type="text" name="nic" placeholder="NIC" required>
            <input type="email" name="email" placeholder="E-mail Address" required>
            <input type="text" name="contactNumber" placeholder="Contact Number" required>
            <input type="text" name="company" placeholder="Company" required>
            <input type="text" name="address" placeholder="Address" required>
            <input type="date" name="dob" placeholder="Date of Birth" required>

            <div class="gender-selection">
                <label>Gender:</label>
                <div>
                <input type="radio" id="male" name="gender" value="male" required>
                <label for="male">Male</label>

                <input type="radio" id="female" name="gender" value="female" required>
                <label for="female">Female</label>
                </div>
            </div>

            <button type="submit" class="button">Next</button>

        </form>   
            </div>
        </main>
    </div>
</body>
</html>

       
