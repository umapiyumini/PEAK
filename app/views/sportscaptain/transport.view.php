<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transport Form</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/transport.css">
</head>
<body>
    <div class="navbar">
    <a href="excuse">Attendance Excuse Letter</a>
        <a href="hostal">Hostal Facilities</a>
        <a href="transport">Transport</a>
        <a href="colorsnight">Colors Night</a>
    </div>
    <!-- Transport Form -->
    <div class="container">
            <div class="form-container" id="transport-form">
            <h1>Transport Request Form</h1>
            <form id="transport" action="<?=ROOT?>/sportscaptain/transport/addtransportrequest" method="POST">
                <!-- Form Group with Labels -->
                <div class="form-group">
                    <label for="members">Number of Members:</label>
                    <input type="text" id="members" name="no_of_members" placeholder="Enter Number of Members" required>
                </div>

                <div class="form-group">
                    <label for="Date">Date:</label>
                    <input type="date" name="date" id="Date" required>
                </div>

                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" name="location" id="location" placeholder="Enter Location" required>
                </div>

                <div class="form-group">
                    <label for="time">Time:</label>
                    <input type="time" name="time" id="time" required>
                </div>

                <div class="form-group">
                    <label for="reason">Reason:</label>
                    <textarea id="reason" name="reason" rows="4" placeholder="Enter reason"></textarea>
                </div>
                <input type="hidden" name="status" value="Pending">
                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>

        <div class="request-container">
        <h2>Previous Requests</h2>
        <?php if(!empty($data['requests'])): ?>
            <?php foreach($data['requests'] as $item): ?>
        <div id="request-list" class="grid">
            <div class="request-item">
                <p><strong>Reason :</strong><?=$item->reason?></p>
                <p><strong>Date :</strong><?=$item->date?></p>
                <p><strong>Time :</strong><?=$item->time?></p>
                <p><strong>Location :</strong><?=$item->location?></p>
                <p><strong>Status :<?=$item->status?></strong></p>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
            <p>No previous requests</p>
        <?php endif;?>
    </div>
    
</body>
</html>
