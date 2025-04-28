<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Management Sidebar</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        :root {
            --primary-color: #3E034A;
            --secondary-color: #A87BBE;
            --success-color: #59056a;
            --danger-color: #ef4444;
            --edit-color: rgb(93, 93, 247);
            --view-color:  rgb(61, 187, 115);
            --background-color: #f1f1f1;
            --header-color: #333;
            --white: #ffffff;
            --gray-light: #f0f0f0;
            --gray: #7f7f7f;
            --res-external:rgb(148, 214, 142);
            --res-sports: rgb(108, 136, 222);
            --res-special:rgb(222, 136, 121);
        }

        body {
            display: flex;
        }

        .sidebar {
            height: 100vh;
            width: 4rem; 
            transition: width 0.3s ease;
            background-color:#2B124C;
            position: fixed;
            left: 0;
            top: 0;
            border-radius: 8px;
            z-index: 1000;
            flex-direction: column;
            display: flex;
            transition: all 0.3s ease;
            overflow-x: hidden;
        }

        .sidebar:hover {
            width: 250px;
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: 60px;
        }

        .nav-list::-webkit-scrollbar {
            width: 0.4rem;
            display: none;
        }

        .nav-list::-webkit-scrollbar-track {
            background-color: #cecdce;
        }

        .nav-list::-webkit-scrollbar-thumb {
            background-color: #b6b4b4;
            border-radius: 8px;
        }

        .nav-list::-webkit-scrollbar-thumb:hover {
            background-color: #a1a0a0;
        }

        .logo {
            padding: 2rem;
            text-align: center;
            border-bottom: 1px solid #b6b4b4;
            background: linear-gradient(to bottom, rgba(255,255,255,0.2), transparent);
             flex-shrink: 0;
            transition: opacity 0.3s ease, transform 0.3s ease;
            position: relative;
        }

        .sidebar.collapsed .logo-expanded {
            opacity: 0;
            transform: scale(0);
            height: 0;
            padding: 0;
        }

        .logo img {
            width: 11rem;
            margin: 0;
            transition: transform 0.3s ease;
        }

        .logo img:hover {
            transform: scale(1.05);
        }

        .logo .logo-expanded {
            display: block;
        }

        .logo .logo-collapsed {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 40px;
        }

        .sidebar.collapsed .logo .logo-expanded {
            display: none;
        }

        .sidebar.collapsed .logo .logo-collapsed {
            display: block;
        }

        .nav-list {
            list-style: none;
            padding-left: 1.0rem;
            flex-grow: 1;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .nav-item {
            margin: 20px 0;
            position: relative;
            white-space: nowrap;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 10px;
            text-decoration: none;
            color: #F8F6FB;
            font-size: 14px;
            border-radius: 6px;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
          
        }

        .nav-link span {
            opacity: 1;
            transition: opacity 0.3s ease;
            margin-left: 10px;
        }

        .sidebar.collapsed .nav-link span {
            opacity: 0;
            width: 0;
            display: none;
        }

        .nav-link:hover {
            background: linear-gradient(to right, #b6b4b4, transparent);
            transform: translateX(5px);
        }

        .nav-link i {
            min-width: 20px;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
            margin-right: 10px;
        }

        .sidebar.collapsed .nav-link i {
            margin-right: 0;
        }

        .nav-link:hover i {
            transform: scale(1.2);
        }

        /* dropdown */
        .dropdown {
            height: 0;
            overflow: hidden;
            margin-left: 2.8rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background-color: rgba(182, 180, 180, 0.2);
            border-radius: 6px;
            opacity: 0;
            transform: translateY(-10px);
        }

        .dropdown.active {
            height: auto;
            padding: 0.3rem 0;
            opacity: 1;
            transform: translateY(0);
            
        }

        .dropdown-link {
            display: block;
            padding: 8px 12px;
            text-decoration: none;
            color: #F8F6FB;
            font-size: 13px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            white-space: nowrap;
        }

        .dropdown-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background-color: rgba(182, 180, 180, 0.3);
            transition: width 0.3s ease;
            z-index: -1;
        }

        .dropdown-link:hover::before {
            width: 100%;
        }

        .dropdown-link:hover {
            transform: translateX(5px);
            color: #F8F6FB;
        }

        


        .uil-angle-down{
            text-align: right;
            margin-left: 0.5rem;
        }

        .sidebar.collapsed .dropdown,
        .sidebar.collapsed .arrow {
            display: none;
        }


          /* Add profile section styles */
          .profile-section {
            padding: 1rem;
            border-top: 1px solid #b6b4b4;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: auto;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .profile-section {
            padding: 1rem 0.5rem;
        }

        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info {
            overflow: hidden;
            transition: opacity 0.3s ease, width 0.3s ease;
        }

        .sidebar.collapsed .profile-info {
            opacity: 0;
            width: 0;
        }

        .profile-name {
            font-weight: 600;
            font-size: 14px;
            color: #F8F6FB;
            white-space: nowrap;
        }

        .profile-role {
            font-size: 12px;
            color: #F9F6FB;
            white-space: nowrap;
        }




        .sidebar.collapsed .nav-item.actived {
            margin-right: 0;
            background-color:  #F8F6FB;
            color: #fff;
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
        }
      

        .sidebar.collapsed .nav-item.actived i {
            color: black;
        }


        .sidebar.collapsed .nav-item.actived a::before{
            content: "";
            position: absolute;
            right: 0;
            top: -50px;
            width: 50px;
            height: 50px;
            background-color: transparent;
            border-radius: 50%;
            box-shadow: 35px 35px 0 10px  #F8F6FB;
            pointer-events: none;
            z-index: -1;
        }

        .sidebar.collapsed .nav-item.actived a::after{
            content: "";
            position: absolute;
            right: 0;
            bottom: -50px;
            width: 50px;
            height: 50px;
            background-color: transparent;
            border-radius: 50%;
            box-shadow: 35px -35px 0 10px  #F8F6FB;
            pointer-events: none;
            z-index: -1;
        }
       
    </style>
</head>
<body>
    <div class="sidebar collapsed">
        <div class="logo">
            <a href="<?=ROOT?>/ped_incharge/home">
                <img src="<?=ROOT?>/assets/images/ped_incharge/logo.png" alt="Full Logo" class="logo-expanded">
                <img src="<?=ROOT?>/assets/images/ped_incharge/logo_small.png" alt="Compact Logo" class="logo-collapsed">
            </a>
        </div>
        <ul class="nav-list">
            <li class="nav-item has-dropdown <?= $current_page == 'reservation' ? 'actived' : '' ?>">
                <a href="#" class="nav-link">
                    <i class="uil uil-calendar-alt"></i>
                    <span>Reservation</span>
                    <i class="uil uil-angle-down"></i>
                </a>
                <div class="dropdown">
                    <a href="<?=ROOT?>/ped_incharge/ground_reservation" class="dropdown-link">Ground</a>
                    <a href="<?=ROOT?>/ped_incharge/indoor_reservation" class="dropdown-link">Indoor Stadium</a>
                </div>
            </li>
            <li class="nav-item <?= $current_page == 'users' ? 'actived' : '' ?>">
                <a href="<?=ROOT?>/ped_incharge/users" class="nav-link">
                <i class="uil uil-user-circle"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="nav-item <?= $current_page == 'sports' ? 'actived' : '' ?>">
                <a href="<?=ROOT?>/ped_incharge/ped_sports" class="nav-link">
                    <i class="uil uil-basketball"></i>
                    <span>Sports</span>
                </a>
            </li>
            <li class="nav-item <?= $current_page == 'facilities' ? 'actived' : '' ?>">
                <a href="<?=ROOT?>/ped_incharge/ped_facilities" class="nav-link">
                    <i class="uil uil-building"></i>
                    <span>Facilities</span>
                </a>
            </li>
            <li class="nav-item has-dropdown <?= $current_page == 'inventory' ? 'actived' : '' ?>">
                <a href="#" class="nav-link">
                    <i class="uil uil-box"></i>
                    <span>Inventory</span>
                    <i class="uil uil-angle-down"></i>
                </a>
                <div class="dropdown">
                    <a href="<?=ROOT?>/ped_incharge/ped_inventory" class="dropdown-link">Packed Inventory</a>
                    <a href="<?=ROOT?>/ped_incharge/ped_unpackedinventory" class="dropdown-link">Unpacked Inventory</a>
                </div>
            </li>

            <li class="nav-item has-dropdown <?= $current_page == 'staff' ? 'actived' : '' ?>">
                <a href="#" class="nav-link">
                    <i class="uil uil-users-alt"></i>
                    <span>Staff</span>
                    <i class="uil uil-angle-down"></i>
                </a>
                <div class="dropdown">
                    <a href="<?=ROOT?>/ped_incharge/groundindoorstaff" class="dropdown-link">Ground/Indoor Staff</a>
                    <a href="<?=ROOT?>/ped_incharge/ped_staff" class="dropdown-link">PED Staff</a>
                </div>
            </li>

            <li class="nav-item <?= $current_page == 'studentprofile' ? 'actived' : '' ?>">
                <a href="<?=ROOT?>/ped_incharge/students" class="nav-link">
                    <i class="uil uil-user"></i>
                    <span>Student Profile</span>
                </a>
            </li>
            <li class="nav-item <?= $current_page == 'externalcustomers' ? 'actived' : '' ?>">
                <a href="<?=ROOT?>/ped_incharge/external_customer" class="nav-link">
                    <i class="uil uil-external-link-alt"></i>
                    <span>External Customers</span>
                </a>
            </li>
            <li class="nav-item <?= $current_page == 'pool' ? 'actived' : '' ?>">
                <a href="<?=ROOT?>/ped_incharge/pool" class="nav-link">
                    <i class="uil uil-swimmer"></i>
                    <span>Pool passes</span>
                </a>
            </li>
            <li class="nav-item has-dropdown <?= $current_page == 'tournament' ? 'actived' : '' ?>">
                <a href="#" class="nav-link">
                    <i class="uil uil-trophy"></i>
                    <span>Tournament Records</span>
                    <i class="uil uil-angle-down"></i>
                </a>
                <div class="dropdown">
                    <a href="<?=ROOT?>/ped_incharge/interuni_tournaments" class="dropdown-link">Inter University</a>
                    <a href="<?=ROOT?>/ped_incharge/interfaculty_tournaments" class="dropdown-link">Inter Faculty</a>
                </div>
            </li>
            <li class="nav-item has-dropdown <?= $current_page == 'letters' ? 'actived' : '' ?>">
                <a href="#" class="nav-link">
                    <i class="uil uil-file-alt"></i>
                    <span>Letters</span>
                    <i class="uil uil-angle-down"></i>
                </a>
                <div class="dropdown">
                    <a href="<?=ROOT?>/ped_incharge/enhancement" class="dropdown-link">Enhancement</a>
                    <a href="<?=ROOT?>/ped_incharge/attendance" class="dropdown-link">Attendance Excuse</a>
                </div>
            </li>
            <li class="nav-item <?= $current_page == 'otherforms' ? 'actived' : '' ?>">
                <a href="<?=ROOT?>/ped_incharge/otherforms" class="nav-link">
                    <i class="uil uil-file-plus-alt"></i>
                    <span>Other Forms</span>
                </a>
            </li>
        </ul>
        <a href="<?=ROOT?>/ped_incharge/admin_profile" style="text-decoration:none;">
        <div class="profile-section">
            <div class="profile-pic">
                <img src="<?=ROOT?>/assets/images/ped_incharge/sujan.jpg" alt="Profile Picture">
            </div>
           
            <div class="profile-info">
                <div class="profile-name">Sujan Perera</div>
                <div class="profile-role">Admin</div>
            </div>
            
        </div>
        </a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            const itemsWithDropdown = document.querySelectorAll('.has-dropdown');
            let activeDropdown = null;
            let sidebarTimeout;

            function closeDropdown(item) {
                item.classList.remove('active');
                const dropdown = item.querySelector('.dropdown');
                dropdown.style.opacity = '0';
                dropdown.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    dropdown.classList.remove('active');
                    dropdown.style.height = '0';
                }, 200);
            }

            function openDropdown(item) {
                if (activeDropdown && activeDropdown !== item) {
                    closeDropdown(activeDropdown);
                }
                item.classList.add('active');
                const dropdown = item.querySelector('.dropdown');
                dropdown.classList.add('active');
                dropdown.style.height = dropdown.scrollHeight + 'px';
                setTimeout(() => {
                    dropdown.style.opacity = '1';
                    dropdown.style.transform = 'translateY(0)';
                }, 50);
                activeDropdown = item;
            }

            function collapseSidebar() {
                sidebar.classList.add('collapsed');
                if (activeDropdown) {
                    closeDropdown(activeDropdown);
                    activeDropdown = null;
                }
            }

            function expandSidebar() {
                sidebar.classList.remove('collapsed');
            }

            sidebar.addEventListener('mouseenter', () => {
                clearTimeout(sidebarTimeout);
                expandSidebar();
            });

            sidebar.addEventListener('mouseleave', () => {
                sidebarTimeout = setTimeout(collapseSidebar, 300);
            });

            itemsWithDropdown.forEach(item => {
                const link = item.querySelector('.nav-link');
                
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();

                    if (item.classList.contains('active')) {
                        closeDropdown(item);
                        activeDropdown = null;
                    } else {
                        openDropdown(item);
                    }
                });
            });

            document.addEventListener('click', (e) => {
                if (!e.target.closest('.has-dropdown') && activeDropdown) {
                    closeDropdown(activeDropdown);
                    activeDropdown = null;
                }
            });
            

            
        });


        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');

            sidebar.addEventListener('mouseover', () => {
                mainContent.style.marginLeft = '250px'; 
            });

            sidebar.addEventListener('mouseout', () => {
                mainContent.style.marginLeft = '4rem'; 
            });
        });

        
    </script>
</body>
</html>