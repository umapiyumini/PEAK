<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/sportcaptaindashboard.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/ped.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <!-- Breadcrumb -->
    <header>
        <div class="header-container">
            <div class="breadcrumb-bar">
                <span><a href="sportcaptainhome">Home</a></span> > <span>Dashboard</span> > <span id="currentPage">Sport Profile</span>
            </div>
           
            <div class="profile-icon">
                <img src="<?=ROOT?>/assets/images/vidusha/pro_icon.png" alt="Profile Icon">
            </div>
        </div>
        <div class="dropdown-menu" id="dropdownMenu">
        <ul>
            <li><a href="studentprofiles"><i class="uil uil-user"></i> My Profile</a></li>
            <li><a href="../login"><i class="uil uil-signout"></i> Log out</a></li>
        </ul>
    </div>
    </header>
    <!-- Sidebar -->
    <div class="sidebar">
        <img src="<?=ROOT?>/assets/images/vidusha/pedlogo.png" alt="PEAK Logo" class="ped-logo">
        <ul>
            <li>
                <img src="<?=ROOT?>/assets/images/vidusha/sport.png" alt="Sport Icon" class="icon">
                <a href="#" onclick="loadContent('sportprofile', 'Sport Profile')">Sport Profile</a>
            </li>
            <li>
                <img src="<?=ROOT?>/assets/images/vidusha/event.png" alt="Reservation Icon" class="icon">
                <a href="#" onclick="loadContent('reservation', 'Reservation')">Reservation</a>
            </li>
            
            <li>
                <img src="<?=ROOT?>/assets/images/vidusha/forms.png" alt="Forms Icon" class="icon">
                <a href="#" onclick="loadContent('excuse', 'Forms')">Forms</a>
            </li>
            <li>
                <img src="<?=ROOT?>/assets/images/vidusha/inventory.png" alt="Unpacked Icon" class="icon">
                <a href="#" onclick="loadContent('inventoryunpacked', 'Inventory')">Inventory</a>
            </li>
            <li>
                <img src="<?=ROOT?>/assets/images/vidusha/tournament.png" alt="Tournament Icon" class="icon">
                <a href="#" onclick="loadContent('tournamentrecords', 'Tournamentrecords')">Tournaments</a>
            </li>
            <li>
                <img src="<?=ROOT?>/assets/images/vidusha//recruitment.png" alt="Recruitment Icon" class="icon">
                <a href="#" onclick="loadContent('recruitment', 'Recruitment')">Recruitment</a>
            </li>
            
            <li>
                <img src="<?=ROOT?>/assets/images/vidusha/calendar.png" alt="Calendar Icon" class="icon">
                <a href="#" onclick="loadContent('upcoming', 'Upcoming')">Upcoming Events</a>
            </li>
            <li>
                <img src="<?=ROOT?>/assets/images/vidusha/switch.png" alt="Calendar Icon" class="icon">
                <a href="../choose2">Switch User</a>
            </li>
            <li>
                <img src="<?=ROOT?>/assets/images/vidusha/logout.png" alt="Logout Icon" class="icon">
                <a href="../login">Log out</a>    
            </li>
        </ul>
    </div>

    <!-- Content Area -->
    <div class="dashboard">
        <iframe id="contentFrame" class="embedded-content" src="sportprofile"></iframe>
    </div>
    <script src="<?=ROOT?>/assets/js/vidusha/sportcaptaindashboard.js"></script>
    </body>
    </html>