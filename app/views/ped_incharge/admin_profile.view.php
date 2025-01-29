<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/home.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <style>
       /* Hello World */

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        .profile-header {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            gap: 30px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .profile-image {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info {
            flex: 1;
            min-width: 300px;
        }

        .profile-info h1 {
            color: #333;
            margin-bottom: 10px;
        }

        .profile-info .title {
            color: #666;
            font-size: 1.1em;
            margin-bottom: 20px;
        }

        .contact-info {
            display: grid;
            gap: 10px;
            margin-bottom: 20px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #555;
        }

        .profile-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .section {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .section h2 {
            color: #333;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }

        .sport-list, .responsibility-list {
            list-style: none;
        }

        .sport-list li, .responsibility-list li {
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
            color: #555;
        }

        .sport-list li:last-child, .responsibility-list li:last-child {
            border-bottom: none;
        }

        .edit-btn {
            background: #1e3c72;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            cursor: pointer;
            float: right;
        }

        .edit-btn:hover {
            background: #2a5298;
        }

        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .contact-info {
                justify-content: center;
            }

            .profile-content {
                grid-template-columns: 1fr;
            }
        }
    </style>

</head>
<body>
	<header>
        <div class="header-container">
            <div class="logo">
                <img src="?=ROOT?>/assets/images/ped_incharge/logo.png" alt="PEAK Logo">
            </div>
			<button class="hamburger" onclick="toggleMenu()">&#9776;</button>
            <nav>
                <ul>
                    <li><a href="#" class="active">Home</a></li>
                    <li><a href="ground_reservation.php">Dashboard</a></li>
                    <li><a href="#" >About</a></li>
                </ul>
            </nav>
			<button class="bell-icon">
                <i class="uil uil-bell"></i>
            </button>
            <div class="profile-icon">
                <img src="?=ROOT?>/assets/iamges/ped_incharge/pro_icon.png" alt="Profile Icon">
            </div>
        </div>
		
		<div class="dropdown-menu" id="dropdownMenu">
            <ul>
                <li><a href="#"><i class="uil uil-user"></i> My Profile</a></li>
                <li><a href="#"><i class="uil uil-signout"></i> Log out</a></li>
            </ul>
		</div>
    </header>

 <main>
 <div class="container">
        <div class="profile-header">
            <div class="profile-image">
                <img src="?=ROOT?>/assets/images/ped_incharge/sujan.jpg" alt="Profile Photo">
            </div>
            <div class="profile-info">
                <button class="edit-btn" onclick="editProfile()">Edit Profile</button>
                <h1>Sujan Perera</h1>
                <div class="title">Physical Education Instructor</div>
                <div class="contact-info">
                     <div class="contact-item">
                        <strong>Staff ID:</strong> ped72672
                    </div>
                    <div class="contact-item">
                        <strong>NIC:</strong> 1233456786
                    </div>
                    <div class="contact-item">
                        <strong>Email:</strong> sujan@university.edu
                    </div>
                    <div class="contact-item">
                        <strong>Phone:</strong> +94 546 654 345
                    </div>
                    <div class="contact-item">
                        <strong>Office:</strong> PED Main Office
                    </div>
                </div>
            </div>
        </div>

        <div class="profile-content">
            <div class="section">
                <h2>Sports Managed</h2>
                <ul class="sport-list">
                    <li>Basketball</li>
                    <li>Football</li>
                    <li>Rowing</li>
                    <li>Table Tennis</li>
                </ul>
            </div>

            <div class="section">
                <h2>Key Responsibilities</h2>
                <ul class="responsibility-list">
                    <li>Physical Education Class Instruction</li>
                    <li>Sports Inventory Management</li>
                    <li>Tournament Organization</li>
                    <li>Facility Scheduling</li>
                    <li>Budget Administration</li>
                </ul>
            </div>

        </div>
    </div>

</main>
	<script src="?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>

