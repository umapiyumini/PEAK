<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Certificate Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .form-container {
            background-color: #ffffff;
            width: 100%%;
            padding: 30px;
            border-radius: 8px;
            margin-left: 280px;
            height: 100vh;
        }
        h1, h3 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-size: 14px;
            color: #555;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            border-color: #007BFF;
            outline: none;
        }
        .submit-btn {
            width: 100%;
            padding: 15px;
            background-color: #5a2e8a;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #7a4bb8;
        }
    </style>
</head>
<body>
    <?php include 'nav.view.php';?>

    <div class="form-container" id="medical-form">
        <h1>Medical Request</h1>
        <form>
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" placeholder="Enter Full Name">
            </div>
            
            <div class="form-group">
                <label for="registration-id">Student Registration ID</label>
                <input type="text" id="registration-id" placeholder="Enter Registration ID">
            </div>
            <div class="form-group">
                <label for="medical-reason">Reason for Medical</label>
                <textarea id="medical-reason" placeholder="Enter Reason for Medical" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="medical-duration">How long did the medical take?</label>
                <input type="text" id="medical-duration" placeholder="Enter Duration of Medical (e.g., 1 week)">
            </div>

            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>

</body>
</html>
