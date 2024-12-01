<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excuse letters</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/excuse.css">
</head>
<body>

    <div class="navbar">
    <a href="excuse">Attendance Excuse Letter</a>
        <a href="hostal">Hostal Facilities</a>
        <a href="transport">Transport</a>
        <a href="colorsnight">Colors Night</a>
    </div>
    <div class="form-container" id="inventory-form">
        <h1>Attendance Excuse Letter</h1>
        <h3>Fill the Details</h3>
        <form>
            <div class="form-group">
                <label for="faculty">Faculty</label>
                <input type="text" id="faculty" placeholder="Enter Faculty">
            </div>
            <div class="form-group">
                <label for="sport">Sport</label>
                <input type="text" id="sport" placeholder="Enter Sport">
            </div>
            <div class="form-group">
                <label for="tournament">Tournament Name</label>
                <input type="text" id="tournament" placeholder="Enter Tournament Name">
            </div>
            <div class="form-group">
                <label for="startDate">Tournament Start Date</label>
                <input type="date" id="startDate" placeholder="Enter Tournament Start Date">
            </div>
            <div class="form-group">
                <label for="endDate">Tournament End Date</label>
                <input type="date" id="endDate" placeholder="Enter Tournament End Date">
            </div>
            <div class="form-group">
                <label for="regNo">Registration No:</label>
                <div id="playerContainer">
                        <input type="text" class="regNo" placeholder="Enter Registration No" required> 
                </div>
                <button type="button" class="addRegNoBtn">Add</button>
            </div>
            <div class="form-group">
                <label for="submitiondate">Submition Date</label>
                <input type="date" id="subDate" placeholder="Enter Submition Date">
            </div>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
    <script src="<?=ROOT?>/assets/js/vidusha/excuse.js"></script>
</body>
</html>
