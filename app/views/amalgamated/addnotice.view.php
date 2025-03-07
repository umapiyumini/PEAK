<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Notice</title>
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
            margin-left: 220px;
        }
        h1 {
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
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group input:focus, .form-group textarea:focus {
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
    <?php include 'nav.view.php'; ?>

    <div class="form-container" id="notice-form">
        <h1>Add New Notice</h1>
        <form action="<?=ROOT?>/amalgamated/Submit" method="POST" id='notice-form'>
            <div class="form-group">
                <label for="title">Notice Title</label>
                <input type="text" id="title" name="title" placeholder="Enter Notice Title" required>
            </div>
            <div class="form-group">
                <label for="content">Notice Content</label>
                <textarea id="content" name="content" rows="6" placeholder="Enter Notice Content" required></textarea>
            </div>
            <div class="form-group">
                <label for="publish-date">Publish Date</label>
                <input type="date" id="publish-date" name="publishdate" required readonly>
            </div>
            <div class="form-group">
                <label for="publish-time">Publish Time</label>
                <input type="time" id="publish-time" name="publishtime" required readonly>
            </div>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>

    <script>
        window.onload = function() {
            var currentDate = new Date();
            var formattedDate = currentDate.toISOString().split('T')[0]; // YYYY-MM-DD
            var formattedTime = currentDate.toTimeString().split(' ')[0].slice(0, 5); // HH:MM

            // Set the auto-filled values
            document.getElementById('publish-date').value = formattedDate;
            document.getElementById('publish-time').value = formattedTime;
        }
    </script>
</body>
</html>
