<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/ped_sports.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <?php $current_page = 'sports'; include 'sidebar.view.php'?>

    <?php
        if (isset($_SESSION['error'])) {
            echo "<div id='error-message' style='position: fixed ;top: 20px; right: 20px;background-color:rgb(206, 29, 29);color: white; padding: 15px 20px; border-radius: 5px; z-index: 9999; box-shadow: 0 2px 10px rgba(0,0,0,0.2); transition: opacity 0.5s ease-out;'>"
                . htmlspecialchars($_SESSION['error']) . "</div>";
            unset($_SESSION['error']);
        }

        if (isset($_SESSION['success'])) {
            echo "<div id='success-message' style='position: fixed ;top: 20px; right: 20px;background-color:rgb(57, 184, 11);color: white; padding: 15px 20px; border-radius: 5px; z-index: 9999; box-shadow: 0 2px 10px rgba(0,0,0,0.2); transition: opacity 0.5s ease-out;'>"
                . htmlspecialchars($_SESSION['success']) . "</div>";
            unset($_SESSION['success']);
        }
    ?>

    <div class="main-content">

        <div class="header">
            <h1>Sports</h1>
            <button class="bell-icon"><i class="uil uil-bell"></i></button>
            <div class="notifications-dropdown">
                <div class="notifications-header">
                    <h3>Notifications</h3>
                    <span class="clear-all">Clear All</span>
                </div>
                <div class="notifications-list">
                    <ul id="notificationsList"></ul>
                </div>
            </div>
        
            <button class="bell-icon"><i class="uil uil-signout"></i></button>
        </div>

        <main>
           
            <div class="sports-container" id="sportsContainer">
                <?php foreach($sportsList as $row): ?>
                    <div class="sport-card">
                        <img src="<?=ROOT.'/'.$row->frontimage?>" alt="" class="sport-image">
                        <div class="sport-content">
                            <h3><?=$row->sport_name?></h3>
                        </div>
                        <div class="gender">
                            <a href="sportProfile/<?= $row->sport_id ?>" class="btn btn-male">Men</a>
                            <a href="<?= $row->sport_name ?>" class="btn btn-female">Women</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>


            <button class="add-sport" onclick="openModal()" id="addSportBtn">
                <i class="uil uil-plus"></i>
            </button>
        </main>

        <div class="modal" id="addSportModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 id="modalTitle">Add Sport</h2>
                    <button class="close">&times;</button>
                </div>
                <form action="ped_sports/addSport" id="addSportForm" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="sportName">Sport Name</label>
                        <input type="text" id="sportName" name="sport_name" required>
                    </div>
                    <div class="form-group">
                        <label for="imageUrl">Image URL</label>
                        <input type="file" id="imageUrl" name="image" required>
                    </div>
                    <button type="submit" class="submit-btn">Add Sport</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const fadeOut = (id) => {
                const el = document.getElementById(id);
                if (el) {
                    el.style.opacity = "0";
                    el.style.transform = "translateY(-10px)";
                    setTimeout(() => el.remove(), 500);
                }
            };

            fadeOut('error-message');
            fadeOut('success-message');
        }, 3000);
    </script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/sports.js"></script>
</body>
</html>

