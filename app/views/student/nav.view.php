<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Management Sidebar</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/amar/nav.css">


</head>
<body>



    <div class="sidebar">   
        <div class="logo">
            <a href="home.php">
            <img src="<?=ROOT?>/assets/images/amar/P_logo.png" alt="PED logo" id="logo">
            </a>
        </div>
        
        
        <ul class="nav-list">



        <!-- DashBoard -->
           <!-- profile -->
        <li class="nav-item">
                <a href="<?=ROOT ?>/student/Home" class="nav-link">
                <i class="fa-solid fa-gauge"></i>
                   Home
                </a>
            </li>


        <!-- profile -->
        <li class="nav-item">
                <a href="<?=ROOT ?>/student/Profile" class="nav-link">
                <i class="fa-regular fa-user"></i>
                    Profile
                </a>
            </li>

            <!-- sportsblog -->
            <li class="nav-item">
                <a href="<?=ROOT ?>/student/Sports" class="nav-link">
                <i class="fa-solid fa-basketball"></i>
                    Sport 
                </a>
            </li>


            



              <!-- Tournament -->
              <li class="nav-item">
                <a href="<?=ROOT ?>/student/Tournament" class="nav-link">
                    
                <i class="fa-solid fa-volleyball"></i>
                    Tournament
                </a>
            </li>


            


            
             

             

            



            
<!-- forms -->
            <li class="nav-item has-dropdown">
                <a href="#" class="nav-link">
                <i class="fa-brands fa-wpforms"></i>
                    Forms
                    <i class="arrow"></i>
                </a>
                <div class="dropdown">
                    <a href="<?=ROOT ?>/student/Medical" class="dropdown-link">Medical</a>
                    <a href="<?=ROOT ?>/student/Certification" class="dropdown-link">Certifications</a>
                    <a href="<?=ROOT ?>/student/Enhancement" class="dropdown-link">Enhancement</a>

                </div>
            </li>

            
<!-- logout -->

     <li class="nav-item">
                <a href="../login" class="nav-link">
                <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </a>
            </li>



            
            
    
        

            
        </ul>

    </div>

    <script src="<?=ROOT?>/assets/js/amar/nav.js"></script>
       
    
</body>
</html>