<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Management Sidebar</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/amar/nav.css">


</head>
<body>



    <div class="sidebar">
        <div class="logo">
            <a href="home.php">
            <img src="<?=ROOT?>/assets/images/amar/logo.png" alt="PEAK">

            </a>
        </div>
        
        
        <ul class="nav-list">



        <!-- DashBoard -->
           <!-- profile -->
        <li class="nav-item">
                <a href="notice" class="nav-link">
                    <i class="uil uil-building"></i>
                    Dashboard
                </a>
            </li>


        <!-- profile -->
        <li class="nav-item">
                <a href="profile" class="nav-link">
                    <i class="uil uil-building"></i>
                    Profile
                </a>
            </li>

            <!-- sportsblog -->
            <li class="nav-item">
                <a href="blog" class="nav-link">
                    <i class="uil uil-basketball"></i>
                    Sports Blog
                </a>
            </li>


            <!-- eqipment-->
            <li class="nav-item">
                <a href="equipment" class="nav-link">
                    <i class="uil uil-user"></i>
                    Equipment
                </a>
            </li>


              <!-- pool  -->
            <li class="nav-item">
                <a href="pool" class="nav-link">
                    <i class="uil uil-user"></i>
                    Pool
                </a>
            </li>

              <!-- pool  -->
              <li class="nav-item">
                <a href="gym" class="nav-link">
                    <i class="uil uil-user"></i>
                    Gym
                </a>
            </li>

           

            <!-- Enhancement Letter -->
            <li class="nav-item">
                <a href="enhancement" class="nav-link">
                    <i class="uil uil-user"></i>
                    Enhancement Letter
                </a>
            </li>  



            

            <li class="nav-item has-dropdown">
                <a href="#" class="nav-link">
                    <i class="uil uil-calendar-alt"></i>
                    Forms
                    <i class="arrow"></i>
                </a>
                <div class="dropdown">
                    <a href="medical" class="dropdown-link">Medical</a>
                    <a href="letter" class="dropdown-link">Execuse Letter</a>
                    <a href="certification" class="dropdown-link">Certifications</a>
                </div>
            </li>
    

            
            
    
        

        

        
        
        
            
        </ul>

    </div>

    <script src="<?=ROOT?>/assets/js/amar/nav.js"></script>
       
    
</body>
</html>