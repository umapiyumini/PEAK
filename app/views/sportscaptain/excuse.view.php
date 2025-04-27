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
    <div class = "container">

    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success'] ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error'] ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <div class="form-container" id="attendance-form">
        <h1>Attendance Excuse Letter</h1>
        <h3>Fill the Details</h3>
        <form  action="<?=ROOT?>/sportscaptain/excuse/addexcusedata" method="POST">
            <div class="form-group">
                <label for="faculty">Faculty</label>
                <select id="faculty" name="faculty" required>
                    <option value="">Select Faculty</option>
                    <?php foreach($data['faculties'] as $faculty): ?>
                        <option value="<?=$faculty->faculty_name?>"><?=$faculty->faculty_name?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tournament">Tournament Name</label>
                <input type="text" id="tournament" name="tournament_name" placeholder="Enter Tournament Name">
            </div>
            <div class="form-group">
                <label for="startDate">Tournament Start Date</label>
                <input type="date" id="startDate" name="start_date" placeholder="Enter Tournament Start Date">
            </div>
            <div class="form-group">
                <label for="endDate">Tournament End Date</label>
                <input type="date" id="endDate" name="end_date" placeholder="Enter Tournament End Date">
            </div>
            <div class="form-group">
                <label for="regNo">Registration No:</label>
                <div id="playerContainer">
                        <input type="text" class="regNo" name="reg_no[]" placeholder="Enter Registration No" required> 
                </div>
                <button type="button" class="addRegNoBtn">Add</button>
            </div>
            <div class="form-group">
                <label for="submitiondate">Submition Date</label>
                <input type="date" id="subDate" name="submit_date" placeholder="Enter Submition Date">
            </div>
            <input type="hidden" name="status" value="Pending">
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>

    <div class="request-container">
        <h2>Previous Requests</h2>
        <?php if(!empty($data['excuse'])): ?>
            <?php foreach($data['excuse'] as $item): ?>
        <div id="request-list" class="grid">
            <div class="request-item">
                <p><strong>Faculty :</strong><?=$item->faculty?></p>
                <p><strong>Tournament :</strong><?=$item->tournament_name?></p>
                <p><strong>Date :</strong><?=$item->submit_date?></p>
                <p><strong>Status :</strong><?=$item->status?></p>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
            <p>No previous requests</p>
        <?php endif;?>
    </div>
</div>         
    <script src="<?=ROOT?>/assets/js/vidusha/excuse.js"></script>
</body>
</html>
