<?php 
    session_start();
    if(isset($_POST['SubmitButton'])){
        include("connection.php");
        if($_POST['Oras'])
                $input_Oras = $_POST['Oras'];
        if($_POST['Strada'])
                $input_Strada = $_POST['Strada'];
        if($_POST['Oras'])
                $input_Nr = $_POST['Nr_Strada'];

        if(!$_POST['Nr_Strada']) 
            $query_update = "UPDATE Pacienti SET Oras = '$input_Oras' , Strada = '$input_Strada', Nr_strada = NULL
                             WHERE  CNP = '".$_SESSION["CNP"]."'";

        else
            $query_update = "UPDATE Pacienti SET Oras = '$input_Oras' , Strada = '$input_Strada', Nr_strada = '$input_Nr'
                             WHERE  CNP = '".$_SESSION["CNP"]."'";

        $rezultat_query = sqlsrv_query($conn, $query_update, array(), array( "Scrollable" => 'static' ));  
        
   
    }
?>


<html>
<head>
<link rel = "stylesheet" href = "register_style.css">
<link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
</head>
<body>
<div class="background"> 
    <div class="navbar">
            <a class="brand" href="home_page.php">
                <img src="atom.svg" class="brand-logo">  
            </a>

            
            <a class="navbar-button" href="home_page.php"> Home </a>
            
    </div>

    <div class="login-page">
        <div class="form">
            <div class = "login">
                <div class = "login-header">
                    <a class="brand" href="#">
                        <img src="atom.svg" class="logo">  
                    </a>
                    <h3>ACTUALIZARE</h3>
                    
                 </div>
            </div>

            <form class = 'login-form' action="" method="POST" >
               
                    <input name ="Oras" type = "text" placeholder="Oras">  <br/>
                    <input name ="Strada" type = "text" placeholder="Strada"  >  <br/>
                    <input name ="Nr_Strada" type = "text" placeholder="Nr_Strada"  >  <br/>
                    <button name = "SubmitButton" type="submit">  Actualizare </button>
                
            </form>

        </div>
    </div>

    </div> 
</body>

</html>