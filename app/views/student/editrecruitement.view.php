<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approval Form</title>
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

        input[type="text"],input[type="number"],
        textarea,
        select {
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
        <div class="form-container">
            <h1>Approval Form</h1>
            <form method="POST" action="<?= ROOT ?>/student/Recruitement/Edit">

            <div class="form-group">
                        <label for="name">Request Id</label>
                        <input type="number" id="RequestId" placeholder="" name="recruitmentid" value="<?= $data['recruitmentid'] ?>" readonly>
                    </div>


            
                
                    <div class="form-group">
                    <label for="reg-no">Registration Number</label>
                    <p class="errors"><?php if (!empty($errors['regno'])) echo $errors['regno']; ?></p>
                    <input type="text" id="reg-no" name="regno" placeholder="Enter Registration Number" required>
                </div>


                <div class="form-group">
                    <label for="faculty">Faculty</label>
                    <p class="errors"><?php if (!empty($errors['faculty'])) echo $errors['faculty']; ?></p>
                    <input type="text" id="faculty" name="faculty" placeholder="Enter Faculty" required>
                </div>


                
                <div class="form-group">
    <label for="name">Sport</label>
    <p class="errors"><?php if (!empty($errors['name'])) echo $errors['name']; ?></p>
    <select id="name" name="sport_id" required>
        
        <option value="1">Cricket</option>
        <option value="2">Baseball</option>
        <option value="3">Hockey</option>
        <option value="4">Football</option>
        
    </select>
</div>


                <div class="form-group">
                    <label for="reason">Reason</label>
                    <p class="errors"><?php if (!empty($errors['reason'])) echo $errors['reason']; ?></p>
                    <textarea id="reason" name="reason" rows="4" placeholder="Enter Reason" required></textarea>
                </div>

                <input type="hidden" name="status" value="pending">

                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
