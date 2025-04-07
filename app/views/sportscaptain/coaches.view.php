<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coaches Details</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/coaches.css">
</head>
    <body>
    <div class="navbar">
    <a href="sportprofile">Home</a>
            <a href="sportattendance">Attendance</a>
            <a href="team">Team</a>
            <a href="coaches">Coaches</a>
            <a href="schedule">Schedule</a>
            <a href="sportrecords">Records</a>
    </div>
        <div class="container">
            <h1>Coaches and Instructors</h1>
        
            <section>
                <div id="combined-container" class="tiles-container">
                    <?php if (!empty($coaches)): ?>
                        <?php foreach ($coaches as $coach): ?>
                            <div class="tile">
                                <div class="tile-header">
                                    <h2><?php echo htmlspecialchars($coach->name);?></h2>
                                    <p><?php echo htmlspecialchars($coach->role);?></p>
                                </div>
                                <div class="tile-body">
                                    <p><strong>Email:</strong> <?php echo htmlspecialchars($coach->email);?></p>
                                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($coach->phone);?></p>
                                    <p><strong>Address:</strong> <?php echo htmlspecialchars($coach->address);?></p>
                                    <p><strong>Experience:</strong> <?php echo htmlspecialchars($coach->experience);?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No coaches found</p>
                    <?php endif; ?>
                </div>
            </section>
        </div>    
    <!--script src="<?=ROOT?>/assets/js/vidusha/coaches.js"></script-->
</body>
</html>
