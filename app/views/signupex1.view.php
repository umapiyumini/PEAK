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
            <form  method="post" class="signup-form">




            
        <div class="formlable">Name with Initials </div>
        <input type="text" name="fullName" >
        

        <div class="formlable">Date of Birth </div>
         <input type="date" name="dob" >
        

         <div class="formlable">NIC </div>
        <input type="text" name="nic"  >
        

        <div class="formlable">Contact Number </div>
        <input type="text" name="contactNumber" >
       

    
  
        <div class="formlable">E-mail </div>
            <input type="email" name="email"  >

            <div class="formlable">Organization ID</div>   
            <input type="text" name="companyid"  >
           

            <div class="formlable">Organization Name</div>   
            <input type="text" name="company"  >
            
          

            <div class="formlable">Organization Address </div>
            <input type="text" name="address" >
            
           

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
            <input type="password"  >
           
            <div class="formlable">Confirm Password </div>
            <input type="password"  >
            

           



            <div class="terms-conditions">
                <input type="checkbox" id="terms" >
                <label for="terms">I have read and agree to the <a href="#">Terms</a>, <a href="#">Privacy Policy</a>, and <a href="#">Cookies Policy</a>.</label>
                
            
                </div>
            <button type="submit" class="button">Sign Up</button>
            </form>    
           
        </main>
    </div>
    <script src="<?=ROOT?>/assets/js/image.js"></script>
</body>
</html>

       
