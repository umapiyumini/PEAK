<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-1.0">
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/enav.css">
        <title>External User Dashboard</title>
    </head>


    <body>
        <!-- navigation bar -->
        

       

        
            <div class="topbar">
                

                <div class="user">
                    <a href="profile"><img src="<?=ROOT?>/assets/images/user1.jpg"></a>
                </div>
            </div>
                

            <script >
                let toggle = document.querySelector(".toggle");
                let navigation = document.querySelector(".navigation");
                let main = document.querySelector(".main");

                toggle.onclick = function(){
                navigation.classList.toggle("active");
                main.classList.toggle("active");
  
            }
            </script>
    </body>
</html>