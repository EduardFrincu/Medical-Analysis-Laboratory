<?php session_start(); 
    $_SESSION['adm'] = "false";
?>
<html>
    <head>
        <link rel="stylesheet" href="welcome_style.css">
        <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

<?php   
    include('connection.php');
    if(isset($_POST["COD"], $_POST["pwd"])) 
    {
        $user_CNP = $_POST['COD'];
        $user_password = $_POST['pwd'];
        if($user_CNP == "admin" && $user_password =="admin") 
        {
            $_SESSION['adm'] = "true";
            header("Location:admin.php");
        }
        else $_SESSION['adm'] = "false";

        $query = "SELECT Id_Pacient, Nume, Prenume FROM Pacienti WHERE CNP = '$user_CNP' AND Parola  = '$user_password'";
        $rezultat = sqlsrv_query($conn, $query, array(), array( "Scrollable" => 'static' ));
        
        $row = sqlsrv_fetch_array($rezultat);
       
        list($_SESSION["id"],$_SESSION["nume"],$_SESSION["prenume"]) = $row; 
        $num = sqlsrv_num_rows($rezultat);
    }              
    else
    {       
      
        header("Location: login.php"); 
        exit();
            
    }
    
?>
<body>

    <?php
        if($num > 0 )
        { 
            $_SESSION["logged_in"] = true; 
            $_SESSION["CNP"] = $user_CNP; 
        }
        else{ 
            $_SESSION["logged_in"]=false;
            header("Location: login.php"); 
            exit();
        } 
    ?>

         <div class="background">    
            <div class="navbar">
                <a class="brand" href="home_page.php">
                    <img src="atom.svg" class="logo">  
                </a>

                <p class="welcome-message"> 
                
                    <?php 
                        echo "Bun venit, ". $row['Nume'] . " " .$row['Prenume'].  "!<br>"; 
                        $_SESSION["CNP"] = $user_CNP;                           
                    ?> 

                </p>
                
                <a class="navbar-button" href="logout.php">  Log out</a> 
                <a class= "navbar-button" href="laboratoare.php"> Laboratoare </a>
                <a class= "navbar-button" href="analize.php"> Analize </a>
                <a class = "navbar-button" href="actualizare.php"> Actualizare Informatii </a>
                <a class = "navbar-button" href="home_page.php"> Home
                    
                </a>

            </div>  
            <div class="background"> </div>                   
                    
        </div>           
         

</body>

</html>