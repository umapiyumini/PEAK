<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request for Enhancement</title>
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
            width: 84%;
            padding: 30px;
            border-radius: 8px;
            
            margin-left: 280px;
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

    <div class="form-container" id="achievement-form">
        <h1>Enhancement Subject Request</h1>
        <form>
            <div class="form-group">
                <label for="name-with-initials">Name with Initials</label>
                <input type="text" id="name-with-initials" placeholder="Enter Name with Initials" required>
            </div>
            <div class="form-group">
                <label for="index-number">Index Number</label>
                <input type="text" id="index-number" placeholder="Enter Index Number" required>
            </div>
            <div class="form-group">
                <label for="registration-number">Registration Number</label>
                <input type="text" id="registration-number" placeholder="Enter Registration Number" required>
            </div>
            <div class="form-group">
                <label for="sport-name">Name of Sport</label>
                <input type="text" id="sport-name" placeholder="Enter Name of Sport" required>
            </div>
            <div class="form-group">
                <label for="year-of-achievement">Year of Achievement</label>
                <input type="number" id="year-of-achievement" placeholder="Enter Year of Achievement" required>
            </div>
            <div class="form-group">
                <label for="achievement-level">Achievement Level</label>
                <select id="achievement-level" required>
                    <option value="" disabled selected>Select Achievement Level</option>
                    <option value="university">University Level</option>
                    <option value="national">National Level</option>
                    <option value="international">International Level</option>
                    <option value="university-colours">University Colours</option>
                    <option value="slusa-colours">SLUSA Colours</option>
                </select>
            </div>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
</body>
</html>
