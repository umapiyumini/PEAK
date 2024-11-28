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
      
        <div class="formlable">Registration number </div>
        <input type="text" name="registrationnumber" required>
        <div class="formlable">Name with Initials </div>
        <input type="text" name="fullName"  required>
        <div class="formlable">Date of Birth </div>
         <input type="date" name="dob"  required>
         <div class="formlable">NIC </div>
        <input type="text" name="nic"  required>
   
        <div class="formlable">Student E-mail</div>
    <input type="email" name="email"  required>

    <div class="formlable">Address</div>
    <input type="text" name="address"  required>
    
    <div class="formlable">Faculty </div>
    <select required>
       
        <option value="business">UCSC</option>
        <option value="science">Science</option>
        <option value="arts">Arts</option>
        <option value="business">Management</option>
        <option value="business">Technology</option>
        <option value="business">Medicine</option>
    </select>

    <div class="formlable">Department</div>
    <input type="text" name="department"  required>

    <div class="formlable">Contact Number </div>
    <input type="text"  required>
    

   <div class="gender-selection">
                <label class="formlable">Gender</label>
                <div>
                <input type="radio" id="male" name="gender" value="male" >
                <label for="male">Male</label>

                <input type="radio" id="female" name="gender" value="female" >
                <label for="female">Female</label>
                </div>
            </div>
    

    <div class="formlable">Password </div>
    <input type="password"  required>

    <div class="formlable">Confirm Password </div>
    <input type="password"  required>

    <div class="terms-conditions">
        <input type="checkbox" id="terms" required>
        <label for="terms">I have read and agree to the <a href="#">Terms</a>, <a href="#">Privacy Policy</a>, and <a href="#">Cookies Policy</a>.</label>
    </div>

    <button type="submit" class="button">Sign Up</button>
</form>

            </div>
        </main>
    </div>
    <script src="<?=ROOT?>/assets/js/image.js"></script>
</body>
</html>

       
