<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/amar/profile_edit.css">

    
</head>
<body>
    <form action="submit_form.php" method="post">
        <h2>Registration Form</h2>
        <label for="regNumber">Registration Number:</label>
        <input type="text" id="regNumber" name="regNumber" required>

        <label for="faculty">Faculty:</label>
        <input type="text" id="faculty" name="faculty" required>

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" required>

        <button type="submit">Submit</button>
        <button class="delete">Delete Profile</button>
    </form>
</body>
</html>
