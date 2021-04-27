<?php 
session_start();
if($_SESSION["logged_in"]==true){ 
    include('connection.php');
   
   


    $query_locatie_apropiata = "SELECT L.Oras, L.Strada, L.Nr_Strada, L.Telefon FROM Punct_de_lucru L
    WHERE L.Oras IN (SELECT P.Oras FROM Pacienti P WHERE P.CNP = '".$_SESSION['CNP']."')";

    $query_freq = "SELECT DISTINCT L.Oras, L.Strada, L.Nr_Strada, L.Telefon FROM Punct_de_lucru L
                   INNER JOIN [Analiza-Punct_de_lucru] AL ON AL.Id_Punct_de_lucru = L.Id_Punct_de_lucru
                   INNER JOIN [Analiza-Pacient] AP ON AP.Id_Analiza = AL.Id_Analiza
                   INNER JOIN Pacienti P ON P.Id_Pacient = AP.Id_Pacient WHERE P.CNP = '".$_SESSION['CNP']."'";
  
    $rezultat_locatie_apropiata = sqlsrv_query($conn, $query_locatie_apropiata, array(), array( "Scrollable" => 'static' ));      
    $rezultat_locatie_frecventata = sqlsrv_query($conn, $query_freq, array(), array( "Scrollable" => 'static' ));      
    
    ?> 
<html>

    <head>
         <link rel="stylesheet" href="analize_style.css">
        <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <body>
            <div class="background"> 
                <div class="navbar">
                        <a class="brand" href="home_page.php">
                            <img src="atom.svg" class="logo">  
                        </a>
                        
                        <a class="navbar-button" href="logout.php"> Log out </a>                     
                        <a class="navbar-button" href="analize.php"> Analize </a>  
                        <a class="navbar-button" href="home_page.php"> Home </a>
                </div>

                <div>
                    
                    <?php 
                    if(sqlsrv_num_rows($rezultat_locatie_apropiata) == 0){
                
                            ?><h2> Va recomandam: </h2><?php
                            while($row_locatie_frecventata = sqlsrv_fetch_array($rezultat_locatie_frecventata)){?>
                                <p> <?php echo $row_locatie_frecventata['Oras'] . " Strada " . $row_locatie_frecventata['Strada'] . " nr. " . $row_locatie_frecventata['Nr_Strada'] . "  Punct de contact: " . $row_locatie_frecventata['Telefon']; ?> </p> 
    
    
    
    
                        <?php  }
                    
                    
                    
                    }
                    else{
                        ?><h2> Cele mai apropiate laboratoare de dumneavoastra sunt in: </h2><?php
                        while($row_locatie_apropiata = sqlsrv_fetch_array($rezultat_locatie_apropiata)){?>
                            <p> <?php echo $row_locatie_apropiata['Oras'] . " Strada " . $row_locatie_apropiata['Strada'] . " nr. " . $row_locatie_apropiata['Nr_Strada'] . "  Punct de contact: " . $row_locatie_apropiata['Telefon']; ?> </p> 




                    <?php  }}
                    ?>
                </div>


    </body>
 
</html>
<?php } ?>

