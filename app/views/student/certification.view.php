<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requesting for Certificates</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        .form-container {
            background-color: #ffffff;
            width: 85%;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-left: 220px;
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
        .form-group input, .form-group select {
            width: 95%;
            padding: 10px;
            margin-top: 5px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group input:focus, .form-group select:focus {
            border-color: #007BFF;
            outline: none;
        }
        .submit-btn {
            width: 96%;
            padding: 15px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include 'nav.view.php'; ?>

    <div class="form-container" id="inventory-form">
        <h1>Requesting for Certificates</h1>
        <form>
            <!-- New Form Fields as per your request -->
           
            <div class="form-group">
                <label for="full-name">Name in Full</label>
                <input type="text" id="full-name" placeholder="Enter Full Name">
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="registration-no">Student Registration No.</label>
                <input type="text" id="registration-no" placeholder="Enter Registration No.">
            </div>
            <div class="form-group">
                <label for="contact">Contact Number</label>
                <input type="tel" id="contact" placeholder="Enter Contact Number">
            </div>
            <div class="form-group">
                <label for="whatsapp">Whatsapp Number</label>
                <input type="tel" id="whatsapp" placeholder="Enter Whatsapp Number">
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" placeholder="Enter Email Address">
            </div>
            <div class="form-group">
                <label for="year-study">Year of Study (if undergraduate)</label>
                <input type="number" id="year-study" placeholder="Enter Year of Study">
            </div>
            <div class="form-group">
                <label for="final-exam-year">Year of Completing Final Exam</label>
                <input type="number" id="final-exam-year" placeholder="Enter Final Exam Completion Year">
            </div>

            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>

</body>
</html>
