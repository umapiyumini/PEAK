<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Request</title>
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

        input[type="text"], input[type="number"], textarea, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        textarea {
            height: 120px;
            resize: vertical;
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
        <div class="form-container" id="certificate-form">
            <h1>Enhancement Request</h1>
            <form method="POST" action="<?= ROOT ?>/student/Enhancement/edit">

                <div class="form-group">
                    <label for="RequestId">Request Id</label>
                    <input type="number" id="RequestId" placeholder="" name="RequestId" value="<?= $data['RequestId'] ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <p class="errors"><?php if (!empty($errors['name'])) { echo $errors['name']; } ?></p>
                    <input type="text" id="name" placeholder="Enter Full Name" name="name">
                </div>

                <div class="form-group">
                    <label for="registration-id">Student Registration Number</label>
                    <p class="errors"><?php if (!empty($errors['registration_number'])) { echo $errors['registration_number']; } ?></p>
                    <input type="text" id="registration-id" placeholder="Enter Registration Number" name="registration_number">
                </div>

              

                <div class="form-group">
                    <label for="sport-name">Sport Name</label>
                    <p class="errors"><?php if (!empty($errors['sport'])) { echo $errors['sport']; } ?></p>
                    <input type="text" id="sport-name" placeholder="Enter Sport Name" name="sport">
                </div>

                <div class="form-group">
    <label for="achievement">Achievement</label>
    <p class="errors"><?php if (!empty($errors['achievement'])) echo $errors['achievement']; ?></p>
    <input type="text" id="achievement" name="achievement" placeholder="Enter Achievement">
</div>


                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>