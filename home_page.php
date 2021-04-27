<?php 
    session_start(); 
?>
<html>

    <head>
        <link rel="stylesheet" href="home.css">
        <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

        <div class="navbar">
            <a class="brand" href="home_page.php">
                <img src="atom.svg" class="logo">  
            </a>
            
        <?php if(!$_SESSION["logged_in"]) {?>

            <a class="navbar-button" href="login.php"> Log in   </a> 
            <a class="navbar-button" href="register.php"> Register </a>


        <?php }  ?>

        <?php if($_SESSION["logged_in"]) {?>

            <a class="navbar-button" href="logout.php"> Log out   </a> 
            <a class="navbar-button" href="analize.php"> Analize   </a> 
            <a class="navbar-button" href="laboratoare.php"> Laboratoare  </a> 
            <a class = "navbar-button" href="actualizare.php"> Actualizare Informatii </a>
            <!-- <a class="navbar-button" href="welcome_page.php"> Profile   </a> -->
            

        <?php }  ?>

            
        </div>

            <section class="wave"> </section>
            <section> </section>





        
    </body>
</html>