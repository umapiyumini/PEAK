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

   


.logo img {
    max-height:70px;
	widows: auto;
}

nav ul {
    list-style: none;
    display: flex;
    gap: 30px;
	justify-content: flex-start;
	padding: 0;
	margin: 0;
}

nav{
	flex-grow: 1;
}

nav a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    padding: 5px 10px;
}

nav a.active {
  color:white;
  font-weight: bold;

}

.bell-icon, .profile-icon {
    cursor: pointer;
    justify-content: flex-end;

    
}

.bell-icon {
    background-color: transparent;
    border: none;
    font-size: 30px;
    color: #7f7f7f;
}
.bell-icon :hover{
    color: white;
}
.profile-icon img {
    height: 35px;
    border-radius: 50%;
    transition: border 0.3s ease;
}

.profile-icon img:hover {
    border: 2px solid #A87BBE;
}

        body {
            background-color: #D8BFD8   ;
        }

        .sidebar {
            height: 100vh;
            width: 18%;  
            background-color: #340335;  
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
            border-radius: 8px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .sidebar::-webkit-scrollbar {
            width: 0.4rem;
        }

        .sidebar::-webkit-scrollbar-track {
            background-color: #cecdce;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background-color: #b6b4b4;
            border-radius: 8px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background-color: #a1a0a0;
        }

        .logo {
            padding: 2rem;  
            text-align: center;
            border-center: 1px solid #b6b4b4;
            background: linear-gradient(to bottom, rgba(255,255,255,0.1), transparent);
            width: 100px;
            height: 100px;
        }

        .logo img {
            width: 08rem;  
            margin: 0;
            transition: transform 0.3s ease;
        }

        .logo img:hover {
            transform: scale(1.05);
        }

        .nav-list {
            list-style: none;
            padding: 1.0rem;
            color: white;
        }

        .nav-item {
            margin: 20px 0;
            position: relative;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 10px;
            text-decoration: none;
            color: white;
            font-size: 14px;
            border-radius: 6px;
            transition: all 0.3s ease;
            cursor: pointer;
            background: linear-gradient(to right, transparent, transparent);
        }

        .nav-link:hover {
            background: linear-gradient(to right, #b6b4b4, transparent);
            transform: translateX(5px);
        }

        .nav-link i {
            margin-left: 10px;
            margin-right: 10px;
            width: 20px;
            height: 20px;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }

        .nav-link:hover i {
            transform: scale(1.2);
        }

        /* Arrow indicator */
        .nav-link .arrow {
            display: inline-block;
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid #333;
            margin-left: 10px;
            transition: transform 0.3s ease;
        }

        .nav-item.active .nav-link .arrow {
            transform: rotate(180deg);
        }

        /* Dropdown styles */
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
            color: white;
            font-size: 13px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
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
            color: #white;
        }

        /* Active state */
        .nav-item.active .nav-link {
            background: linear-gradient(to right, #b6b4b4, transparent);
            color: #000;
        }

      

    </style>
</head>
<body>


   
    <div class="sidebar">
        <div class="logo">
            <a href="home.php">
            <img src="<?=ROOT?>/assets/images/amar/logO.png" alt="PED">

            </a>
        </div>
        
        
        <ul class="nav-list">



        <!-- DashBoard -->
        <li class="nav-item">
                <a href="home" class="nav-link">
                    <i class="uil uil-building"></i>
                    Dashboard
                </a>
            </li>

            


        <!-- Attendance -->
        <li class="nav-item">
                <a href="attendance" class="nav-link">
                    <i class="uil uil-building"></i>
                    Attendance
                </a>
            </li>

           <!-- Event -->


            <li class="nav-item has-dropdown">
                <a href="" class="nav-link">
                    <i class="uil uil-trophy"></i>
                    Event
                    <i class="arrow"></i>
                </a>
                <div class="dropdown">
                    <a href="event" class="dropdown-link">New Event</a>
                    <a href="update" class="dropdown-link">Status</a>
                </div></li>


        


              <!-- Inventory-->
            <li class="nav-item">
                <a href="inventory" class="nav-link">
                    <i class="uil uil-user"></i>
                    Inventory
                </a>
            </li>

            



            

            <li class="nav-item has-dropdown">
                <a href="#" class="nav-link">
                    <i class="uil uil-calendar-alt"></i>
                    Forms
                    <i class="arrow"></i>
                </a>
                <div class="dropdown">
                    <a href="rules" class="dropdown-link">Rules and Regulations</a>
                    <a href="hostel" class="dropdown-link">Hostel</a>
                </div>
            </li>
           

            
            
           
         

           

           
           
            
              
        </ul>

       
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const itemsWithDropdown = document.querySelectorAll('.has-dropdown');
    let activeDropdown = null;

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
    </script>
</body>
</html>