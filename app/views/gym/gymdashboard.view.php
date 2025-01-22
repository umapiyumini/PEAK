

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/gymdashboard.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/ped.css">
</head>
<body>
    <!-- Breadcrumb -->
    <header>
        <div class="header-container">
            <div class="breadcrumb-bar">
                <span>Home</span> > <span>Dashboard</span> > <span id="currentPage">Gym Calendar</span>
            </div>
           
            <div class="profile-icon">
                <img src="<?=ROOT?>/assets/images/vidusha/pro_icon.png" alt="Profile Icon">
            </div>
        </div>
        <div class="dropdown-menu" id="dropdownMenu">
        <ul>
            <li><a href="#"><i class="uil uil-user"></i> My Profile</a></li>
            <li><a href="#"><i class="uil uil-signout"></i> Log out</a></li>
        </ul>
    </div>
    </header>
    <!-- Sidebar -->
    <div class="sidebar">
        <img src="<?=ROOT?>/assets/images/vidusha/pedlogo.png" alt="PEAK Logo" class="ped-logo">
        <ul>
            <li><img src="<?=ROOT?>/assets/images/vidusha/calendar.png" alt="Calendar Icon" class="icon"><a href="#" onclick="loadContent('gymcalendar','Gym Calendar')">Gym Calender</a></li>
            <li><img src="<?=ROOT?>/assets/images/vidusha/entry.png" alt="request Icon" class="icon"><a href="#" onclick="loadContent('gymentry','Entry Request')">Entry Request</a></li>
            <li><img src="<?=ROOT?>/assets/images/vidusha/plans.png" alt="Plans Icon" class="icon"><a href="#" onclick="loadContent('equipments','Gym Equipments')">Gym Equipments</a></li>
            <li><img src="<?=ROOT?>/assets/images/vidusha/rules.png" alt="Rules Icon" class="icon"><a href="#"  onclick="loadContent('rules','Rules and Regulations')">Rules & Regulation</a></li>
            <li><img src="<?=ROOT?>/assets/images/vidusha/logout.png" alt="Rules Icon" class="icon"><a href="../login"  onclick="loadContent('rules','Rules and Regulations')">Logout</a></li>
        </ul>
    </div>

    
    
    <!-- Content Area -->
    <div class="content">
        <div class="dashboard">
            <!-- Dashboard content goes here -->
            <iframe id="contentFrame" class="embedded-content" src="gymcalendar"></iframe>
            
        </div>
    </div>

    <script>
        function loadContent(page, pageName) {
            document.getElementById('contentFrame').src = page; // Load the content in iframe
            document.getElementById('currentPage').textContent = pageName; // Update breadcrumb text
        }
    </script>

</body>
</html>
