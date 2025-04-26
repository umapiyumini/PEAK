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

        .save-btn {
            width: 100%;
            padding: 15px;
            background-color: #5a2e8a;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .save-btn:hover {
            background-color: #7a4bb8;
        }
    </style>
</head>
<body>
    <?php include 'nav.view.php'; ?>

    <div class="form-container" id="notice-form">
        <h1>Edit Notice</h1>
        <form action="<?= ROOT ?>/amalgamated/Editnotice/<?= $notice->noticeid ?>" method="POST" id='notice-form'>
  
            <div class="form-group">
                <label for="title">Notice Title</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($notice->title) ?>" readonly>
            </div>
            
            <div class="form-group">
                <label for="content">Notice Content</label>
                <textarea id="content" name="content" rows="6" readonly><?= htmlspecialchars($notice->content) ?></textarea>
            </div>
            <div class="form-group">
                <label for="publish-date">Publish Date</label>
                <input type="date" name='publishdate' id="publish-date" value="<?= htmlspecialchars($notice->publishdate) ?>" readonly>
            </div>
            <div class="form-group">
                <label for="publish-time">Publish Time</label>
                <input type="time" name='publishtime' id="publish-time" value="<?= htmlspecialchars($notice->publishtime) ?>" readonly>
            </div>
            <button type='submit' class='save-btn' id='save-btn' style='display: none;'>Save</button>
            <button class="submit-btn" id='update-btn'>Edit</button>
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const noticeForm = document.querySelector('form#notice-form');
            const saveBtn = document.getElementById('save-btn');
            const updateBtn = document.getElementById('update-btn');
            const time = document.getElementById('publish-time');
            const inputs = noticeForm.querySelectorAll('input:not(#publish-date):not(#publish-time), textarea');

            // Function to update the time
            const updateTime = () => {
                const currentTime = new Date();
                const formattedTime = currentTime.toTimeString().split(' ')[0].slice(0, 5); // HH:MM
                time.value = formattedTime;
            };

            updateBtn.addEventListener('click', (e) => {
                e.preventDefault();

                // Allow editable fields, except date/time
                inputs.forEach(input => {
                    input.removeAttribute("readonly");
                });

                saveBtn.style.display = 'inline-block';
                updateBtn.style.display = 'none';
            });

            saveBtn.addEventListener('click', (e) => {
                e.preventDefault();

                // Update the time field
                updateTime();

                // Confirm before submitting
                const userConfirmed = confirm("Are you sure you want to update this notice?");
                if (userConfirmed) {
                    noticeForm.submit();
                }
            });
        });
    </script>
</body>
</html>
