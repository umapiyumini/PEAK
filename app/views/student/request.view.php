<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Membership Form</title>
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
            width: 95%;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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

    <div class="form-container" id="team-form">
        <h1>Team Membership Form</h1>
        <form>
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" placeholder="Enter Full Name">
            </div>
            <div class="form-group">
                <label for="student-name">Student Name</label>
                <input type="text" id="student-name" placeholder="Enter Student Name">
            </div>
            <div class="form-group">
                <label for="registration-id">Student Registration ID</label>
                <input type="text" id="registration-id" placeholder="Enter Registration ID">
            </div>
            <div class="form-group">
                <label for="sport-played">Have you played this sport before?</label>
                <select id="sport-played">
                    <option value="" disabled selected>Select an option</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
            <div class="form-group" id="achievements-container" style="display: none;">
                <label for="achievements">If yes, what achievements have you achieved?</label>
                <textarea id="achievements" placeholder="Enter your achievements" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="reason-joining">What is the reason for joining this team?</label>
                <textarea id="reason-joining" placeholder="Enter your reason for joining" rows="4"></textarea>
            </div>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>

    <script>
        // Show/hide achievements field based on sport-played selection
        document.getElementById('sport-played').addEventListener('change', function () {
            const achievementsContainer = document.getElementById('achievements-container');
            achievementsContainer.style.display = this.value === 'yes' ? 'block' : 'none';
        });
    </script>
</body>
</html>
