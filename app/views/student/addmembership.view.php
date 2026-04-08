<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Membership Request</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            background-color: #003366;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-bottom: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .card {
            background-color: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #003366;
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        
        .submit-btn {
            display: inline-block;
            background-color: #0066cc;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }
        
        .submit-btn:hover {
            background-color: #004c99;
        }
        
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #0066cc;
            text-decoration: none;
        }
        
        .back-link:hover {
            text-decoration: underline;
        }
        
        .form-container {
            padding: 20px;
        }

        .errors {
            color: red;
        }
    </style>
</head>
<body>

<?php include 'nav.view.php';?>

<div class="container">
    <div class="card">
        <div class="form-container" id="membership-form">
            <h1>Team Membership</h1>
            <form method="POST" action="<?= ROOT ?>/student/Membership/">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <p class="errors">
                        <?php if (!empty($errors['full_name'])) echo $errors['full_name']; ?>
                    </p>
                    <input type="text" id="name" placeholder="Enter Full Name" name="full_name">
                </div>

                <div class="form-group">
                    <label for="registration-id">Student Registration ID</label>
                    <p class="errors">
                        <?php if (!empty($errors['student_id'])) echo $errors['student_id']; ?>
                    </p>
                    <input type="text" id="registration-id" placeholder="Enter Registration ID" name="student_id">
                </div>

                <div class="form-group">
                    <label for="faculty">Faculty</label>
                    <p class="errors">
                        <?php if (!empty($errors['faculty'])) echo $errors['faculty']; ?>
                    </p>
                    <input type="text" id="faculty" placeholder="Enter Faculty" name="faculty">
                </div>

                <div class="form-group">
                    <label for="year">Year of Study</label>
                    <p class="errors">
                        <?php if (!empty($errors['year_of_study'])) echo $errors['year_of_study']; ?>
                    </p>
                    <input type="text" id="year" placeholder="Enter Year of Study" name="year_of_study">
                </div>

                <div class="form-group">
                    <label for="contact">Contact Number</label>
                    <p class="errors">
                        <?php if (!empty($errors['contact_number'])) echo $errors['contact_number']; ?>
                    </p>
                    <input type="text" id="contact" placeholder="Enter Contact Number" name="contact_number">
                </div>

                <div class="form-group">
                    <label for="email">University Email</label>
                    <p class="errors">
                        <?php if (!empty($errors['university_email'])) echo $errors['university_email']; ?>
                    </p>
                    <input type="email" id="email" placeholder="Enter University Email" name="university_email">
                </div>

                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
