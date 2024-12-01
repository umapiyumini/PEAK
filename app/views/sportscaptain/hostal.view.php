<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostal Form Details</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/hostal.css">
</head>
<body>

    <div class="navbar">
        <a href="excuse">Attendance Excuse Letter</a>
        <a href="hostal">Hostal Facilities</a>
        <a href="transport">Transport</a>
        <a href="colorsnight">Colors Night</a>
    </div>
    <!-- Team Card Form -->
    <div class="container" id="hostelForm">
        <h1>Requesting Hostel Facilities</h1>
        <form id="form">
            <div class="form-group">
                <label for="regNo">Registration No:</label>
                <div id="playerContainer">
                    <div class="playerGroup">
                        <input type="text" class="regNo" placeholder="Enter Registration No" required>
                        <input type="text" class="priority" placeholder="Priority (1-5)" required>
                    </div>
                </div>
                <button type="button" id="addRegNoBtn">Add</button>
            </div>
            <div class="form-group">
                <label for="startdate">Start Date:</label>
                <input type="date" id="startdate" required>
            </div>
    
            <div class="form-group">
                <label for="enddate">End Date:</label>
                <input type="date" id="enddate" required>
            </div>
    
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
    
    <!-- Table for displaying entered details -->
    <div class="container table-container">
        <h2>Submitted Details</h2>
        <table id="detailsTable">
            <thead>
                <tr>
                    <th>Registration No</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Priority</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dynamic rows will be inserted here -->
            </tbody>
        </table>
    </div>

    <script src="<?=ROOT?>/assets/js/vidusha/hostal.js"></script>
</body>
</html>
