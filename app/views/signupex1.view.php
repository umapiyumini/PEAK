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
            <form action="<?=ROOT?>/signupex1" method="post" class="signup-form">
                <div class="formlable">Name with Initials </div>
                <input type="text" name="name" value="<?=htmlspecialchars($_POST['name'] ?? '')?>">
                <?php if(!empty($errors['name'])): ?>
                    <div class="error-message" style="text-align:left; color: red; font-size: 12px;"><?=$errors['name']?></div>
                <?php endif;?>

                <div class="formlable">Date of Birth </div>
                <input type="date" name="dob" value="<?=htmlspecialchars($_POST['dob'] ?? '')?>">
                <?php if(!empty($errors['dob'])): ?>
                    <div class="error-message" style="text-align:left; color: red; font-size: 12px;"><?=$errors['dob']?></div>
                <?php endif;?>

                <div class="formlable">NIC </div>
                <input type="text" name="nic" value="<?=htmlspecialchars($_POST['nic'] ?? '')?>">
                <?php if(!empty($errors['nic'])): ?>
                    <div class="error-message" style="text-align:left; color: red; font-size: 12px;"><?=$errors['nic']?></div>
                <?php endif;?>

                <div class="formlable">Contact Number </div>
                <input type="text" name="contact_number" value="<?=htmlspecialchars($_POST['contact_number'] ?? '')?>">
                <?php if(!empty($errors['contact_number'])): ?>
                    <div class="error-message" style="text-align:left; color: red; font-size: 12px;"><?=$errors['contact_number']?></div>
                <?php endif;?>
    
                <div class="formlable">E-mail </div>
                <input type="text" name="email" value="<?=htmlspecialchars($_POST['email'] ?? '')?>">
                <?php if(!empty($errors['email'])): ?>
                    <div class="error-message" style="text-align:left; color: red; font-size: 12px;"><?=$errors['email']?></div>
                <?php endif;?>

                <div class="formlable">Address</div>   
                <input type="text" name="address" value="<?=htmlspecialchars($_POST['address'] ?? '')?>">
                <?php if(!empty($errors['address'])): ?>
                    <div class="error-message" style="text-align:left; color: red; font-size: 12px;"><?=$errors['address']?></div>
                <?php endif;?>

                <div class="formlable">Organization Name</div>   
                <input type="text" name="company_name" value="<?=htmlspecialchars($_POST['company_name'] ?? '')?>">
                <?php if(!empty($exerrors['company_name'])): ?>
                    <div class="error-message" style="text-align:left; color: red; font-size: 12px;"><?=$exerrors['company_name']?></div>
                <?php endif;?>

                
                <div class="gender-selection">
                    <label class="formlable">Gender</label>
                    <div>
                        <input type="radio" id="male" name="gender" value="male" <?= isset($_POST['gender']) && $_POST['gender'] == 'male' ? 'checked' : '' ?>>
                        <label for="male">Male</label>

                        <input type="radio" id="female" name="gender" value="female" <?= isset($_POST['gender']) && $_POST['gender'] == 'female' ? 'checked' : '' ?>>
                        <label for="female">Female</label>
                    </div>
                </div>
                <?php if(!empty($errors['gender'])): ?>
                    <div class="error-message" style="text-align:left; color: red; font-size: 12px;"><?=$errors['gender']?></div>
                <?php endif;?>

                <div class="formlable">Password </div>
                <input type="password" name="password" value="<?=htmlspecialchars($_POST['password'] ?? '')?>">
                <?php if(!empty($errors['password'])): ?>
                    <div class="error-message" style="text-align:left; color: red; font-size: 12px;"><?=$errors['password']?></div>
                <?php endif;?>
            
                <div class="formlable">Confirm Password </div>
                <input type="password" name="confirm_password" value="<?=htmlspecialchars($_POST['confirm_password'] ?? '')?>">
                <?php if(!empty($errors['confirm_password'])): ?>
                    <div class="error-message" style="text-align:left; color: red; font-size: 12px;"><?=$errors['confirm_password']?></div>
                <?php endif;?>

                <div class="terms-conditions">
                    <input type="checkbox" name="terms" id="terms" value="1" <?=isset($_POST['terms']) ? 'checked' : ''?>>
                    <label for="terms">I have read and agree to the <a href="#">Terms</a>, <a href="#">Privacy Policy</a>, and <a href="#">Cookies Policy</a>.</label>
                </div>
                <?php if(!empty($errors['terms'])): ?>
                    <div class="error-message" style="text-align:left; color: red; font-size: 12px;"><?=$errors['terms']?></div>
                <?php endif;?>
                
                <button type="submit" class="button">Sign Up</button>
            </form>    
        </main>
    </div>
    <script src="<?=ROOT?>/assets/js/image.js"></script>
</body>
</html>

       
