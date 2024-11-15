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
            <h2>Create your Account...</h2>
        </header>
        <form action="<?=ROOT?>/signups3" method="post" class="signup-form">
            <input type="text" placeholder="Registration number" required>
            <input type="text" name="fullName" placeholder="Name with Initials" required>
            <input type="text" name="nic" placeholder="NIC" required>
            <input type="email" name="email" placeholder="E-mail Address" required>
            <input type="text" name="address" placeholder="Address" required>
            <input type="date" name="dob" placeholder="Date of Birth" required>


            <select required>
                <option value="" disabled selected>Faculty</option>
                <option value="business">UCSC</option>
                <option value="science">Science</option>
                <option value="arts">Arts</option>
                <option value="business">Management</option>
                <option value="business">Technology</option>
                <option value="business">Medicine</option>
            </select>
            <input type="text" placeholder="Contact Number" required>
            
            <div class="gender-selection">
                <label>Gender :</label>
                <div>
                    <label><input type="radio" name="gender" value="male" required> Male</label>
                    <label><input type="radio" name="gender" value="female" required> Female</label>
                </div>
            </div>
            
            
            <button type="submit" class="next-button">Next</button>

        </form>
    </div></div>
</body>
</html>
