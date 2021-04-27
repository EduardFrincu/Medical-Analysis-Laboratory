<?php session_start();?>

<html>
<head>
<link rel = "stylesheet" href = "login_style.css">
<link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
</head>
<body>
<div class="background"> 
    <div class="navbar">
            <a class="brand" href="home.php">
                <img src="atom.svg" class="brand-logo">  
            </a>
            
            <a class="navbar-button" href="register.php"> Register                
            </a> 
            <a class="navbar-button" href="home.php"> Home </a>
    </div>

    <div class="login-page">
        <div class="form">
            <div class = "login">
                <div class = "login-header">
                    <a class="brand" href="#">
                        <img src="atom.svg" class="logo">  
                    </a>
                    <h3>AUTENTIFICARE</h3>
                    <p>Introduceti datele:</p>
                 </div>
            </div>

            <form class = 'login-form' action="welcome_page.php" method="POST" >
                <input name ="COD" type = "text" placeholder="CNP" maxlength="13" >  <br/>
                <input name="pwd" type= "password" placeholder = "PAROLA"> <br>
                <button name ="submit" type="submit"> Log In </button>
                
            </form>

        </div>
    </div>

    </div> 
</body>

</html>