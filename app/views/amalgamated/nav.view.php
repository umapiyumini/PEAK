<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Management Sidebar</title>
   
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
    
        <li class="nav-item">
                <a href="home" class="nav-link">
                <i class="fa-solid fa-gauge"></i>
                    Home
                </a>
            </li>


       

            
        

           

           



            

               <!-- Colours Night  -->
               <li class="nav-item">
                <a href="<?=ROOT ?>/amalgamated/Night" class="nav-link">
                <i class="fa-solid fa-trophy"></i>  
                    Rules & Regulations
                </a>
            </li>

           

            <li class="nav-item">
                <a href="../choose1" class="nav-link">
                <i class="fa-solid fa-gauge"></i>
                    Switch User
                </a>
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